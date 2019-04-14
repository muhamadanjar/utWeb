<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TmLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_link', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_link');
            $table->string('url_link');
            $table->string('logo_link');
            $table->string('kategori');
            $table->integer('aktif');
            $table->integer('update_by');
            $table->date('update_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("tm_link");
    }
}
