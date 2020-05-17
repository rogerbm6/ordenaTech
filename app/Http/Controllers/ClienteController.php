<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Producto;

class ClienteController extends Controller
{
  public function index()
  {
      $clientes = Cliente::all();

      return view('clientes/index', ['clientes'=>$clientes]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('clientes/create');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $cliente = Cliente::create($request->all());

      if ($request->input('direccion'))
      {
        $cliente->direccion=$request->input('direccion');
        $cliente->save();
      }

      return redirect()->action('ClienteController@show', ['cliente'=>$cliente]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Cliente $cliente)
  {
      return view('clientes/show', ['cliente'=>$cliente]);
  }


  public function edit(Cliente $cliente)
  {
      return view('clientes/edit', ['cliente'=>$cliente]);
  }



  public function update(Cliente $cliente, Request $request)
  {
      $cliente->direccion=$request->input('direccion');
      $cliente->update($request->all());

      return redirect()->action('ClienteController@show', ['cliente'=>$cliente]);

  }

  public function destroy(Cliente $cliente)
  {
      $cliente->delete();

      return redirect()->action('ClienteController@index');

  }
}
