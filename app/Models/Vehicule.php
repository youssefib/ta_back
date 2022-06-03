<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [

        'immat',
        'taux_km',

    ];

    function deplacements(){
        return $this->hasMany('App\Models\Deplacement');
    }
}
