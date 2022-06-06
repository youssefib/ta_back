<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DeplacementController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VehiculeController;
use App\Models\User;
use App\Models\Deplacement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("auth")->group(function(){
    Route::post('login', [AuthController::class, 'login']);
});


Route::prefix("users")->middleware("auth:api")->group(function(){
    Route::get('/', [UserController::class, 'index'])->can('viewAny', User::class);
    Route::get('/currentUser', [UserController::class, 'currentUser']);
    Route::get('/data/{user}', [UserController::class, 'get'])->can('view', User::class);
    Route::post('/', [UserController::class, 'create'])->can('create', User::class);
    Route::put('/{user}', [UserController::class, 'update'])->can('update', User::class);
    Route::delete('/{user}', [UserController::class, 'delete'])->can('delete', User::class);
    Route::get('/{user}/reset', [UserController::class, 'reset'])->can('reset', User::class);
});

Route::prefix("deplacements")->middleware("auth:api")->group(function(){
    Route::get('/', [DeplacementController::class, 'index'])->can('viewAny', Deplacement::class);
    Route::get('/mes-deplacement', [DeplacementController::class, 'index_user']);
    Route::get('/{deplacement}', [DeplacementController::class, 'get']);
    Route::post('/', [DeplacementController::class, 'create']);
    Route::put('/{deplacement}', [DeplacementController::class, 'update']);
    Route::delete('/{deplacement}', [DeplacementController::class, 'delete']);
    Route::post('/print', [DeplacementController::class, 'generatePDF']);
    Route::post('/csv', [DeplacementController::class, 'exportCsv']);
});


Route::prefix("vehicules")->middleware("auth:api")->group(function(){
    Route::get('/', [VehiculeController::class, 'index']);
});
