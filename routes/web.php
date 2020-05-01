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


//rutas con Autenticación
Route::middleware(['auth'])->group(function () {
    /*-------------------Roles------------------*/
    //crear rol (post)
      Route::post('roles/store', 'RoleController@store')->name('roles.store')
            ->middleware('permission:roles.create');
    //Crea rol (get)
      Route::get('roles/create', 'RoleController@create')->name('roles.create')
            ->middleware('permission:roles.create');
    //Muesta roles
      Route::get('roles', 'RoleController@index')->name('roles.index')
            ->middleware('permission:roles.index');
    //muestra un rol
      Route::get('roles/{rol}', 'RoleController@show')->name('roles.show')
            ->middleware('permission:roles.show');
    //actualiza un rol
      Route::put('roles/{rol}', 'RoleController@update')->name('roles.update')
            ->middleware('permission:roles.edit');
    //formulario de actualizar
      Route::post('roles/{rol}/edit', 'RoleController@edit')->name('roles.edit')
            ->middleware('permission:roles.edit');
    //Elimina un rol
      Route::delete('roles/{rol}', 'RoleController@destroy')->name('roles.destroy')
            ->middleware('permission:roles.destroy');

    /*-------------------Productos------------------*//*
    //crear producto (post)
      Route::post('producto/store', 'ProductoController@store')->name('producto.store')
            ->middleware('permission:producto.create');
    //Crea producto (get)
      Route::get('producto/create', 'ProductoController@create')->name('producto.create')
            ->middleware('permission:producto.create');
    //Muesta productos
      Route::get('producto', 'ProductoController@index')->name('producto.index')
            ->middleware('permission:producto.index');
    //muestra un producto
      Route::get('producto/{producto}', 'ProductoController@show')->name('producto.show')
            ->middleware('permission:producto.show');
    //actualiza un producto
      Route::put('producto/{producto}', 'ProductoController@update')->name('producto.update')
            ->middleware('permission:producto.edit');
    //formulario de actualizar
      Route::post('producto/{producto}/edit', 'ProductoController@edit')->name('producto.edit')
            ->middleware('permission:producto.edit');
    //Elimina un producto
      Route::delete('producto/{producto}', 'ProductoController@destroy')->name('producto.destroy')
            ->middleware('permission:producto.destroy');*/

    /*-------------------Almacenes------------------*/
    //crear almacen (post)
      Route::post('almacen/store', 'AlmacenController@store')->name('almacenes.store')
            ->middleware('permission:almacenes.create');
    //Crea almacen (get)
      Route::get('almacen/create', 'AlmacenController@create')->name('almacenes.create')
            ->middleware('permission:almacenes.create');
    //Muesta almacen
      Route::get('almacen', 'AlmacenController@index')->name('almacenes.index')
            ->middleware('permission:almacenes.index');
    //muestra un almacen
      Route::get('almacen/{almacen}', 'AlmacenController@show')->name('almacenes.show')
            ->middleware('permission:almacenes.show');
    //actualiza un almacen
      Route::put('almacen/{almacen}', 'AlmacenController@update')->name('almacenes.update')
            ->middleware('permission:almacenes.edit');
    //formulario de actualizar
      Route::post('almacen/{almacen}/edit', 'AlmacenController@edit')->name('almacenes.edit')
            ->middleware('permission:almacenes.edit');
    //Elimina un almacen
      Route::delete('almacen/{almacen}', 'AlmacenController@destroy')->name('almacenes.destroy')
            ->middleware('permission:almacenes.destroy');

    /*-------------------Clientes------------------*/
    //crear cliente (post)
      Route::post('cliente/store', 'ClienteController@store')->name('clientes.store')
            ->middleware('permission:clientes.create');
    //Crea cliente (get)
      Route::get('cliente/create', 'ClienteController@create')->name('clientes.create')
            ->middleware('permission:clientes.create');
    //Muesta cliente
      Route::get('cliente', 'ClienteController@index')->name('clientes.index')
            ->middleware('permission:clientes.index');
    //muestra un cliente
      Route::get('cliente/{cliente}', 'ClienteController@show')->name('clientes.show')
            ->middleware('permission:clientes.show');
    //actualiza un cliente
      Route::put('cliente/{cliente}', 'ClienteController@update')->name('clientes.update')
            ->middleware('permission:clientes.edit');
    //formulario de actualizar
      Route::post('cliente/{cliente}/edit', 'ClienteController@edit')->name('clientes.edit')
            ->middleware('permission:clientes.edit');
    //Elimina un producto
      Route::delete('cliente/{cliente}', 'ClienteController@destroy')->name('clientes.destroy')
            ->middleware('permission:clientes.destroy');

    /*-------------------Usuarios------------------*/
    //Muesta user
      Route::get('user', 'UserController@index')->name('user.index')
            ->middleware('permission:user.index');
    //muestra un user
      Route::get('user/{user}', 'UserController@show')->name('user.show')
            ->middleware('permission:user.show');
    //actualiza un user
      Route::put('user/{user}', 'UserController@update')->name('user.update')
            ->middleware('permission:user.edit');
    //formulario de actualizar
      Route::post('user/{user}/edit', 'UserController@edit')->name('user.edit')
            ->middleware('permission:user.edit');
    //Elimina un user
      Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy')
            ->middleware('permission:user.destroy');
});
