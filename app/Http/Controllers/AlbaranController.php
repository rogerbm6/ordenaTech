<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Albaran;
use App\Unid;
use App\Producto;
use App\Http\Requests\AlbaranFormRequest;

class AlbaranController extends Controller
{
    public function store(Producto $producto, AlbaranFormRequest $request)
    {
        
        if ($request->hasFile('ruta')) {
            if ($request->file('ruta')->isValid()) {
                //cre albaran
                $albaran = new Albaran();
                //agrega todos los campos
                $albaran->fill($request->all());

                $extension = $request->file('ruta')->extension();
                $albaran->ruta = "$albaran->referencia.$extension";

                $request->file('ruta')->storeAs(
                'albaranes',
                $albaran->id.'.'.$albaran->referencia.'.'.$extension,
                ['disk'=>'public']
                );
                //guarda
                $albaran->save(); 
            }
        }
        


        //redirige a show
        return redirect()->action('ProductoController@show', ['producto'=>$producto])->with('info', 'albaran agregado correctamente');
    }
}
