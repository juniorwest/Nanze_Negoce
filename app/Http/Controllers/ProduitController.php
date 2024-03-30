<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieRegisterRequest;
use App\Http\Requests\ImageRegisterRequest;
use App\Http\Requests\MarqueRegisterRequest;
use App\Http\Requests\ProduitRegisterRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Marque;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    public function register(ProduitRegisterRequest $request, ImageRegisterRequest $req, CategorieRegisterRequest $reqs, MarqueRegisterRequest $res){
        $request->validated();
        $data = $req->validated();
        $reqs->validated();
        $res->validated();

        $categorieData = [
            'nom_cat' => $reqs->nom_cat,
        ];

        $categorie = Category::create($categorieData);

        $marqueData = [
            'nom_mar' => $res->nom_mar,
        ];

        $marque = Marque::create($marqueData);

        $produitData = [
            'nom' => $request->nom,
            'description' => $request->description,
            'category_id' => $categorie->id,
            'marque_id' => $marque->id
        ];

        $produit = Produit::create($produitData);
       
        $images = $req->file('image');
        $images->store('images', 'public');
        $data['image'] = $images->store('images', 'public');
        
        $produit->images()->create($data);

        $prod = Produit::with('images', 'category')->find($produit->id);
        
        return response([
            'message' => 'Produit créé avec succès !',
            'produit' => $prod
        ], 200);
    }

    public function update(ProduitRegisterRequest $request, int $id){
        $request->validated();

        $produit = Produit::with('images', 'category')->find($id);

            $produit->nom = $request->nom;
            $produit->description = $request->description;
            $produit->disponibilite = $request->disponibilite;
            $produit->category_id = $request->category_id;
            $produit->marque_id = $request->marque_id;
            $produit->image = $request->image;
            $produit->save();

        return response([
            'message' => 'Produit modifié avec succès !',
            'produit' => $produit
        ], 200);
    }

    public function delete(Produit $produit){
        $produit->delete();

        return response([
            'message' => 'Produit supprimé avec succès !',
            'produit' => $produit
        ], 200);
    }

    public function view(Produit $produit){
        $selectedProduit = Produit::with('images', 'category')->find($produit->id);
        return response([
            'produit' => $selectedProduit
        ], 200);
    }

    public function search($recherche){
        
        return Produit::where('nom', 'like', "%$recherche%")->with('images', 'category')->get();
    }

    public function productStatuschanger(Produit $produit){
        $produit->disponibilite = 1 ? $produit->disponibilite = 0 : $produit->disponibilite = 1;
    }

    public function filter(){

    }
}
