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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//Rutas de Usuarios
Route::get('/confirmar-contraseña/{token}',"UserController@confirm")->name('user.confirm');
Route::get('/sin-confirmar', "UserController@unconfirmed")->name('user.unconfirmed');
Route::get('/deshabilitado', "UserController@inactive")->name('user.inactive');
Route::get('/usuario/editar/{id}', "UserController@edit")->name('user.edit');
Route::get('/usuario/perfil', "UserController@profile")->name('user.profile');
Route::post('/usuario/actualizar', "UserController@update")->name('user.update');
Route::get('/mail', "UserController@mail");

//Rutas de administradores
Route::get('/admin','AdminController@index')->name('admin.index');
Route::get('/admin/usuarios','AdminController@users')->name('admin.users');
Route::post('/admin/usuarios/buscar',"AdminController@loadSearch")->name('admin.users.load');
Route::get('/admin/usuarios/buscar/{search}','AdminController@userSearch')->name('admin.users.search');
Route::get('admin/usuarios/cambiar-estado/{id}/{search?}','AdminController@changeUserState')->name('admin.change-state');

// Rutas de reportes de usuario para administradores
Route::get('/admin/usuarios/sin-confirmar','AdminController@usersUnconfirmed')->name('admin.users-unconfirmed');
Route::get('/admin/usuarios/confirmados','AdminController@usersConfirmed')->name('admin.users-confirmed');
Route::get('/admin/usuarios/deshabilitados','AdminController@usersInactive')->name('admin.users-inactive');
Route::get('/admin/usuarios/habiltados','AdminController@usersActive')->name('admin.users-active');
