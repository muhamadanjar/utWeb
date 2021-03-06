<?php

namespace App\Providers;
use Laravel\Passport\Passport;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Permission;
class AuthServiceProvider extends ServiceProvider{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate){
        $this->registerPolicies($gate);
        foreach($this->getPermissions() as $permission) {
            $gate->define($permission->name, function($user) use ($permission) {
                return $user->hasRole($permission->roles);
            });
        }
        Passport::routes();
        $_uri = url()->current();
    }

    private function getPermissions(){
        return Permission::all();
    }


}
