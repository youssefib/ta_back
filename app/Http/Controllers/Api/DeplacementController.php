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
            return response()->json(['message'=>'Imposible de supprimer un deplacement déjà valider!!'],403);
        }
    }

    function generatePDF(Request $request)
    {

        $date = Carbon::now();
        $dompdf = new Dompdf();
        $deplacements = Deplacement::whereIn('id',$request->ids)->get();

        $imprimable = $deplacements->filter(function ($deplacement) {
            return !$deplacement->imprime;
        });

        $non_imprimable = $deplacements->filter(function ($deplacement) {
            return $deplacement->imprime;
        });

        if(!count($imprimable)){
            return response()->json(['message'=>'Imposible d\'imprimer un deplacement déjà imprimer!!'],403);

        }

        $dompdf->loadHtml(view('pdf',['deplacements' => $imprimable , 'date' => $date])->render());

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();
        $output = $dompdf->output();
        $file_path = 'public/export/Export des frais de déplacement du '.$date->format('d-m-Y H.i.s').'.pdf';

        Storage::put($file_path,$output);

        $file= asset('/storage/export/Export des frais de déplacement du '.$date->format('d-m-Y H.i.s').'.pdf') ;



        $deplacements_ids =  $imprimable->pluck('id');

        Deplacement::whereIn('id', $deplacements_ids)->update([
            'imprime' => 1,
            'd_imp'   =>$date,
            'print_link'   =>$file,
        ]);
        return ['url' => $file, 'imprimable' => count($imprimable), 'non_imprimable' => count($non_imprimable)] ;
    }

public function exportCsv(Request $request)
{

    $date = Carbon::now();
    $fileName = 'Export des frais de déplacement du '.$date->format('d-m-Y H.i.s').'csv';
    $deplacements = Deplacement::whereIn('id',$request->ids)->get();

    $exportables = $deplacements->filter(function ($deplacement) {
        return !$deplacement->export_csv;
    });

    $non_exportable = $deplacements->filter(function ($deplacement) {
        return $deplacement->export_csv;
    });

    if(!count($exportables)){
        return response()->json(['message'=>'Imposible d\'exporter un deplacement deja exporter!!'],403);

    }

    $csv =view('csv',['deplacements' => $exportables])->render();
    $output = $csv;
    $file_path = 'public/csv/Export des frais de déplacement du '.$date->format('d-m-Y H.i.s').'.csv';
    Storage::put($file_path,$output);
    $file= asset('/storage/csv/Export des frais de déplacement du '.$date->format('d-m-Y H.i.s').'.csv') ;

    $deplacements_ids =  $exportables->pluck('id');

        Deplacement::whereIn('id', $deplacements_ids)->update([
            'export_csv'    => 1,
            'd_csv'         =>$date,
            'csv_link'      =>$file,
        ]);
    return ['url' => $file, 'exportables' => count($exportables), 'non_exportable' => count($non_exportable)];

}


}
