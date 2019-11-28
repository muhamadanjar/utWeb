<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('sidebar_backend', function ($menu) {
            $menu->add('Beranda',['route'=>'backend.dashboard.index'])

                ->prepend('<i class="fa fa-dashboard"></i>');
            $menu->add('Promo', ['route'=>'backend.promo.index','class'=>''])
                ->prepend('<span class="fa fa-bullhorn"></span> ');
            $menu->add('Reguler', ['url'=>'backend/typevehicle/1/edit','class'=>''])
                ->prepend('<span class="fa fa-car"></span> ');
            $menu->add('Banner Home', ['route'=>'backend.promo.index','class'=>''])
                ->prepend('<span class="fa fa-bullhorn"></span> ');
            $menu->add('Reviews', ['route'=>'backend.reviews.index','class'=>''])
                ->prepend('<span class="fa fa-comments"></span> ');
            $menu->add('Request Saldo', ['url'=>'backend.customer.request_saldo','class'=>''])
                ->prepend('<span class="fa fa-exchange"></span> ');
            $menu->add('Manajemen User', ['url'=>'#','class'=>'treeview','id'=>'mu'])
            ->append('<span class="pull-right-container"><i class="fa fa-angle-left"></i></span>')
            ->prepend('<span class="fa fa-user"></span> ')
            ->link->href('#');
            $menu->divide();
            $menu->manajemenUser->add('Driver', ['route'=>'backend.driver.index']);  
            $menu->manajemenUser->add('Customer', ['url'=>'backend/customer','class'=>'dfd']);  
            $menu->add('Trip', 'backend/trip_job');  
            $menu->add('Pengaturan', ['class'=>'treeview'])->prepend('<span class="fa fa-cogs"></span> '); 
            $menu->pengaturan->add('Umum',['route'=>'setting.index']);
            $menu->pengaturan->add('Harga',['route'=>'backend.setting.fare']);
        });
    
        return $next($request);
    }
}
