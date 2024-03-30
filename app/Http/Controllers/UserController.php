<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(StoreUserRequest $request){
        $request->validated();

        $userData = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = User::create($userData);
        $token = $user->createToken('nanze')->plainTextToken;

        return response([
            "message" => 'User registered succesfully !',
            "user" => $user,
            "token" => $token
        ], 200);
    }

    public function login(LoginUserRequest $request){
        $request->validated();

        $user = User::whereUsername($request->username)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                "message" => 'Coordonnées invvalides',
            ], 422);
        }

        $token = $user->createToken('nanze')->plainTextToken;

        return response([
            "user" => $user,
            "token" => $token
        ], 200);
    }

    public function update(StoreUserRequest $request, int $id){
        $request->validated();

        $user = User::find($id);

            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

        return response([
            'message' => 'Produit modifié avec succès !',
            'produit' => $user
        ], 200);
    }

    public function delete(User $user){
        $user->delete();

        return response([
            'message' => 'Produit supprimé avec succès !',
            'utilisateur' => $user
        ], 200);
    }

    public function view(User $user){
        return response([
            'utilisateur' => $user
        ], 200);
    }
}
