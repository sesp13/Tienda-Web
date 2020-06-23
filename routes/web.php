<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/usuario/editar/{id}', "UserController@edit")->name('user.edit');
Route::get('/usuario/perfil', "UserController@profile")->name('user.profile');
Route::post('/usuario/actualizar', "UserController@update")->name('user.update');
Route::get('/mail', "UserController@mail");

//Rutas de administradores
Route::get('/admin','AdminController@index')->name('admin.index');
Route::get('/admin/usuarios','AdminController@users')->name('admin.users');
Route::get('admin/usuarios/cambiar-estado/{id}','AdminController@changeUserState')->name('admin.change-state');