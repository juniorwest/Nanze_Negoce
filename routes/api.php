<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function(){
    return response([
        "message" => 'Api is working'
    ], 200);
});

Route::post('/user_register', [UserController::class, 'register']);
Route::post('/user_update', [UserController::class, 'update']);
Route::delete('/user_delete', [UserController::class, 'delete']);
Route::get('/user_view', [UserController::class, 'view']);

//Produits
Route::post('/register_produit', [ProduitController::class, 'register']);
Route::post('/update_produit/{id}', [ProduitController::class, 'update']);
Route::delete('/delete_produit/{produit}', [ProduitController::class, 'delete']);
Route::get('/view_produit/{produit}', [ProduitController::class, 'view']);
Route::get('/search_produit/{recherche}', [ProduitController::class, 'search']);

//Categorie
Route::post('/register_categorie', [CategorieController::class, 'register']);
Route::post('/update_categorie/{id}', [CategorieController::class, 'update']);
Route::delete('/delete_categorie/{categorie}', [CategorieController::class, 'delete']);

//Marque
Route::post('/register_marque', [MarqueController::class, 'register']);
Route::post('/update_marque/{id}', [MarqueController::class, 'update']);
Route::delete('/delete_marque/{marque}', [MarqueController::class, 'delete']);

//Image
Route::post('/register_image', [ImageController::class, 'registerImage']);
Route::delete('/delete_image/{image}', [ImageController::class, 'delete']);