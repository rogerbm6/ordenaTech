<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbaranUnidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albaran_unid', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('albaran_id');
            $table->unsignedInteger('unid_id');
            $table->timestamps();
            
        });
    
        Schema::table('albaran_unid', function($table) {
            $table->foreign('albaran_id')->references('id')->on('albarans');
            $table->foreign('unid_id')->references('id')->on('unids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albaran_unid');
    }
}
