<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Almacene;

class AlmacenController extends Controller
{
  public function index()
  {
      $almacenes = Almacene::all();

      return view('almacenes/index', ['almacenes'=>$almacenes]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Almacene $almacen)
  {
      $productos=$almacen->productos;

      return view('almacenes/show', ['almacen'=>$almacen, 'productos'=>$productos]);
  }

  public function create()
  {
      return view('almacenes/create');
  }

  public function store(Request $request)
  {
      $almacen = Almacene::create($request->all());

      return redirect()->action('AlmacenController@show', ['almacen'=>$almacen]);
  }

  public function edit(Almacene $almacen)
  {
      return view('almacenes/edit', ['almacen'=>$almacen]);
  }

  public function update(Almacene $almacen, Request $request)
  {
      $almacen->update($request->all());

      return redirect()->action('AlmacenController@show', ['almacen'=>$almacen]);

  }

  public function destroy(Almacene $almacen)
  {
      $almacen->delete();

      return redirect()->action('AlmacenController@index');

  }
}
