<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
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
    Route::get('/', [UserController::class, 'index'])->can('update', User::class);
});
