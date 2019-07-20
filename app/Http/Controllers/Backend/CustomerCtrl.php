<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Customer;
use App\Kabupaten;
class CustomerCtrl extends BackendCtrl
{
	public function index()
	{
		$data = Customer::all();
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
		$data->update($request->all());

		return redirect()->route('backend.customer.index')->with('flash.success','berhasil');
	}
    
    public function destroy($id)
    {
    	Customer::findOrFail($id)->delete();
    	return redirect()->route('backend.customer.index')->with('flash.success','berhasil');

    }
}
