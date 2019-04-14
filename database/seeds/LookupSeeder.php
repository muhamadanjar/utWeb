<?php

use Illuminate\Database\Seeder;

class LookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Lookup\Lookup::insert([
            ['id'=>'1','name' => 'Arteri Primer','type' => 'fungsi_jalan'],
            ['id'=>'2','name' => 'Arteri Sekunder','type' => 'fungsi_jalan'],
            ['id'=>'3','name' => 'Kolektor Primer','type' => 'fungsi_jalan'],
            ['id'=>'4','name' => 'Kolektor Sekunder','type' => 'fungsi_jalan'],
            ['id'=>'5','name' => 'Lingkungan','type' => 'fungsi_jalan'],
            ['id'=>'6','name' => 'Lingkar','type' => 'fungsi_jalan'],

            ['id'=>'7','name' => 'Jalan Nasional','type' => 'status_jalan'],
            ['id'=>'8','name' => 'Jalan Provinsi','type' => 'status_jalan'],
            ['id'=>'9','name' => 'Jalan Kabupaten','type' => 'status_jalan'],

            ['id'=>'10','name' => 'APBN','type' => 'sumber_pendanaan'],
            ['id'=>'11','name' => 'APBD-Provinsi','type' => 'sumber_pendanaan'],
            ['id'=>'12','name' => 'APBD-Kabupaten','type' => 'sumber_pendanaan'],
            ['id'=>'13','name' => 'Hibah','type' => 'sumber_pendanaan'],
            ['id'=>'14','name' => 'Sumber Dana Lainnya','type' => 'sumber_pendanaan'],

            ['id'=>'15','name' => 'Pemerintah','type' => 'pengelola'],
            ['id'=>'16','name' => 'Pemerintah Provinsi','type' => 'pengelola'],
            ['id'=>'17','name' => 'Pemerintah Kabupaten','type' => 'pengelola'],

            ['id'=>'18','name' => 'Baik','type' => 'kondisi'],
            ['id'=>'19','name' => 'Sedang','type' => 'kondisi'],
            ['id'=>'20','name' => 'Rusak','type' => 'kondisi'],
            ['id'=>'21','name' => 'Rusak Berat','type' => 'kondisi'],

            ['id'=>'22','name' => 'Pemeliharaan Rutin','type' => 'jenis_penaganan'],
            ['id'=>'23','name' => 'Pemeliharaan Berkala','type' => 'jenis_penaganan'],
            ['id'=>'24','name' => 'Pemeliharaan','type' => 'jenis_penaganan'],
        ]);
    }
}
