<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReqSaldo extends Model
{
    //
    protected $table = 'request_saldo';
    protected $fillable = ['status'];
    public $timestamps = false;
}
