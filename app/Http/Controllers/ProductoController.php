<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Almacene;
use App\Producto;


class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        return view('productos/index', ['productos'=>$productos]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return view('productos/show', ['producto'=>$producto]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function redirect()
    {
        $mensaje='Para agregar un producto necesitas elegir al cliente';
        return redirect()->route('clientes.index')->with('info', $mensaje);
    }

    public function create(Cliente $cliente)
    {
        $almacenes = Almacene::all();
        return view('productos/create', ['cliente'=>$cliente , 'almacenes'=>$almacenes]);
    }

    public function store(Request $request, Cliente $cliente)
    {
        //crea producto
        $producto = new Producto();
        //asocia el cliente sacado de la ruta
        $producto->cliente()->associate($cliente);
        //asocia el almacén sacado del formulario
        $producto->almacene()->associate(Almacene::find($request->input('almacen')));
        //agrega todos los campos
        $producto->fill($request->all());
        //guarda
        $producto->save();
        //redirige a show
        return redirect()->action('ProductoController@show', ['producto'=>$producto])->with('info', 'producto agregado correctamente');
    }


    public function edit(Producto $producto)
    {
        $almacenes=Almacene::all();

        return view('productos/edit', ['producto'=>$producto, 'almacenes'=>$almacenes]);
    }

    public function update(Producto $producto, Request $request)
    {
        if ($producto->almacene->id != $request->input('almacen')) {
            //quita el almacen que tiene
            $producto->almacene()->dissociate($producto->almacene);
            //agrega el nuevo almacen
            $producto->almacene()->associate(Almacene::find($request->input('almacen')));
        }
        $producto->update($request->all());

        return redirect()->action('ProductoController@show', ['producto'=>$producto])->with('info', 'producto actualizado correctamente');

    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->action('ProductoController@index')->with('info', 'producto eliminado correctamente');

    }

}
