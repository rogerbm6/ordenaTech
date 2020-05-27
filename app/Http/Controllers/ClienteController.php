<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Producto;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ClienteFormRequest;

class ClienteController extends Controller
{
  public function index()
  {
      $clientes = Cliente::all();


      if (request()->ajax()) {
        return datatables()
        ->eloquent(Cliente::query())
        ->addColumn('btn', 'clientes/actions')
        ->rawColumns(['btn'])
        ->toJson();
      }

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
  public function store(ClienteFormRequest $request)
  {
      $cliente = Cliente::create($request->all());

      if ($request->input('direccion'))
      {
        $cliente->direccion=$request->input('direccion');
        $cliente->save();
      }


      return redirect()->action('ClienteController@show', ['cliente'=>$cliente])->with('info', 'cliente agregado correctamente');;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Cliente $cliente)
  {
    if (request()->ajax()) {
      $productos= $cliente->productos;
      return Datatables::of($productos)
      ->addColumn('almacen', function ($producto) {
        return $producto->almacene->nombre;
      })
      ->addColumn('btn', 'clientes/actionshow')
      ->rawColumns(['btn'])
      ->make(true);
    }
      return view('clientes/show', ['cliente'=>$cliente]);
  }


  public function edit(Cliente $cliente)
  {
      return view('clientes/edit', ['cliente'=>$cliente]);
  }



  public function update(Cliente $cliente, ClienteFormRequest $request)
  {
      $cliente->direccion=$request->input('direccion');
      $cliente->update($request->all());

      return redirect()->action('ClienteController@show', ['cliente'=>$cliente])->with('info', 'cliente actualizado correctamente');

  }

  public function destroy(Cliente $cliente)
  {
      $cliente->delete();

      return redirect()->action('ClienteController@index')->with('info', 'cliente borrado correctamente');

  }



    public function exportPdf(Cliente $cliente)
    {
        $pdf = PDF::loadView('pdf.cliente', ['cliente' => $cliente]);

        return $pdf->download("Productos_$cliente->nombre.pdf");

    }


}
