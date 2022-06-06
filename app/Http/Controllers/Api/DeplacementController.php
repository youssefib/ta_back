<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeplacementRequest;
use App\Http\Resources\DeplacementResource;
use App\Http\Resources\UserResource;
use App\Models\Deplacement;
use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Vehicule;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DeplacementController extends Controller
{
    function index(){
        $deplacements = Deplacement::with('user')->get();

        return DeplacementResource::collection($deplacements);
    }
    // auth()->user()->id
    // create(User $user)
    // $user->id


    function index_user(){

        $user =  auth()->user();
        $deplacements = Deplacement::where('user_id', $user->id)->with('user')->get();

        return DeplacementResource::collection($deplacements);
    }

    function get(Deplacement $deplacement){

        return new DeplacementResource($deplacement);
    }

    function create(DeplacementRequest $request ){

        $user =  auth()->user();
        if(!$user->is_admin){
            $request->user_id = $user->id;
        }

        $vehicule = Vehicule::where('id', $request->vehicule_id)->first();

        if($vehicule->taux_km){
            $request->gasoil = null;
        }


        $deplacement = Deplacement::create([
            'user_id'       =>$request->user_id,
            'vehicule_id'   =>$request->vehicule_id,
            'date'          =>$request->date,
            'intitule'      =>$request->intitule,
            'peage'         =>$request->peage,
            'gasoil'        =>$request->gasoil,
            'ptm'           =>$request->ptm,
            'nb_km'         =>$request->nb_km,
            't_km'          =>$vehicule->taux_km,
            'f_divers'      =>$request->f_divers,
            'm_divers'      =>$request->m_divers,
            'infos'         =>$request->infos,
            't_repas'       =>$request->t_repas,
            'nb_repas'      =>$request->nb_repas,
            'm_repas'       =>$request->m_repas,
            'm_hotel'       =>$request->m_hotel,
            'valider'       =>$request->valider,
        ]);
        return new DeplacementResource($deplacement);
    }

    function update(DeplacementRequest $request, Deplacement $deplacement){

        $user =  auth()->user();


        $vehicule = Vehicule::where('id', $request->vehicule_id)->first();

        if($vehicule->taux_km){
            $request->gasoil = null;
        }

        if($deplacement->valider){
            $request->valider = 1;
        }

        if(!$user->is_admin){
            $deplacement->update([
                'user_id'       =>$user->id,
                'vehicule_id'   =>$request->vehicule_id,
                'date'          =>$request->date,
                'intitule'      =>$request->intitule,
                'peage'         =>$request->peage,
                'gasoil'        =>$request->gasoil,
                'ptm'           =>$request->ptm,
                'nb_km'         =>$request->nb_km,
                't_km'          =>$vehicule->taux_km,
                'f_divers'      =>$request->f_divers,
                'm_divers'      =>$request->m_divers,
                'infos'         =>$request->infos,
                't_repas'       =>$request->t_repas,
                'nb_repas'      =>$request->nb_repas,
                'm_repas'       =>$request->m_repas,
                'm_hotel'       =>$request->m_hotel,
            ]);
            return new DeplacementResource($deplacement);

        }


        $deplacement->update([
            'user_id'       =>$request->user_id,
            'vehicule_id'   =>$request->vehicule_id,
            'date'          =>$request->date,
            'intitule'      =>$request->intitule,
            'peage'         =>$request->peage,
            'gasoil'        =>$request->gasoil,
            'ptm'           =>$request->ptm,
            'nb_km'         =>$request->nb_km,
            't_km'          =>$vehicule->taux_km,
            'f_divers'      =>$request->f_divers,
            'm_divers'      =>$request->m_divers,
            'infos'         =>$request->infos,
            't_repas'       =>$request->t_repas,
            'nb_repas'      =>$request->nb_repas,
            'm_repas'       =>$request->m_repas,
            'm_hotel'       =>$request->m_hotel,
            'valider'       =>$request->valider,
        ]);

        return new DeplacementResource($deplacement);
    }

    function delete(Deplacement $deplacement){
        if(!$deplacement->valider){
            $deplacement->delete();
            return response()->json(['message'=>'supprimer!!']);
        }else{
            return response()->json(['message'=>'Imposible de supprimer un deplacement déjà valider!!']);
        }
    }

    function generatePDF(Request $request)
    {

        $date = Carbon::now();
        $dompdf = new Dompdf();
        $deplacements = Deplacement::whereIn('id',$request->ids)->get();



        foreach($deplacements as $deplacement){
            $deplacement->update([
                'imprime'       =>1,
                'd_imp'         =>$date,
            ]);
        }

        $dompdf->loadHtml(view('pdf',compact('deplacements','date'))->render());

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();
        $output = $dompdf->output();
        $file_path = 'public/export/Export des frais de déplacement du '.$date->format('d-m-Y H.i.s').'.pdf';

        Storage::put($file_path,$output);

        $file= public_path(). '/storage/export/Export des frais de déplacement du '.$date->format('d-m-Y H.i.s').'.pdf';

        $headers = array(
            'Content-Type: application/pdf',
          );

        return '<a href="' .$file. '" target="_blank" download ">Export des frais de déplacement du '.$date->format('d-m-Y H.i.s').'.pdf</a>' ;
    }

public function exportCsv(Request $request)
{

    $date = Carbon::now();
   $fileName = 'Export des frais de déplacement du '.$date->format('d-m-Y H.i.s').'csv';
   $deplacements = Deplacement::whereIn('id',$request->ids)->get();


        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('intitule', 'date', 'Description', 'Start Date', 'Due Date');

        $callback = function() use($deplacements, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($deplacements as $deplacement) {
                $row['intitule']        = $deplacement->intitule;
                $row['date']            = $deplacement->date;
                $row['Description']     = $deplacement->description;
                $row['Start Date']      = $deplacement->start_at;
                $row['Due Date']        = $deplacement->end_at;

                fputcsv($file, array($row['intitule'], $row['date'], $row['Description'], $row['Start Date'], $row['Due Date']));
            }

            fclose($file);
        };

        $file_path = 'public/csv/Export des frais de déplacement du '.$date->format('d-m-Y H.i.s').'.pdf';

        Excel::store(new InvoicesExport(2018), 'invoices.xlsx');
        return 'ok' ;

    }


}
