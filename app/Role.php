<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MulutBusuk\Workspaces\Repositories\Eloquent\Moderator\Models\Role as RoleModerator;
use MulutBusuk\Workspaces\Repositories\Eloquent\Moderator\Models\Menu as MenuModerator;
class Role extends RoleModerator
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
 
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
 
    public function addPermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->first();
        }
 
        return $this->permissions()->attach($permission);
    }
 
    public function removePermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->first();
        }
 
        return $this->permissions()->detach($permission);
    }
}
