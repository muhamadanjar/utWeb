<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JalanDetil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jalan_detil', function (Blueprint $table) {
            $table->increments('id');
            $table->float('dari_km');
            $table->float('sampai_km');
            $table->double('lebar');
            $table->string('type_jalan', 20);

            $table->integer('lajur_ke');
            $table->integer('pp_susunan');
            $table->integer('pp_kondisi');
            $table->integer('pp_penurunan');
            $table->integer('pp_tambalan');

            $table->integer('retak_jenis');
            $table->integer('retak_lebar');
            $table->integer('retak_luas');

            $table->integer('kl_jml_lubang');
            $table->integer('kl_ukuran_lubang');
            $table->integer('kl_bekas_roda');
            $table->integer('kl_kt_kiri');
            $table->integer('kl_kt_kanan');

            $table->integer('kss_kondisibahu_kiri');
            $table->integer('kss_kondisibahu_kanan');
            $table->integer('kss_permukaanbahu_kiri');
            $table->integer('kss_permukaanbahu_kanan');
            $table->integer('kss_kiri');
            $table->integer('kss_kanan');
            $table->integer('kss_kerusakanlereng_kiri');
            $table->integer('kss_kerusakanlereng_kanan');
            $table->integer('kss_trotoar_kiri');
            $table->integer('kss_trotoar_kanan');

            $table->integer('pp_kemiringan_melintang');
            $table->integer('pp_erosi_permukaan');

            $table->integer('kerikil_ukuranterbanyak');
            $table->integer('kerikil_teballapisan');
            $table->integer('kerikil_distribual');

            $table->integer('kl_bergelombang');

            $table->string('tipe_jalan', 10)->default('aspal');
            $table->integer('jalan_id');
            $table->string('no_ruas');
            $table->float('panjang')->nullable();
            
            $table->float('nilai_iri')->default(0);
            $table->float('nilai_sdi')->default(0);
            $table->float('k_baik')->default(0);
            $table->float('k_sedang')->default(0);
            $table->float('k_rusakringan')->default(0);
            $table->float('k_rusakberat')->default(0);
            $table->string('jenis_penanganan')->nullable()->default('Pemiliharaan Rutin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jalan_detil');
    }
}
