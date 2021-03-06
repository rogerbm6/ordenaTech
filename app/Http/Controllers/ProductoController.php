<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Almacene;
use App\Producto;
use App\User;
use App\Unid;
use Caffeinated\Shinobi\Models\Role;
use Mail;
use App\Http\Requests\ProductoFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\ProductExport;

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
        $almacenes= Almacene::all();
        return view('productos/show', ['producto'=>$producto, 'almacenes'=>$almacenes]);
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
        $producto->update($request->all());
/*
        */


        return redirect()->action('ProductoController@show', ['producto'=>$producto])->with('info', 'producto actualizado correctamente');

    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->action('ProductoController@index')->with('eliminar', 'si');

    }

    public function almacen(Producto $producto, Request $request)
    {
        //valida la cantidad, tiene que haber al menos 1 
        $validator = Validator::make($request->all(), [
          'unidades' => 'required|min:1',
          'almacen'  => 'required',
        ], 
        [
          'required' => 'es necesario llenar :attribute',
          'min'      => 'la cantidad minima que se puede transportar es 1',
        ]);

        if ($validator->fails()) {
          return redirect()->action('ProductoController@show', ['producto'=>$producto])
                      ->withErrors($validator)
                      ->withInput();
        }
        //almacen nuevo
        $almacen = Almacene::find($request->get('almacen'));
        $unids=[];
        //compara el producto con todos los del almacen para no duplicar
        foreach ($almacen->productos as $producto_almacen) {
          if ($producto_almacen->part_number   ==   $producto->part_number && 
              $producto_almacen->incidencia    ==   $producto->incidencia && 
              $producto_almacen->nombre        ==   $producto->nombre && 
              $producto_almacen->marca         ==   $producto->marca && 
              $producto_almacen->cliente->id   ==   $producto->cliente->id) {
          
          //desasocia las unidades del producto para asociarlo a el nuevo
          foreach ($request->get('unidades') as $unidad) {
            $unid=Unid::find($unidad);
            $unid->producto()->dissociate($producto);
            $unid->producto()->associate($producto_almacen);
            $unid->save();
            array_push($unids,$unid);
          }
          //Envio de email a el almacen antiguo
          $info1 = ['almacen' => $producto->almacen, 'producto' => $producto, 'almacen_nuevo' => $almacen, 'unids'=>$unids];

          Mail::send('mail_send_unids', $info1, function ($message) use($producto){
            //envia email para el cliente
            $message->cc($producto->almacene->email, $producto->almacene->nombre)->subject('Administración OrdenaTech');
            //envia email a administración
            $message->bcc(config('app.admin.reply'), config('app.admin.user'));
            //info del que envia
            $message->from(config('app.admin.mail'), config('app.admin.user'));

          });

          
          //Email al que recibe el producto 
          Mail::send('mail_arrive_unids', $info1, function ($message) use($producto_almacen){
            //envia email para el cliente
            $message->cc($producto_almacen->almacene->email, $producto_almacen->almacene->nombre)->subject('Administración Ordenatech');
            //envia email a administración
            $message->bcc(config('app.admin.reply'), config('app.admin.user'));
            //info del que envia
            $message->from(config('app.admin.mail'), config('app.admin.user'));
          });

          return redirect()->action('ProductoController@show', ['producto'=>$producto_almacen])->with('info', 'unidad enviada correctamente');

          }
        }
        
        //crea producto
        $producto_cambio = $producto->replicate();
        $producto_cambio->almacene()->dissociate($producto_cambio->almacene);
        //asocia el cliente
        $producto_cambio->cliente()->associate($producto->cliente);
        //asocia el almacén sacado del formulario
        $producto_cambio->almacene()->associate(Almacene::find($request->input('almacen')));
        $producto_cambio->save();
        //desasocia las unidades del producto para asociarlo a el nuevo
        foreach ($request->get('unidades') as $unidad) {
          $unid=Unid::find($unidad);
          $unid->producto()->dissociate($producto);
          $unid->producto()->associate($producto_cambio);
          $unid->save();
          array_push($unids,$unid);
        }
        //data for email
        $info = ['almacen' => $producto->almacen, 'producto' => $producto, 'almacen_nuevo' => $almacen, 'unids'=>$unids];

        //email a el que envia (email to sender)
        Mail::send('mail_send_unids', $info, function ($message) use($producto){
          //envia email para el cliente
          $message->cc($producto->almacene->email, $producto->almacene->nombre)->subject('Administración OrdenaTech');
          //envia email a administración
          $message->bcc(config('app.admin.reply'), config('app.admin.user'));
          //info del que envia
          $message->from(config('app.admin.mail'), config('app.admin.user'));

        });
        //email al que recibe 
          //Email al que recibe el producto 
        Mail::send('mail_arrive_unids', $info, function ($message) use($producto_cambio){
        //envia email para el cliente
        $message->cc($producto_cambio->almacene->email, $producto_cambio->almacene->nombre)->subject('Administración Ordenatech');
        //envia email a administración
        $message->bcc(config('app.admin.reply'), config('app.admin.user'));
        //info del que envia
        $message->from(config('app.admin.mail'), config('app.admin.user'));
      });

        //redirige a show
        return redirect()->action('ProductoController@show', ['producto'=>$producto_cambio])->with('info', 'almacen actualizado correctamente');
    }
  
    public function exportExcel()
    {
      return Excel::download(new ProductExport, 'AllProductos-list.xlsx');
    }
}
