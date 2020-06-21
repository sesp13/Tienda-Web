<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas de Usuarios
Route::get('/confirmar-contraseña/{token}',"UserController@confirm")->name('user.confirm');
Route::get('/sin-confirmar', "UserController@unconfirmed")->name('user.unconfirmed');