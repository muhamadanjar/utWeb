<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;
class DriverCtrl extends BackendCtrl{
    private $roleName;
    public function __construct(){
        $this->roleName = 'driver';
    }
    public function index(){
        $role = Role::where('name',$this->roleName)->first();
        // $driver = $role->users;
        $driver = DB::table('tm_driver')->get();
        return view('backend.driver.index')->with(['driver'=>$driver]);
    }

    public function driver_mobil(){
        # code...
    }

    public function create()
    {
        return view('backend.driver.form');
    }

    public function edit($id){
        $user = User::find($id);
        return view('backend.driver.form')->with('driver',$user);
    }

    public function destroy($id){
        
    }
}
