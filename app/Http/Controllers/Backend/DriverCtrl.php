<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
use App\Role;
use App\Mobil\Merk;
use App\Mobil\Type;
use DB;
use App\Mobil\Models\Mobil;
use Validator;
use App\Mobil\Repository;
use Laracasts\Flash\Flash;
class DriverCtrl extends BackendCtrl{
    private $roleName;
    public function __construct(Repository $repo){
        $this->roleName = 'driver';
        $this->mobil = $repo;
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

    public function create(){
        session(['aksi'=>'add']);
        return view('backend.driver.form');
    }

    public function edit($id){
        session(['aksi'=>'edit']);
        $merk = Merk::orderBy('merk','ASC')->get();
        $type= Type::orderBy('type','ASC')->get();
        $user = User::find($id);
        $mobil = $this->mobil->findByField('user_id',$id);
        
        
        return view('backend.driver.form')->with(['driver'=>$user,'mobil'=>$mobil,'merkselect'=>$merk,'typeselect'=>$type]);
    }

    public function destroy($id){
        Flash::success('Berhasi di hapus');
        User::find($id)->delete();
        return redirect()->route('backend.driver.index');
    }
    public function nonaktif($id)
    {
        # code...
    }

    public function post(Request $request){
        $validator = Validator::make($request->all(),Mobil::$rules_driver,Mobil::$messages_driver);
        if(!$validator->passes()) {
		    return redirect()->route('backend.driver.index')
                ->withErrors($validator)
                ->withInput();
        }
        \DB::beginTransaction();

        try{
                $driver = session('aksi') == 'edit' ? User::find($request->id) :new User();
                $driver->name = $request->name;
                $driver->username = $request->username;
                $driver->email = $request->email;
                if($request->oldpassword == $request->password){
                    $driver->password = $request->oldpassword;        
                }else{
                    $driver->password = bcrypt($request->password);           
                }
                $driver->save();
                if (!$driver->hasRole($this->roleName)) {
                    $driver->assignRole('driver');
                }
                

                $profile = new UserProfile();
                $profile->nip = $request->nip;
                $profile->address = $request->alamat;;
                $profile->no_telepon = $request->no_telp;
                $profile->user_id = $driver->id;
                $profile->wallet = ($request->deposit == $request->old_deposit) ? $request->old_deposit : $request->old_deposit+$request->deposit ;
                $profile->user()->associate($driver)->save();

                $mobil = $this->mobil->findByField('user_id',$request->id);
                $mobil = $mobil != null ? $mobil:new Mobil();
                $mobil->no_plat = $request->no_plat;
                $mobil->name = $request->mobil_name;
                $mobil->merk = $request->merk;
                //$mobil->type = $request->type;
                $mobil->warna = $request->warna;
                $mobil->harga = $request->harga;
                $mobil->tahun = ($request->tahun =='') ? 0 : $request->tahun;
                $mobil->foto = ($request->foto =='') ? 'http://placehold.it/160' : $request->foto;
                $mobil->harga_perjam = $request->harga_perjam;   
                $mobil->author()->associate($driver);
                $mobil->save();
                Flash::success(trans('flash/mobil.drivercreated'));
                \DB::commit();

                return redirect()->route('backend.driver.index');
            

            
        }catch(Exception $e){
            \DB::rollback();
            report($e);
            Flash::error(trans('flash/mobil.error'));
        }
    }
}
