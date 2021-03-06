<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',45);
            
            $table->string('part_number',12);
            $table->string('incidencia',12);
            $table->string('marca',12);
            $table->string('modelo',35);
            $table->string('ubicacion',70);
            

            $table->integer('cantidad_minima');
            $table->string('notas',1000);
            //foranea de clientes
            $table->unsignedInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            //foranea de almacenes
            $table->unsignedInteger('almacene_id');
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
        Schema::dropIfExists('productos');
    }
}
