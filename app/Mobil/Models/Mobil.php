<?php

namespace App\Mobil\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\AuditTrail\Loggable;
use App\AuditTrail\RevisionableTrait;

class Mobil extends Model
{
    //use SoftDeletes;
    // use RevisionableTrait;
    protected $table = 'mobil';
    protected $primaryKey = 'id';
    protected $fillable = ['no_plat', 'nama_mobil', 'warna'];
    protected $dates = ['deleted_at'];

    public static $rules = array(
        'no_plat' => 'required|min:1',
        'nama_mobil' => 'required|min:3',
        'warna' => 'required|numeric|min:0',
    );

    public static $messages = [
        'no_plat.required' => 'No Ruas harus diisi!',
        'nama_mobil.required' => 'Nama Ruas harus di isi',
        'warna.required' => 'Panjang Jalan harus di isi',
    ];

    public function getPermalink()
    {
        return url('files/uploads/mobil') . DIRECTORY_SEPARATOR . '/';
    }

    public function getPath()
    {
        return public_path('files/uploads/mobil') . DIRECTORY_SEPARATOR . '/';
    }

    public function detil()
    {
        return $this->hasMany(MobilDetil::class, 'mobil_id');
    }

    public function files()
    {
        return $this->hasMany(MobilFile::class,'mobil_id');
    }
    
    // public function getNamaRuasAttribute($value){
    //     return ucfirst($value);
    // }

    // public function getPtkBaikPersentaseAttribute($value){
    //     return ucfirst($value).' %';
    // }
    // public function getPtkSedangPersentaseAttribute($value){
    //     return ucfirst($value).' %';
    // }
    // public function getPtkRusakringanPersentaseAttribute($value){
    //     return ucfirst($value).' %';
    // }
    // public function getPtkRusakberatPersentaseAttribute($value){
    //     return ucfirst($value).' %';
    // }
    // public function getPtkBaikKmAttribute($value){
    //     return ucfirst($value).' Km';
    // }
    // public function getPtkSedangKmAttribute($value){
    //     return ucfirst($value).' Km';
    // }
    // public function getPtkRusakringanKmAttribute($value){
    //     return ucfirst($value).' Km';
    // }
    // public function getPtkRusakberatKmAttribute($value){
    //     return ucfirst($value).' Km';
    // }

    public function scopeActive($query)
    {
        // $query->select(
        //     DB::raw('SUM(ptjp_aspal) as aspal'),
        //     DB::raw('SUM(ptjp_beton) as beton'),
        //     DB::raw('SUM(ptjp_kerikil) as kerikil'),
        //     DB::raw('SUM(ptjp_tanah) as tanah')
        // );
        return $query->where('status', '<>', 'self::STATUS_DRAFT');

    }


}
