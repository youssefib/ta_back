<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeplacementRequest;
use App\Http\Resources\DeplacementResource;
use App\Http\Resources\UserResource;
use App\Models\Deplacement;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\Request;

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
        $deplacement = Deplacement::create([
            'user_id'       =>$request->user_id,
            'vehicule_id'   =>$request->vehicule_id,
            'date'          =>$request->date,
            'intitule'      =>$request->intitule,
            'peage'         =>$request->peage,
            'gasoil'        =>$request->gasoil,
            'ptm'           =>$request->ptm,
            'nb_km'         =>$request->nb_km,
            't_km'         =>$request->t_km,
            'f_divers'      =>$request->f_divers,
            'm_divers'      =>$request->m_divers,
            'infos'         =>$request->infos,
            't_repas'       =>$request->t_repas,
            'nb_repas'      =>$request->nb_repas,
            'm_repas'       =>$request->m_repas,
            'm_hotel'       =>$request->m_hotel,
            'valider'       =>$request->valider,
            'imprime'       =>$request->imprime,
            'd_imp'         =>$request->d_imp,
        ]);
        return new DeplacementResource($deplacement);
    }

    function update(DeplacementRequest $request, Deplacement $deplacement){
        $deplacement->update([
            'user_id'       =>$request->user_id,
            'vehicule_id'   =>$request->vehicule_id,
            'date'          =>$request->date,
            'intitule'      =>$request->intitule,
            'peage'         =>$request->peage,
            'gasoil'        =>$request->gasoil,
            'ptm'           =>$request->ptm,
            'nb_km'         =>$request->nb_km,
            't_km'         =>$request->t_km,
            'f_divers'      =>$request->f_divers,
            'm_divers'      =>$request->m_divers,
            'infos'         =>$request->infos,
            't_repas'       =>$request->t_repas,
            'nb_repas'      =>$request->nb_repas,
            'm_repas'       =>$request->m_repas,
            'm_hotel'       =>$request->m_hotel,
            'valider'       =>$request->valider,
            'imprime'       =>$request->imprime,
            'd_imp'         =>$request->d_imp,
        ]);

        return new DeplacementResource($deplacement);
    }

    function delete(Deplacement $deplacement){
        $deplacement->delete();
        return response()->json(['message'=>'supprimer!!']);
    }


}
