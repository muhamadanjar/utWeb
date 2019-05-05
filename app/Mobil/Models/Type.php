<?php

namespace App\Mobil\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
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

    public function getImagePathAttribute(){
        
        if($this->attributes['image'] !== NULL){
            if(File::exists($this->getPath().$this->attributes['image'])){
                return $this->getPermalink().$this->attributes['image'];
            }else{
                return 'http://placehold.it/320';
            }
        }else{
            return 'http://placehold.it/320';
        }
        
    }

    public function getPermalink(){
        return url('images').DIRECTORY_SEPARATOR;
    }

    public function getPath(){
        return public_path('images').DIRECTORY_SEPARATOR;
    }


}
