<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Mobil\Models\RentPackage;
use App\Mobil\Models\Type;
use DB; 
use Validator;
use Laracasts\Flash\Flash;
class PackageCtrl extends BackendCtrl{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $p = RentPackage::get();
        $type = Type::get();
        return view('backend.package.index')->with(['package'=>[],'type'=>$type]);
    }
    public function edit($id,$type=null){
        session(['status'=>'edit']);
        $p = RentPackage::find($id);
        //dd($p);
        return view('backend.package.form')->with(['paket'=>$p,'type'=>$type]);
    }
    public function create($type){
        session(['status'=>'add']);
        $paket = new RentPackage();
        $id = RentPackage::select(DB::raw('MAX(rp_id) as max'))->first()->toArray();
        $id_paket = $id['max']+1;
        return view('backend.package.form')->with(['paket'=>$paket,'type'=>$type,'id_rent'=>$id_paket]);
    }
    public function destroy($id){
        $p = RentPackage::find($id);
        $p->delete();
        Flash::success('data berhasil dihapus');
        return redirect()->route('backend.packages.index');
    }

    public function list($type = null){
        $p = RentPackage::where('rp_car_type',$type)->get();
        $t = Type::find($type);
        return view('backend.package.list')->with(['type'=>$t,'packages'=>$p]);
    }

    public function post($type=null,Request $request){
        try {
            if ($type != null) {
                $rent = (session('status')=='edit') ? RentPackage::find($request->id) : new RentPackage();
                $rent->rp_name = $request->rp_name;
                $rent->rp_total_price = $request->rp_total_price;
                $rent->rp_miles_km = $request->rp_miles_km;
                $rent->rp_hour = $request->rp_hour;
                $rent->rp_add_mile_km = $request->rp_add_mile_km;
                $rent->rp_add_min = $request->rp_add_min;
                $rent->rp_car_type = $type;
                $rent->status = $request->status;
                $rent->save();
                Flash::success('Data berhasil');
            }else{
                Flash::error('Tipe Mobil tidak ada');
            }
            
            return redirect()->route('backend.packages.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function na($id){
        try {
            $r = RentPackage::find($id);
            $r->status = ($r->status == 1 ? 0:1);
            $r->save(); 
            return redirect()->route('backend.packages.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
