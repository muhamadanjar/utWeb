<?php

namespace App\Mobil\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Type extends Model
{
    protected $table = 'type';
    protected $primaryKey = 'id';
    protected $fillable = ['type', 'per_min', 'per_miles'];
    protected $dates = ['deleted_at'];

    public static $rules = array(
        'type' => 'required|min:1',
        'per_min' => 'required|numeric',
        'per_miles' => 'required|numeric',
    );

    public static $messages = [
        'type.required' => 'No Ruas harus diisi!',
        'per_min.required' => 'Harga Per menit harus di isi',
        'per_miles.required' => 'Harga Per Km harus di isi',
    ];


    public function scopeActive($query)
    {  
        return $query->where('status', '=', '1');
    }


}
