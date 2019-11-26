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
            $menu->add('Beranda','backend/dashboard/index')

                ->prepend('<i class="fa fa-dashboard"></i>');
            $menu->add('Promo', ['url'=>'backend/promo','class'=>'treeview'])
                ->prepend('<span class="fa fa-bullhorn"></span> ');
            $menu->add('Reguler', ['url'=>'backend/reguler','class'=>'treeview'])
                ->prepend('<span class="fa fa-car"></span> ');
            $menu->add('Banner Home', ['url'=>'backend/promo','class'=>'treeview'])
                ->prepend('<span class="fa fa-bullhorn"></span> ');
            $menu->add('Reviews', ['url'=>'backend/reviews','class'=>'treeview'])
                ->prepend('<span class="fa fa-comments"></span> ');
            $menu->add('Request Saldo', ['url'=>'backend/req_saldo','class'=>'treeview'])
                ->prepend('<span class="fa fa-exchange"></span> ');
            $menu->add('Manajemen User', ['url'=>'#','class'=>'treeview','id'=>'mu'])
            ->append('<span class="pull-right-container"><i class="fa fa-angle-left"></i></span>')
            ->prepend('<span class="fa fa-user"></span> ')
            ->link->href('#');
            $menu->divide();
            $menu->manajemenUser->add('Driver', ['url'=>'backend/driver']);  
            $menu->manajemenUser->add('Customer', ['url'=>'backend/users','class'=>'dfd']);  
            $menu->add('Trip', 'backend/trip_job');  
            $menu->add('Pengaturan', '#')->prepend('<span class="fa fa-cogs"></span> ');;;  
        });
    
        return $next($request);
    }
}
