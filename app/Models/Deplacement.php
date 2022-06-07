<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deplacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',

        'vehicule_id',

        'date',

        'intitule',

        'peage',

        'gasoil',
        // Parking/Train/Métro
        'ptm',

        // nombre de km
        'nb_km',

        // Taux  Km
        't_km',

        //frais divers
        'f_divers',

        //montant divers
        'm_divers',

        // autres infos
        'infos',

        // type de repas
        't_repas',

        // nombre de repas
        'nb_repas',

        // montant de repas
        'm_repas',

        // montant hotel
        'm_hotel',

         'valider',

         'imprime',

         // date impression
         'd_imp',

         'print_link',

         'cvs_link',

    ];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function vehicule(){
        return $this->belongsTo('App\Models\Vehicule');
    }



}
