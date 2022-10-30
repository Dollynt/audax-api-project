<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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

Route::get('/user/list', [UserController::class, 'list'])->name('user.list');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{uuid}', [UserController::class, 'edit'])->name('user.edit');
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/login', [UserController::class, 'auth'])->name('user.auth');


Route::get('/', [UserController::class, 'login'])->name('user.login');
    

