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

//Rutas de administradores

//Gestion de usuarios
Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::get('/admin/usuarios', 'AdminController@users')->name('admin.users');
Route::post('/admin/usuarios/buscar', "AdminController@loadSearch")->name('admin.users.load');
Route::get('/admin/usuarios/buscar/{search}', 'AdminController@userSearch')->name('admin.users.search');
Route::get('admin/usuarios/cambiar-estado/{id}/{search?}', 'AdminController@changeUserState')
    ->name('admin.change-state');

// Rutas de reportes de usuario para administradores
Route::get('/admin/usuarios/sin-confirmar', 'AdminController@usersUnconfirmed')->name('admin.users-unconfirmed');
Route::get('/admin/usuarios/confirmados', 'AdminController@usersConfirmed')->name('admin.users-confirmed');
Route::get('/admin/usuarios/deshabilitados', 'AdminController@usersInactive')->name('admin.users-inactive');
Route::get('/admin/usuarios/habiltados', 'AdminController@usersActive')->name('admin.users-active');

//Gestion de categorías
Route::get('/admin/categorias', 'AdminController@categories')->name('admin.categories');
Route::get('/admin/crear-categoria', 'AdminController@categorieCreate')->name('admin.categories.create');
Route::post('/admin/crear-categoria', 'AdminController@categorieStore')->name('admin.categories.store');
Route::get('/admin/editar-categoria/{id}', 'AdminController@categoryEdit')->name('admin.categories.edit');
Route::post('/admin/editar-categoria', 'AdminController@categoryUpdate')->name('admin.categories.update');
Route::get('/admin/eliminar-categoria/{id}', 'AdminController@categoryDelete')->name('admin.categories.delete');
Route::post('/admin/buscar-categoria', 'AdminController@loadCategorySearch')->name('admin.categories.load-search');
Route::get('/admin/buscar-categoria/{id}', 'AdminController@categorySearch')->name('admin.categories.search');

//Gestion de productos
Route::get('/admin/productos', 'AdminController@products')->name('admin.products');
Route::get('admin/productos/cambiar-estado/{id}/{search?}', 'AdminController@changeProductState')
->name('admin.product.change-state');
Route::post('/admin/productos/buscar', 'AdminController@loadProductSearch')->name('admin.products.load-search');
Route::get('/admin/productos/{search}', 'AdminController@productSearch')->name('admin.products.search');
Route::get('/admin/crear-producto', 'AdminController@productCreate')->name('admin.products.create');
Route::post('/admin/crear-producto', 'AdminController@productStore')->name('admin.products.store');
Route::get('/admin/editar-producto/{id}', 'AdminController@productEdit')->name('admin.products.edit');
Route::post('/admin/editar-producto', 'AdminController@productUpdate')->name('admin.products.update');
Route::get('/admin/eliminar-producto/{id}', 'AdminController@productDelete')->name('admin.products.delete');


//Rutas de Usuarios
Route::get('/confirmar-contraseña/{token}', "UserController@confirm")->name('user.confirm');
Route::get('/sin-confirmar', "UserController@unconfirmed")->name('user.unconfirmed');
Route::get('/deshabilitado', "UserController@inactive")->name('user.inactive');
Route::get('/usuario/editar/{id}', "UserController@edit")->name('user.edit');
Route::get('/usuario/perfil', "UserController@profile")->name('user.profile');
Route::post('/usuario/actualizar', "UserController@update")->name('user.update');
Route::get('/mail', "UserController@mail");

//Rutas de categorías
Route::get('/categorias', "CategoryController@index")->name('categories.index');
Route::post('/buscar-categorias', "CategoryController@loadCategory")->name('categories.load-search');
Route::get('/categorias/{search}', "CategoryController@categorySearch")->name('categories.search');

//Rutas de productos
Route::get('/productos', "ProductController@index")->name('products.index');
Route::get('/producto/{id}', "ProductController@show")->name('products.show');
Route::post('/productos/buscar', "ProductController@loadSearch")->name('products.load-search');
Route::get('/productos/buscar/{search}', "ProductController@search")->name('products.search');
Route::get('/categoria/{id}', "ProductController@getProductsByCategory")->name('products.get-by-categorie');
Route::get('/imagen-producto/{filename?}', "ProductController@getImage")->name('products.get-image');
