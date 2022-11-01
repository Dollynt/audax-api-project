<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ArticleController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//----------------USER CRUD-----------------//
    /////// Rota POST criar usuário ///////
    Route::post('/user', [UserController::class, 'store'])->name('user.store');

    /////// Rota GET lista de usuários ///////
    Route::get('/user', [UserController::class, 'list'])->name('user.list');

    /////// Rota GET obter usuário ///////
    Route::get('/user/{uuid}', [UserController::class, 'get_user'])->name('user.get_user');

    /////// Rota PUT atualizar usuário ///////
    Route::put('/user/{uuid}', [UserController::class, 'update'])->name('user.update');

    /////// Rota DELETE deletar usuário ///////
    Route::delete('/user/{uuid}', [UserController::class, 'delete'])->name('user.delete');
//------------------------------------------//

    Route::get('/teste', [ArticleController::class, 'teste'])->name('user.teste');
    


//----------------ARTICLE CRUD-----------------//
    /////// Rota POST criar artigo ///////
    Route::post('/article', [ArticleController::class, 'store'])->name('article.store');

    /////// Rota GET lista de artigos ///////
    Route::get('/article', [ArticleController::class, 'list'])->name('article.list');

    /////// Rota GET obter artigo ///////
    Route::get('/article/{uuid}', [ArticleController::class, 'get_article'])->name('article.get_article');

    /////// Rota PUT atualizar artigo ///////
    Route::put('/article/{uuid}', [ArticleController::class, 'update'])->name('article.update');

    /////// Rota DELETE deletar artigo ///////
    Route::delete('/article/{uuid}', [ArticleController::class, 'delete'])->name('article.delete');