<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeplacementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"            =>$this->id,
            "user"          =>$this->user->id,
            "vehicule"      =>VehiculeResource::collection($this->vehicule),
            "date"          =>$this->date,
            "intitule"      =>$this->intitule,
            "peage"         =>$this->peage,
            "peage"         =>$this->peage,
            "ptm"           =>$this->ptm,
            "nb_km"         =>$this->nb_km,
            "f_divers"      =>$this->f_divers,
            "m_divers"      =>$this->m_divers,
            "infos"         =>$this->infos,
            "t_repas"       =>$this->t_repas,
            "nb_repas"      =>$this->nb_repas,
            "m_repas"       =>$this->m_repas,
            "m_hotel"       =>$this->m_hotel,
            "valider"       =>$this->valider,
            "imprime"       =>$this->imprime,
            "d_imp"         =>$this->d_imp,
        ];
    }
}
