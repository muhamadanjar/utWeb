<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Hubungi;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('home');
        // return redirect()->route('map.index');
    }

    public function hubungi($value='')
    {
      return view('hubungi');
    }

    public function posthubungi(Request $request){
      try {
        $hubungi = new Hubungi();
        $hubungi->nama = $request->nama;
        $hubungi->email = $request->email;
        $hubungi->pesan = $request->pesan;
        $hubungi->posted_at = Carbon::now();
        $hubungi->save();
        Flash::success('Usulan anda berhasil di kirim');
      } catch (Exception $e) {
        report($e);
        Flash::error('Usulan anda gagal di kirim, Silahkan cek lagi inputan anda!!!');
      }


      return redirect()->route('hubungi');

    }
}
