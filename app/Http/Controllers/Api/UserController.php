<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Mail\ResetPassword;
use App\Models\User;
use App\Services\PasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function index(){
        $users = User::all();

        return UserResource::collection($users);
    }

    function get(User $user){

        return new UserResource($user);
    }

    function create(UserRequest $request, PasswordService $passwordService){
        $user = User::create([
            'first_name'=>$request->first_name,
            'last_name' =>$request->last_name,
            'username'  =>$request->username,
            'email'     =>$request->email,
            'password'  =>bcrypt($passwordService->generate()),
            'is_admin'  =>$request->is_admin ?? 0,
        ]);
        return new UserResource($user);
    }

    function update(UserRequest $request, User $user){
        $user->update([
            'first_name'=>$request->first_name,
            'last_name' =>$request->last_name,
            'username'  =>$request->username,
            'email'     =>$request->email,
            'is_admin'  =>$request->is_admin ?? $user->is_admin,
        ]);

        return new UserResource($user);
    }

    function delete(User $user){
        $user->delete();
        return response()->json(['message'=>'supprimer!!']);
    }

    function reset(PasswordService $passwordService,User $user){

        $password = $passwordService->generate();
        $user->update([
            'password'  =>bcrypt($password),
        ]);

        Mail::to($user->email)->send(new ResetPassword($user,$password));
        return new UserResource($user);

    }





}
