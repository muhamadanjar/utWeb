<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Mobil\Models\Type;
class VehicleTypeCtrl extends BackendCtrl{
     public function __construct(){
         parent::__construct();
     }
     public function index(Type $var = null){
        $type = Type::get();
        return view('backend.driver.type')->with(['type'=>$type]);
     }
}
