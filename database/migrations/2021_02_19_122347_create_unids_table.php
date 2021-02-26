<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_serie',12);
            $table->enum('estado', ['usado', 'nuevo', 'averiado', 'doa']);
            $table->string('notas',1000);
            //foranea de productos 
            $table->unsignedInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unids');
    }
}
//$excel = Cliente::join("productos as p", "clientes.id", "=", "p.cliente_id")->join("almacenes as a", "p.almacene_id", "=", "a.id")->join("unids as u", "p.id", "=", "u.producto_id")->select("p.nombre","u.numero_serie as N/S","p.part_number as P/N","p.incidencia","p.modelo","p.marca","p.ubicacion","u.estado","u.notas as UnidadNotas","p.notas as ProductoNotas","clientes.nombre as Cliente","clientes.tipo","clientes.email","clientes.telefono","clientes.direccion", "a.nombre as Almacen", "a.email as AlmacenEmail","a.direccion as AlmacenDireccion","a.cp","a.isla")->get()