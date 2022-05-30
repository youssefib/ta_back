<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeplacementRequest;
use App\Http\Resources\DeplacementResource;
use App\Http\Resources\UserResource;
use App\Models\Deplacement;
use App\Models\User;
use Illuminate\Http\Request;

class DeplacementController extends Controller
{
    function index(){
        $deplacements = Deplacement::all();

        return DeplacementResource::collection($deplacements);
    }


    function get(Deplacement $deplacement){

        return new DeplacementResource($deplacement);
    }

    function create(DeplacementRequest $request ){
        $deplacement = Deplacement::create([
            'user_id'       =>$request->user_id,
            'id_vehicule'   =>$request->id_vehicule,
            'date'          =>$request->date,
            'intitule'      =>$request->intitule,
            'peage'         =>$request->peage,
            'gasoil'        =>$request->gasoil,
            'ptm'           =>$request->ptm,
            'nb_km'         =>$request->nb_km,
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
            'id_vehicule'   =>$request->id_vehicule,
            'date'          =>$request->date,
            'intitule'      =>$request->intitule,
            'peage'         =>$request->peage,
            'gasoil'        =>$request->gasoil,
            'ptm'           =>$request->ptm,
            'nb_km'         =>$request->nb_km,
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
