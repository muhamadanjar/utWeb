<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Mobil\Models\RentPackage;
use App\Mobil\Models\Type;
class PackageCtrl extends BackendCtrl{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $p = RentPackage::get();
        $type = Type::get();
        return view('backend.package.index')->with(['package'=>$p,'type'=>$type]);
    }
    public function edit($id){
        session(['status'=>'edit']);
        $p = RentPackage::find($id);
        return view('backend.package.form')->with(['package'=>$p]);
    }
    public function show(){
        # code...
    }
    public function create(){
        session(['status'=>'add']);
        return view('backend.package.form');
    }
    public function destroy($id){
        $p = RentPackage::find($id);
        if($p == null){
            $p->delete();
        }
        return redirect()->route('backend.package.index');
    }
}
