<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deplacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',

        'id_vehicule',

        'date',

        'intitule',

        'peage',

        'gasoil',
        // Parking/Train/Métro
        'ptm',

        // nombre de km
        'nb_km',

        //frais divers
        'f_divers',

        //montant divers
        'm_divers',

        // autres infos
        'infos',
    ];

    function user(){
        return $this->belongsTo('App\Models\user');
    }



}
