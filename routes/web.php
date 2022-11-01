<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*

Route::group(['middleware' =>['alreadyLoggedIn']], function () {
    
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/', [UserController::class, 'login'])->name('user.login');
});

Route::group(['middleware' =>['isLoggedIn']], function () {
    Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/user/{uuid}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{uuid}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{uuid}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('/user', [UserController::class, 'list'])->name('user.list');

    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article', [ArticleController::class, 'store'])->name('article.store');
    
});


Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::post('/user/login', [UserController::class, 'auth'])->name('user.auth');

*/

