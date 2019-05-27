<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use MulutBusuk\Workspaces\Repositories\Eloquent\Moderator\Models\User as UserModerator;
use File;
use App\UserProfile;
class User extends UserModerator
{
    use Notifiable, HasApiTokens;

    protected $hidden = ['password','api_token','remember_token'];

    protected function hasTooManyLoginAttempts(Request $request){
        $maxLoginAttempts = 3;
    
        $lockoutTime = 1; // Dalam menit
    
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $maxLoginAttempts, $lockoutTime
        );
    }
    public function getNameAttribute(){
        return $this->attributes['name'];
    }
    public function getFotoPathAttribute(){
        
        if($this->attributes['foto'] !== NULL){
            if(File::exists($this->getPath().$this->attributes['foto'])){
                
                return $this->getPermalink().$this->attributes['foto'];
            }else{
                return 'http://placehold.it/320';
            }
        }else{
            return 'http://placehold.it/320';
        }
        
    }

    public function getPermalink(){
        return url('files/uploads/users').DIRECTORY_SEPARATOR;
    }

    public function getPath(){
        return public_path('files/uploads/users').DIRECTORY_SEPARATOR;
    }
    
    
    public function isSuper(){
       if ($this->roles->contains('name', 'superadmin')) {
            return true;
        }
        return false;
    }
    public function isManager(){
       if ($this->roles->contains('name', 'manager')) {
            return true;
        }
        return false;
    }

    public function isRole($level){
       if ($this->roles->contains('name', $level)) {
            return true;
        }
        return false;
    }

    public function hasRole($role){
        if ($this->isSuper()) {
            return true;
        }
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !! $this->roles->intersect($role)->count();
    }
    public function assignRole($role){
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }
        return $this->roles()->attach($role);
    }
    public function revokeRole($role){
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }
        return $this->roles()->detach($role);
    }

    public function jabatan(){
        return $this->belongsTo('App\Lookup\Lookup', 'jabatan_id');
    }
    
    public function posts(){
        return $this->hasMany(Post::class, 'author_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'author_id');
    }

    public function profile(){
        return $this->hasOne(UserProfile::class,'user_id');
    }
    
}
