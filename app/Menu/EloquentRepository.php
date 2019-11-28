<?php namespace App\Menu;


use Illuminate\Support\Collection;
use Auth;

class EloquentRepository implements RepositoryInterface {

    public function all()
    {
        
        if(Auth::user()->isRole('driver')){
            $menu = [
                ['title' => 'My Profile', 'url' => route('setting.profile'), 'keymap' => 1],
                ['title' => 'My Booking', 'url' => route('backend.booking.index'), 'keymap' => 2],
                ['title' => 'Edit Profile', 'url' => route('setting.users.gantipassword'), 'keymap' => 3],
                ['title' => 'Report', 'url' => route('backend.report'), 'keymap' => 4],
            ];
        }else if(Auth::user()->isRole('customer')){
            $menu = [
                ['title' => 'My Profile', 'url' => route('setting.profile'), 'keymap' => 1],
                ['title' => 'My Booking', 'url' => route('backend.booking.index'), 'keymap' => 2],
                ['title' => 'Edit Profile', 'url' => route('setting.users.gantipassword'), 'keymap' => 3],
            ];
        }else if(Auth::user()->isRole('admin') || Auth::user()->isRole('superadmin')){
            $menu = [
                ['title' => 'Dashboard', 'url' => route('backend.dashboard.index'), 'keymap' => 1],
                ['title' => 'Users', 'url' => route('setting.users'), 'keymap' => 2],
                ['title' => 'Driver', 'url' => route('setting.users'), 'keymap' => 3,'parent_id'=>2],
                ['title' => 'Customer', 'url' => route('setting.users'), 'keymap' => 3,'parent_id'=>2],
                ['title' => 'Vechiles', 'url' => route('backend.car'), 'keymap' => 4,'parent_id'=>4],
                ['title' => 'Manage Vechiles', 'url' => route('backend.car'), 'keymap' => 4,'parent_id'=>4],
                ['title' => 'Manage Vechiles Type', 'url' => route('backend.typevehicle.index'), 'keymap' => 4,'parent_id'=>4],
                ['title' => 'Transactions', 'url' => route('backend.booking.index'), 'keymap' => 4,'parent_id'=>4],
                ['title' => 'Bookings', 'url' => route('backend.car'), 'keymap' => 4,'parent_id'=>4],
                ['title' => 'Manage Bookings', 'url' => route('backend.trip_job.index'), 'keymap' => 4,'parent_id'=>4],
                ['title' => 'Report', 'url' => route('backend.report'), 'keymap' => 4,'parent_id'=>4],
                ['title' => 'Testimonial', 'url' => route('backend.reviews.index'), 'keymap' => 4,'parent_id'=>4],
                ['title' => 'Setting', 'url' => route('setting.index'), 'keymap' => 4,'parent_id'=>4],
                ['title' => 'General Setting', 'url' => route('setting.index'), 'keymap' => 4,'parent_id'=>4],
                ['title' => 'Set Email Setting', 'url' => route('setting.index'), 'keymap' => 4,'parent_id'=>4],
                ['title' => 'Fare Setting', 'url' => route('backend.setting.fare'), 'keymap' => 4,'parent_id'=>4],
                ['title' => 'Driver Map', 'url' => route('backend.car'), 'keymap' => 4,'parent_id'=>4],
            ];
        }

        if(Auth::guest()){
            $menu[] = ['title' => 'Login', 'url' => route('login'), 'keymap' => 0];
        }else{
            $menu[] = ['title' => 'Logout', 'url' => route('gerbang.logout'), 'keymap' => 0];
        }

        return new Collection($menu);
    }

    public function admin(){
        $menu = [
            ['title' => 'Tanah', 'url' => route('backend.tanah.index'), 'keymap' => 1],
            ['title' => 'Bangunan', 'url' => route('backend.bangunan.index'), 'keymap' => 1],
        ];

        return new Collection($menu);
    }
}