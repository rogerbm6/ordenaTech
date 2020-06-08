<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Almacene;
use App\Producto;
use App\Cliente;
use App\User;
use App\Charts\ProductosChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //datos del grafico estadisticas
        $almacenes    = Almacene::all();
        $productos    = DB::table('productos')->count();
        $clientes     = DB::table('clientes')->count();
        $usuarios     = DB::table('users')->count();
        $numAlmacenes = $almacenes->count();

        //datos del grafico tipo productos
        $productosUsados = Producto::where('estado', 'usado')->get();
        $productosNuevos = Producto::where('estado', 'nuevo')->get();
        $productosAveriados = Producto::where('estado', 'averiado')->get();
        $productosDoa = Producto::where('estado', 'doa')->get();


        //grafico tipos producto
        $tipoProducto = new ProductosChart;
        //tipos
        $tipoProducto->labels(['Usados','Nuevos','Averiados', 'DOA']);
        //nombre, tipo y datos a mostrar
        $tipoProducto->dataset('Estadisticas', 'doughnut', [$productosUsados->count(), $productosNuevos->count(), $productosAveriados->count(), $productosDoa->count()])->backgroundColor(['#f99add', '#a0aff6', '#cc9687', '#f6e66e']);
        //Titulo del gráfico
        $tipoProducto->title( 'Tipos de productos', 14,'black', true,"sans-serif");


        //datos de grafico almacenes
        $nombres=[];
        $cantidades=[];
        $colores=[];
        foreach ($almacenes as $almacen) {
          array_push($nombres, "$almacen->nombre");
          array_push($cantidades, $almacen->productos->count());
          array_push($colores, sprintf('#%06X', mt_rand(0, 0xFFFFFF)));
        }


        //grafico almacenesProductos
        $productosAlmacen = new ProductosChart;
        //barras
        $productosAlmacen->labels($nombres);
        //nombre, tipo y datos a mostrar
        $productosAlmacen->dataset('Almacenes', 'polarArea', $cantidades)->backgroundColor($colores);
        //Titulo del gráfico
        $productosAlmacen->title( 'Cantidad de productos en almacenes', 14,'black', true,"sans-serif");


        //grafico estadisticas
        $estadisticas = new ProductosChart;
        //barras
        $estadisticas->labels(['Productos','Clientes','Usuarios','Almacen']);
        //nombre, tipo y datos a mostrar
        $estadisticas->dataset('Estadisticas', 'bar', [$productos, $clientes, $usuarios,$numAlmacenes])->backgroundColor(['#f0bd80','#7eb867','#6ef1e6', '#f07471']);
        //Titulo del gráfico
        $estadisticas->title( 'Datos administrativos', 14,'black', true,"sans-serif");

        return view('home', ['almacenes' => $almacenes, 'chart'=>$estadisticas, 'productos'=>$tipoProducto, 'productosAlmacen'=>$productosAlmacen]);
    }
}
