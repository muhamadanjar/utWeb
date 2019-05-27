<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id','wallet'];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
