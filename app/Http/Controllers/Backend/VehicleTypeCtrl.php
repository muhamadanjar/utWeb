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
    public function edit($id){
        $t = Type::find($id);
        return view('backend.driver.form')->with(['type'=>$t]);
    }

    public function destroy($id = null){
        if($id === NULL) return true;
        $t = Type::find($id);
        if ($t !== NULL) {
            $t->delete();
        }
        return redirect()->route('backend.vihicletype.index');
    }
}
