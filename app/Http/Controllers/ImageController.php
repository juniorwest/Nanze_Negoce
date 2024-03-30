<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRegisterRequest;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function register(ImageRegisterRequest $req){
        $req->validated();

        /*
        $imageData = [
            'image' => $request->image,
        ];

        $ImagePath = $request->file('ImageProduit')->store('Produits');
        */

        $ImagePath = $req->validated('images')->store('Produits');

        $image = Image::create($ImagePath);

        return response([
            'message' => 'Image créée avec succès !',
            'categorie' => $image
        ], 200);
    }

    public function delete(Image $image){
        $image->delete();

        return response([
            'message' => 'Image supprimée avec succès !',
            'categorie' => $image
        ], 200);
    }
}
