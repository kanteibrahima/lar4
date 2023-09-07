<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
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

//créer un lien qui permettra aux clients : React, Vue, Angular, Node, JS Native

//recuperer la liste des posts
Route::get('posts', [PostController::class, 'index']);

//ajouter un post / POST est utilisee lorsqu'on souhaite faire un ajout / PUT / PATCH est utilisee lorsqu'on souhaite faire des modifications
// Route::post('posts/create', [PostController::class, 'store']) ; // ici c'est pas parcequ'on souhaite utilise ajouter un post qu'on a utiisee la methode post dans ce cas ci la methode post est integre au developpemnt web
// Route::put('posts/edit/{id}', [PostController::class, 'update']); // 1er methode
// Route::put('posts/edit/{post}', [PostController::class, 'update']); // 2e methode
//supprimer un post
// Route::delete('posts/{post}',[PostController::class, 'delete']);
// inscrire un nouveau utilisateur
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function() {
    //Creer un post
    Route::post('posts/create', [PostController::class, 'store']) ;
    // Editer un post
    Route::put('posts/edit/{post}', [PostController::class, 'update']);
    // Supprimer un post
    Route::delete('posts/{post}',[PostController::class, 'delete']);
    // Retourner l'utilisateur actuellement connecté
    Route::get('/user', function (Request $request) {
        return $request->user();
});

});