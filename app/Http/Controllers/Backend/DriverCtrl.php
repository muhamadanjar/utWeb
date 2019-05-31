<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\User;
class DriverCtrl extends BackendCtrl
{
    public function index(){
        return view('backend.driver.index');
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
