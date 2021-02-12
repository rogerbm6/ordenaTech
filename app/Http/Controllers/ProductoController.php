<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Almacene;
use App\Producto;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Mail;
use App\Http\Requests\ProductoFormRequest;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        if (request()->ajax()) {
          return datatables()
          ->eloquent(Producto::query())
          //columna cliente
          ->addColumn('cliente', function ($producto) {
            return $producto->cliente->nombre;
          })
          //columna almacen
          ->addColumn('almacen', function ($producto) {
            return $producto->almacene->nombre;
          })
          ->addColumn('btn', 'productos/actions')
          ->rawColumns(['btn'])
          ->toJson();
        }

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

    public function store(ProductoFormRequest $request, Cliente $cliente)
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

        //variable usada en la vista blade 'mail_new_product'
        $info = ['producto' => $producto];
        //envio del email
        Mail::send('mail_new_product', $info, function ($message) use($producto){
          //envia email para el cliente
            $message->cc($producto->cliente->email, $producto->cliente->nombre)->subject('Administración OrdenaTech');
          //envia email a administración
            $message->bcc(config('app.admin.reply'), config('app.admin.user'));
          //info del que envia
            $message->from(config('app.admin.mail'), config('app.admin.user'));
        });

        //redirige a show
        return redirect()->action('ProductoController@show', ['producto'=>$producto])->with('info', 'producto agregado correctamente');
    }


    public function edit(Producto $producto)
    {
        $almacenes=Almacene::all();

        return view('productos/edit', ['producto'=>$producto, 'almacenes'=>$almacenes]);
    }

    public function update(Producto $producto, ProductoFormRequest $request)
    {
        if ($producto->almacene->id != $request->input('almacen')) {
            //almacen antiguo
            $almacen_antiguo=$producto->almacene;

            //quita el almacen que tiene
            $producto->almacene()->dissociate($producto->almacene);
            //agrega el nuevo almacen
            $producto->almacene()->associate(Almacene::find($request->input('almacen')));
            $producto->update($request->all());

            //envia email a el almacen para que envien el producto al nuevo almacen
            $info = ['producto' => $producto, 'almacen_antiguo' => $almacen_antiguo];

            Mail::send('mail_change_almacen', $info, function ($message) use($almacen_antiguo){
              //envia email para el cliente
              $message->cc($almacen_antiguo->email, $almacen_antiguo->nombre)->subject('Administración OrdenaTech');
              //envia email a administración
              $message->bcc(config('app.admin.reply'), config('app.admin.user'));
              //info del que envia
              $message->from(config('app.admin.mail'), config('app.admin.user'));

            });

            //correo electronico al almacen donde se enviará el producto
            Mail::send('mail_changed_almacen', $info, function ($message) use($producto){
              //envia email para el cliente
              $message->cc($producto->almacene->email, $producto->almacene->nombre)->subject('Administración OrdenaTech');
              //envia email a administración
              $message->bcc(config('app.admin.reply'), config('app.admin.user'));
              //info del que envia
              $message->from(config('app.admin.mail'), config('app.admin.user'));

            });

        }


        //si hay menos de 3 envia un email a los administradores
        if ($producto->cantidad <= $producto->cantidad_minima ) {
          //variable usada en la vista blade 'mail'
            $info = ['producto' => $producto];

            if ($producto->cantidad == 0) {

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


        return redirect()->action('ProductoController@show', ['producto'=>$producto])->with('info', 'producto actualizado correctamente');

    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->action('ProductoController@index')->with('info', 'producto eliminado correctamente');

    }


}
