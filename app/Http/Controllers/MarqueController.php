<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarqueRegisterRequest;
use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    public function register(MarqueRegisterRequest $request){
        $request->validated();

        $marqueData = [
            'nom_mar' => $request->nom_mar,
        ];

        $marque = Marque::create($marqueData);

        return response([
            'message' => 'Categorie créée avec succès !',
            '$marque' => $marque
        ], 200);
    }

    public function update(MarqueRegisterRequest $request, int $id){
        $request->validated();

        $marque = Marque::find($id);
        $marque->nom = $request->nom;
        $marque->save();

        return response([
            'message' => 'Categorie modifiée avec succès !',
            'categorie' => $marque
        ], 200);
    }

    public function delete(Marque $marque){
        $marque->delete();

        return response([
            'message' => 'Produit supprimée avec succès !',
            'marque' => $marque
        ], 200);
    }
}
