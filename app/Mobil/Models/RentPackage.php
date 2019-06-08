<?php

namespace App\Mobil\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RentPackage extends Model
{
    protected $table = 'rent_package';
    protected $primaryKey = 'rp_id';
    protected $fillable = ['rp_name', 'rp_total_price', 'rp_miles_km','rp_hour'];
    protected $dates = ['deleted_at'];
    public $timestamps = false;

    public static $rules = array(
        'rp_name' => 'required|min:1',
        'rp_total_price' => 'required|numeric',
        'rp_miles_km' => 'required|numeric',
        'rp_hour' => 'required|numeric'
    );

    public static $messages = [
        'rp_name.required' => 'Nama Rental Package harus diisi!',
        'rp_total_price.required' => 'total harga harus di isi',
        'rp_miles_km.required' => 'Harga Per Km harus di isi',
    ];

    public function scopeActive($query){  
        return $query->where('status', '=', '1');
    }


}
