<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Almacene;

use Yajra\DataTables\Facades\DataTables;

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
      if (request()->ajax()) {
        $productos= $almacen->productos;
        return Datatables::of($productos)
        ->addColumn('cliente', function ($producto) {
          return $producto->cliente->nombre;
        })
        ->addColumn('btn', 'almacenes/actionshow')
        ->rawColumns(['btn'])
        ->make(true);
      }

      return view('almacenes/show', ['almacen'=>$almacen]);
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
