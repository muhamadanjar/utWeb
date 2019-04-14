<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JalanFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('jalan_file', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jalan_id')->unsigned();
            $table->string('namafile');
            $table->string('keterangan');

            $table->foreign('jalan_id')->references('id')->on('jalan')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jalan_file');
    }
}
