<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Producto;
use App\Unid;

class UnidController extends Controller
{
    
    public function updateUnid($unid, Request $request)
    {
        $unidad = Unid::find($unid);
        $unidad->update($request->all());
        
        return redirect()->route('producto.show', ['producto'=>$unidad->producto])->with('info', 'unidad actualizada');

    }


    public function destroy($unid)
    {
        $unidad = Unid::find($unid);
        $unidad->delete();

        return redirect()->route('producto.show', ['producto'=>$unidad->producto])->with('info', 'unidad borrada');

    }


    public function store(Producto $producto, Request $request)
    {

        //valida la cantidad, tiene que haber al menos 1 
        $validator = Validator::make($request->all(), [
            'estado'        => 'required',
            'numero_serie'  => 'required',
            'notas'         => 'required|min:1',
        ], 
        [
            'required'  => 'Es necesario completar el formulario con :attribute',
            'min'       => 'debe escribir por lo menos una palabra en :attribute',
        ]);

        if ($validator->fails()) {
        return redirect()->action('ProductoController@show', ['producto'=>$producto])
                        ->withErrors($validator)
                        ->withInput();
        }

        //crea producto
        $unidad= new Unid();
        $unidad->fill($request->all());
        //asocia
        $unidad->producto()->associate($producto);
        //guarda
        $unidad->save();

        //redirige a show
        return redirect()->route('producto.show', ['producto'=>$producto])->with('info', 'unidad creada');
    }

}
