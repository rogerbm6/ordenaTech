<?php

namespace App\Http\Controllers;


use App\Albaran;
use App\Unid;
use App\Producto;
use App\Http\Requests\AlbaranFormRequest;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use File;

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
                $time=time();
                $extension = $request->file('ruta')->extension();
                $albaran->ruta = "$time.$albaran->referencia.$extension";

                $request->file('ruta')->storeAs(
                'albaranes',
                $time.'.'.$albaran->referencia.'.'.$extension,
                ['disk'=>'public']
                );
                //guarda
                $albaran->save(); 
            }
        }
        


        //redirige a show
        return redirect()->action('ProductoController@show', ['producto'=>$producto])->with('info', 'albaran agregado correctamente');
    }

    public function search(Request $request)
    {
        //escrito en el buscador
        $term = $request->term;

        $query = Albaran::where('referencia', 'like', "%$term%")
                            ->orderBy('id', 'desc')
                            ->select('referencia as label')
                            ->get();
        return $query;
    }

    public function see(Albaran $albaran)
    {
            $file = Storage::disk('public')->get("albaranes/$albaran->ruta");
            return (new Response($file, 200))->header('Content-Type', 'image, jpeg, png');
    }

    public function associate(Unid $unidad, Request $request)
    {
        //escrito en el buscador
        if ((Albaran::where('referencia', $request->input('referencia'))->first())) {
            //if para desasociar albaran
            if ($unidad->albaran) {
                $albaran_antiguo= $unidad->albaran;
                $unidad->albaran()->dissociate($albaran_antiguo);
            }
            //vincula el albaran 
            $albaran = Albaran::where('referencia', $request->input('referencia'))->first();
            $unidad->albaran()->associate($albaran);
            $unidad->save();

            //$file = Storage::disk('public')->get("albaranes/$albaran->ruta");
            //return (new Response($file, 200))->header('Content-Type', 'image, jpeg, png');

            return redirect()->action('ProductoController@show', ['producto'=>$unidad->producto])->with('info', 'albaran sincornizado correctamente');
        }
        //si están mal los datos
        return redirect()->action('ProductoController@show', ['producto'=>$unidad->producto])->with('info', 'LOS DATOS INTRODUCIDOS NO SON CORRECTOS');
    }
}
