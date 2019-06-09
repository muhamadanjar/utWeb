<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use MulutBusuk\Workspaces\Repositories\Eloquent\AuditTrail\Activity\RepositoryInterface as ActivityRepository;
use MulutBusuk\Workspaces\Repositories\Eloquent\Moderator\Models\Setting;
// use MulutBusuk\Workspaces\Repositories\Eloquent\Moderator\Models\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Event::subscribe('App\AuditTrail\EventHandler');
        $site_settings = Setting::pluck('value', 'key');
        View::share('site_settings', $site_settings);
        Carbon::setLocale('id');
        $_tbox = Config::get('mulutbusuk.box');
        $box = ($_tbox == 'bs3') ? Config::get('mulutbusuk.bs3_box') : Config::get('mulutbusuk.bs4_box');
        View::share('div_box', $box);
        View::share('ctemplates', \Config::get('mulutbusuk.template'));

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('App\Officer\RepositoryInterface', 'App\Officer\EloquentRepository');
        $this->app->bind('App\Lookup\RepositoryInterface', 'App\Lookup\EloquentRepository');
        $this->app->bind('App\Mobil\Contracts\RepositoryInterface', 'App\Mobil\Repository');
        $this->app->bind('App\Mobil\Contracts\IMobilDetil', 'App\Mobil\RepositoryMobilDetil');


        $this->app->bind('path.public', function () {
            return realpath(__DIR__ . '/../../public');
        });
        \Config::set('moderator::view_login', 'templates::adminlte.login');
        \Config::set('moderator::view_profil', 'templates::adminlte.profile');

        if ($this->app->environment() == 'production') {
            URL::forceScheme('https');
        }
    }


}
