<?php

namespace App\Jalan\Models;

use Illuminate\Database\Eloquent\Model;

class MobilFile extends Model{
    protected $table = 'mobil_file';
    protected $primaryKey = 'id';
    protected $fillable = ['namafile','mobil_id'];
    public $timestamps = false;
    public function jalan(){
        $this->belongsTo(Jalan::class,'mobil_id');
    }

}
