<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Producto;
use App\Unid;
use Mail;



class UnidController extends Controller
{
    
    public function updateUnid($unid, Request $request)
    {

        $unidad = Unid::find($unid);
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
        return redirect()->action('ProductoController@show', ['producto'=>$unidad->producto])
                        ->withErrors($validator)
                        ->withInput();
        }

        $unidad->update($request->all());
        
        return redirect()->route('producto.show', ['producto'=>$unidad->producto])->with('info', 'unidad actualizada');

    }


    public function destroy($unid)
    {
        $unidad = Unid::find($unid);
        $producto= $unidad->producto;
        $unidad->delete();

        //si hay menos de la cantidad minima envia un email a los administradores y el cliente
        if (count($producto->unids) <= $producto->cantidad_minima ) {
            //variable usada en la vista blade 'mail'
            $info = ['producto' => $producto];

            if (count($producto->unids) == 0) {

                Mail::send('mail_without_product', $info, function ($message) use($producto){
                  //envia email para el cliente
                $message->cc($producto->cliente->email, $producto->cliente->nombre)->subject('Administración OrdenaTech');
                  //envia email a administración
                $message->bcc(config('app.admin.reply'), config('app.admin.user'));
                  //info del que envia
                $message->from(config('app.admin.mail'), config('app.admin.user'));

                return redirect()->action('ProductoController@show', ['producto'=>$producto])->with('info', 'producto actualizado correctamente');
                });
            }
            Mail::send('mail', $info, function ($message) use($producto){
                  //envia email para el cliente
                $message->cc($producto->cliente->email, $producto->cliente->nombre)->subject('Administración OrdenaTech');
                  //envia email a administración
                $message->bcc(config('app.admin.reply'), config('app.admin.user'));
                  //info del que envia
                $message->from(config('app.admin.mail'), config('app.admin.user'));
            });
        }

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
