<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        App\Menu\Menu::insert([
            ['id'=>'1','title' => 'FPJ','parent_id' => '0','url'=>'','icon'=>'','order'=>'0','isactived'=>1],
            ['id'=>'2','title' => 'FST','parent_id' => '0','url'=>'','icon'=>'','order'=>'1','isactived'=>1],
            ['id'=>'3','title' => 'Dokumen','parent_id' => '0','url'=>'','icon'=>'','order'=>'2','isactived'=>1],
            ['id'=>'4','title' => 'Pengaturan','parent_id' => '0','url'=>'','icon'=>'','order'=>'3','isactived'=>1],

            ['id'=>'5','title' => 'Rambu Lalu lintas','parent_id' => '1','url'=>'','icon'=>'','order'=>'0','isactived'=>1],
            ['id'=>'6','title' => 'Marka Jalan','parent_id' => '1','url'=>'','icon'=>'','order'=>'1','isactived'=>1],
            ['id'=>'7','title' => 'Alat Penerangan','parent_id' => '1','url'=>'','icon'=>'','order'=>'2','isactived'=>1],
            ['id'=>'8','title' => 'APILL','parent_id' => '1','url'=>'','icon'=>'','order'=>'3','isactived'=>1],
            ['id'=>'9','title' => 'APPPJ','parent_id' => '1','url'=>'','icon'=>'','order'=>'4','isactived'=>1],
            ['id'=>'10','title' => 'Fasilitas','parent_id' => '1','url'=>'','icon'=>'','order'=>'5','isactived'=>1],
            ['id'=>'11','title' => 'Fasilitas Pendukung','parent_id' => '1','url'=>'','icon'=>'','order'=>'6','isactived'=>1],


            ['id'=>'12','title' => 'Terminal','parent_id' => '2','url'=>'','icon'=>'','order'=>'0','isactived'=>1],
            ['id'=>'13','title' => 'Stasiun','parent_id' => '2','url'=>'','icon'=>'','order'=>'1','isactived'=>1],
            ['id'=>'14','title' => 'Parkir','parent_id' => '2','url'=>'','icon'=>'','order'=>'2','isactived'=>1],
            

        ]);
    }
}
