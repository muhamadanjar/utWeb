<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LayerInformasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layer_informasi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',60);
            $table->string('layername',60);
            $table->integer('layerid');
            $table->string('display',10);
            $table->text('description')->nullable();
            $table->text('keydata')->nullable();
            $table->text('media')->nullable();
            $table->boolean('showattachments');
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
        Schema::dropIfExists('layer_informasi');
    }
}
