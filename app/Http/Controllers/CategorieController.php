<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieRegisterRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function register(CategorieRegisterRequest $request){
        $request->validated();

        $categorieData = [
            'nom_cat' => $request->nom_cat,
        ];

        $categorie = Category::create($categorieData);

        return response([
            'message' => 'Categorie créée avec succès !',
            'categorie' => $categorie
        ], 200);
    }

    public function update(CategorieRegisterRequest $request, int $id){
        $request->validated();

        $categorie = Category::find($id);
        $categorie->nom = $request->nom;
        $categorie->save();

        return response([
            'message' => 'Categorie modifiée avec succès !',
            'categorie' => $categorie
        ], 200);
    }

    public function delete(Category $categorie){
        $categorie->delete();

        return response([
            'message' => 'Produit supprimée avec succès !',
            'categorie' => $categorie
        ], 200);
    }
}
