<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FST\Models\Terminal;
class Komponen extends Model
{
    protected $table = 'komponen';

    public function resources(){
  	    return $this->belongsToMany(Terminal::class, 'tr_komponen_terminal','komponen_id');
  	}

}
