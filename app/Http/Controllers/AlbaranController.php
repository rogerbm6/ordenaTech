<?php

namespace App\Http\Controllers;


use App\Albaran;
use App\Unid;
use App\Producto;
use App\Http\Requests\AlbaranFormRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use File;

class AlbaranController extends Controller
{
    public function index()
    {
        $albaranes = Albaran::all();

        if (request()->ajax()) {
            return datatables()
            ->eloquent(Albaran::query())
            ->addColumn('fecha', function ($albaran) {
                return $albaran->created_at->format('d-m-Y');
            })
            ->addColumn('btn', 'albaranes/actions')
            ->rawColumns(['btn'])
            ->toJson();
        }

        return view('albaranes/index', ['albaranes'=>$albaranes]);
    }

    public function create()
    {
        return view('albaranes/create');
    }

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


    public function normalStore(AlbaranFormRequest $request)
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
        return redirect()->action('AlbaranController@show', ['albaran'=>$albaran])->with('info', 'albaran agregado correctamente');
    }

    public function show(Albaran $albaran)
    {
        if (request()->ajax()) {
            $unids= $albaran->unids;
            return Datatables::of($unids)
            ->addColumn('numero_serie', function ($unid) {
                return $unid->numero_serie;
            })
            ->addColumn('part_number', function ($unid) {
                return $unid->producto->part_number;
            })
            ->addColumn('incidencia', function ($unid) {
                return $unid->producto->incidencia;
            })
            ->addColumn('modelo', function ($unid) {
                return $unid->producto->modelo;
            })
            ->addColumn('nombre', function ($unid) {
                return $unid->producto->nombre;
            }) 
            ->addColumn('marca', function ($unid) {
                return $unid->producto->marca;
            })
            ->make(true);
        }

        return view('albaranes/show', ['albaran'=>$albaran]);
    }

    public function edit(Albaran $albaran)
    {
        return view('albaranes/edit', ['albaran'=>$albaran]);
    }

    public function update(Albaran $albaran, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'referencia'    => 'required|max:45',
            'ruta'          => 'mimes:jpeg,png,jpg,gif,pdf|max:2048'
        ], 
        [
            'required'  => 'Es necesario completar el formulario con :attribute',
            'ruta.max'  => 'El campo :attribute solo puede ser una imagen de :max',
            'ruta.mimes'    => 'El campo :attribute solo puede ser de tipos jpeg,png,jpg,gif'
        ]);

        if ($validator->fails()) {
        return redirect()->action('AlbaranController@edit', ['albaran'=>$albaran])
                        ->withErrors($validator)
                        ->withInput();
        }
        $albaran->fill($request->all());
        if ($request->hasFile('ruta')) {
            if ($request->file('ruta')->isValid()) {
                //agrega todos los campos
                Storage::disk('public')->delete('albaranes/'.$albaran->ruta);

                $time=time();
                $extension = $request->file('ruta')->extension();
                $albaran->ruta = "$time.$albaran->referencia.$extension";

                $request->file('ruta')->storeAs(
                'albaranes',
                $time.'.'.$albaran->referencia.'.'.$extension,
                ['disk'=>'public']
                );
                //guarda
            }
        }
        //actualiza la referencia
        
        $albaran->save();

        return redirect()->action('AlbaranController@show', ['albaran'=>$albaran])->with('info', 'albaran actualizado correctamente');

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

    public function destroy(Albaran $albaran)
    {
        Storage::disk('public')->delete('albaranes/'.$albaran->ruta);
        $albaran->delete();

        return redirect()->action('AlbaranController@index')->with('eliminar', 'si');

    }

}
