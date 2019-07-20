<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Customer;
use App\Kabupaten;
use App\UserProfile;
use DB;
use App\User;
use Laracasts\Flash\Flash;
class CustomerCtrl extends BackendCtrl{
	public function index()
	{
		// $data = Customer::all();
		$data = DB::table('tm_customer')->get();
		return view('backend.customer.index',compact('data'));
	}

	public function create()
	{
		$kota = Kabupaten::orderBy('nama_kabupaten','asc')->get();
		return view('backend.customer.form', compact('kota'));
	}

	public function post(Request $request)
	{
		$data = Customer::create($request->all());
		//dd($data);
		return redirect()->route('backend.customer.index')->with('flash.success','berhasil');
	}

	public function edit($id)
	{
		$data = Customer::findOrFail($id);
		$kota = Kabupaten::orderBy('nama_kabupaten','asc')->get();
		return view('backend.customer.edit',compact('data','kota'));
	}

	public function update(Request $request, $id)
	{
		$data = Customer::findOrFail($id);
		$user = User::find($id);
		$user->isactived = $request->status;
		$c = UserProfile::where('user_id',$request->id)->first();
		$user->name = $request->name;
		$c->tgl_lahir = $request->tgl_lahir;
		$c->no_telepon = $request->no_telepon;
		$c->address = $request->address;
		$c->save();
		$user->save();

		return redirect()->route('backend.customer.index')->with('flash.success','berhasil');
	}
    
    public function destroy($id)
    {
    	Customer::findOrFail($id)->delete();
    	return redirect()->route('backend.customer.index');

	}
	
	public function add_saldo(Request $request){
		$c = UserProfile::where('user_id',$request->user_id)->first();
		$c->wallet =$request->wallet;
		$c->save();
		
		Flash::success('Saldo Berhasil di tambahkan');
		return redirect()->route('backend.customer.index');

	}
}
