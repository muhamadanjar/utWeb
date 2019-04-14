<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Jalan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jalan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_ruas');
            $table->string('nama_ruas');
            $table->string('kode_kec');
            $table->double('panjang');
            $table->double('lebar');
            $table->integer('jumlah_lajur');

            $table->float('ptjp_aspal')->nullable();
            $table->float('ptjp_beton')->nullable();
            $table->float('ptjp_kerikil')->nullable();
            $table->float('ptjp_tanah')->nullable();

            $table->float('ptk_baik_persentase')->nullable();
            $table->float('ptk_baik_km')->nullable();
            $table->float('ptk_sedang_persentase')->nullable();
            $table->float('ptk_sedang_km')->nullable();
            $table->float('ptk_rusakringan_persentase')->nullable();
            $table->float('ptk_rusakringan_km')->nullable();
            $table->float('ptk_rusakberat_persentase')->nullable();
            $table->float('ptk_rusakberat_km')->nullable();

            $table->string('lhr_rata')->nullable();
            $table->string('akses_jalan');

            $table->double('pangkal_latitude', 18, 15);
            $table->double('pangkal_longitude', 18, 15);
            $table->double('ujung_latitude', 18, 15);
            $table->double('ujung_longitude', 18, 15);

            $table->string('no_ruas_pangkal')->nullable();
            $table->string('no_ruas_ujung')->nullable();
            $table->string('pembiayaan')->nullable();
            $table->double('biaya')->nullable();

            $table->integer('tahun')->nullable();
            $table->text('ket')->nullable();
            $table->boolean('isverified')->nullable();
            $table->text('geojson')->nullable();
            $table->string('jenis_penanganan')->nullable();
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
        Schema::dropIfExists("jalan");
    }
}
