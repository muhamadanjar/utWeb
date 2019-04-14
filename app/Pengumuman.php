<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function author(){
        return $this->belongsTo('App\User', 'author_id');
    }

    
}
