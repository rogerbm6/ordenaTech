<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlbaranIdToUnidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unids', function (Blueprint $table) {
            //foranea de albaranes 
            $table->unsignedInteger('albaran_id')->nullable();
            $table->foreign('albaran_id')->references('id')->on('albarans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unids', function (Blueprint $table) {
            $table->dropForeign(['albaran_id']);
        });
    }
}
