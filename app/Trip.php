<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model{
    protected $table = 'trip';
    protected $primaryKey = 'trip_id';
    public $timestamps = false;
}
