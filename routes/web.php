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


Auth::routes(['verify' => 'true']);


//rutas con Autenticación
Route::middleware(['auth','verified'])->group(function () {
  Route::get('/home', 'HomeController@index')->name('home');
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
      Route::get('roles/{rol}/edit', 'RoleController@edit')->name('roles.edit')
            ->middleware('permission:roles.edit');
    //Elimina un rol
      Route::delete('roles/{rol}', 'RoleController@destroy')->name('roles.destroy')
            ->middleware('permission:roles.destroy');

    /*-------------------Productos------------------*/
    //crear producto (post)
      Route::post('producto/{cliente}/store', 'ProductoController@store')->name('producto.store')
            ->middleware('permission:productos.create');
    //Envía a clientes para agregar producto
      Route::get('producto/redirect', 'ProductoController@redirect')->name('producto.redirect')
            ->middleware('permission:productos.create');
    //Crea producto (get)
      Route::get('producto/{cliente}/create', 'ProductoController@create')->name('producto.create')
            ->middleware('permission:productos.create');
    //Muesta productos
      Route::get('producto', 'ProductoController@index')->name('producto.index')
            ->middleware('permission:productos.index');
    //muestra un producto
      Route::get('producto/{producto}', 'ProductoController@show')->name('producto.show')
            ->middleware('permission:productos.show');
    //actualiza un producto
      Route::put('producto/{producto}', 'ProductoController@update')->name('producto.update')
            ->middleware('permission:productos.edit');
    //actualiza el almacen de un producto
      Route::put('producto/{producto}/almacen', 'ProductoController@almacen')->name('producto.almacen')
            ->middleware('permission:productos.edit');

      //formulario de actualizar
      Route::get('producto/{producto}/edit', 'ProductoController@edit')->name('producto.edit')
            ->middleware('permission:productos.edit');
    //Elimina un producto
      Route::delete('producto/{producto}', 'ProductoController@destroy')->name('producto.destroy')
            ->middleware('permission:productos.destroy');


      /*-------------------Unnidades------------------*/
      //actualiza la unidad de un producto
      Route::put('producto/{unidad}/unidad', 'UnidController@updateUnid')->name('unid.update')
            ->middleware('permission:productos.edit');

      //elimina una unidad
      Route::delete('producto/unidad/delete/{unidad}', 'UnidController@destroy')->name('unid.destroy')
            ->middleware('permission:productos.destroy');

    //crear unidad (post)
      Route::post('producto/{producto}/unidad', 'UnidController@store')->name('unid.store')
            ->middleware('permission:productos.create');


      /*-------------------Albaran------------------*/
      //guarda un albaran
      Route::post('producto/albaran/{producto}', 'AlbaranController@store')->name('albaran.store')
      ->middleware('permission:productos.edit');
      //muestra albaranes vía ajax
      Route::get('search', 'AlbaranController@search')->name('albaran.search')
      ->middleware('permission:productos.show');      
      //asocia una unidad a un albaran
      Route::post('producto/unidad/{unidad}', 'AlbaranController@associate')->name('albaran.associate')
      ->middleware('permission:productos.edit');
      //ver albaran
      Route::get('see/{albaran}', 'AlbaranController@see')->name('albaran.see')
      ->middleware('permission:productos.show');

                  //Sección Albaran
      //crear albaran (post)
      Route::post('albaran/store', 'AlbaranController@normalStore')->name('albaran.normalStore')
      ->middleware('permission:productos.create');
      //Envía a clientes para agregar producto
      Route::get('albaran/redirect', 'AlbaranController@redirect')->name('albaran.redirect')
      ->middleware('permission:productos.create');
      //Crea producto (get)
      Route::get('albaran/create', 'AlbaranController@create')->name('albaran.create')
      ->middleware('permission:productos.create');
      //Muesta productos
      Route::get('albaran', 'AlbaranController@index')->name('albaran.index')
      ->middleware('permission:productos.index');
      //muestra un producto
      Route::get('albaran/{albaran}', 'AlbaranController@show')->name('albaran.show')
      ->middleware('permission:productos.show');
      //devuelve formulario de actualizar
      Route::get('albaran/{albaran}/edit', 'AlbaranController@edit')->name('albaran.edit')
      ->middleware('permission:productos.edit');
      //actualiza un producto
      Route::put('albaran/{albaran}', 'AlbaranController@update')->name('albaran.update')
      ->middleware('permission:productos.edit');
          //Elimina un almacen
      Route::delete('albaran/{albaran}', 'AlbaranController@destroy')->name('albaran.destroy')
      ->middleware('permission:productos.destroy');

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
      Route::get('almacen/{almacen}/edit', 'AlmacenController@edit')->name('almacenes.edit')
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
      Route::get('cliente/{cliente}/edit', 'ClienteController@edit')->name('clientes.edit')
            ->middleware('permission:clientes.edit');
    //Elimina un producto
      Route::delete('cliente/{cliente}', 'ClienteController@destroy')->name('clientes.destroy')
            ->middleware('permission:clientes.destroy');

    /*-------------------exports------------------- */
    //Descarga pdf de cliente
      Route::get('cliente/pdf/{cliente}', 'ClienteController@exportPdf')->name('clientes.pdf')
            ->middleware('permission:clientes.index');

    //Descarga Excel de todos los productos
      Route::get('productos/excel', 'ProductoController@exportExcel')->name('productos.excel')
            ->middleware('permission:productos.index');
    //Descarga Excel de todos los productos de un almacen
      Route::get('almacen/{almacen}/excel', 'AlmacenController@exportExcel')->name('almacenes.excel')
            ->middleware('permission:almacenes.index');
    //Descarga Excel de todos los productos de un cliente
      Route::get('cliente/{cliente}/excel', 'ClienteController@exportExcel')->name('clientes.excel')
            ->middleware('permission:clientes.index');

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
      Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit')
            ->middleware('permission:user.edit');
    //Elimina un user
      Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy')
            ->middleware('permission:user.destroy');


      Route::get('logout', 'Auth\LoginController@logout');
});

