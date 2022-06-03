<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehiculeResource;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    function index(){
        $vehicules = Vehicule::all();

        return VehiculeResource::collection($vehicules);
    }
}
