<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Carbon\Carbon;
use MulutBusuk\Workspaces\Repositories\Eloquent\Moderator\RepositoryInterface as ModeratorInterface;
use MulutBusuk\Workspaces\Repositories\Eloquent\Post\RepositoryInterface as PostInterface;
use MulutBusuk\Workspaces\Repositories\Eloquent\AuditTrail\Activity\RepositoryInterface as ActivityInterface;
use App\Trip;
use App\Role;
use App\Jurnal;
use DB;
use DataTables;
class DashboardCtrl extends BackendCtrl{
    public $muser;
    public function __construct(
        ModeratorInterface $mi,
        PostInterface $post,
        
        ActivityInterface $activity){
            parent::__construct();
        $this->muser = $mi;
        $this->post = $post;
        
        $this->activity = $activity;
        
    }
    public function getIndex(){
        session(['link_web'=>'dashboard']);
        $datastatistik = $this->activity->statistikPengunjung();
        $totalpengunjung = $this->activity->totalhits();
        $totaluser = $this->muser->countUser();
        $totalpemesanan = Trip::count();
        
        $driver = Role::where('name','driver')->first()->users;
        $trip = Trip::orderBy('date','DESC')->limit(10);
        $totaldriver = DB::table('tm_driver')->count();
        $totalcustomer = DB::table('tm_customer')->count();
        
    
        return view('backend.dashboard.index')->with([
            'datastatistik'=>$datastatistik,
            'totalpengunjung'=>$totalpengunjung,
            'totaluser'=>$totaluser,
            'totaldriver'=>$totaldriver,
            'totalcustomer'=>$totalcustomer,
            'totalpemesanan' => $totalpemesanan,
            'driver' => $driver,
            'listtransaksi'=>$trip
        ]);
        
    }

    public function getStatistikView(){
        return view('backend.dashboard.statistik');
    }

    public function getWallet(Request $request){
        
            if($request->isMethod('post')){
                $jurnal = Jurnal::where('jurnal_create_user',auth()->user()->id);
                return Datatables::of($jurnal)
                ->editColumn('created_at', function ($user) {
                    return date('D M, Y',strtotime($user->created_at));
                })
                ->addColumn('jurnal_amount', function($d) {
                    return ($d->jurnal_type == 'D') ? $d->jurnal_credit : $d->jurnal_debet;
                })
                ->editColumn('jurnal_type', function($d){
                    return ($d->jurnal_type == 'D') ? 'Debit' : 'Credit';
                })
                ->editColumn('jurnal_balance', function($d){
                    return number_format($d->jurnal_balance,2,",",".");
                })
                ->rawColumns(['jurnal_type','jurnal_amount'])
                ->filter(function ($query) use ($request) {
                    if ($request->has('status')) {
                        $query->where('trip_status', 'like', "%{$request->get('status')}%");
                    }
                    if ($request->has('tgl_mulai')) {
                        $query->whereRaw("DATE_FORMAT(trip_date,'%H:%i:%s') like ?", ["%{$request->get('tgl_mulai')}%"]);
                    }

                    if ($request->has('sq')) {
                        $query->whereRaw("DATE_FORMAT(sewa.date,'%H:%i:%s') like ?", ["%{$request->get('sq')}%"])
                            ->orWhere('trip_address_origin', 'like', "%{$request->get('sq')}%")
                            ->orWhere('trip_address_destination', 'like', "%{$request->get('sq')}%")
                            ->orWhere('trip_code', 'like', "%{$request->get('sq')}%");
                    }
                    
                })
                ->make(true);
            }
        
        return view('backend.dashboard.wallet');
    }
    public function getEarning(Request $request){
        return view('backend.dashboard.earning');
    }

    
    
    public function getChartStatistik(){
        $chartbar = $this->activity->statistikPengunjung();
        $arr = array();
        $category = array();
        $total = 0;
        $month = 0;
        $data = [];
        
        foreach ($chartbar as $key => $value) {
            array_push($category,date('M',mktime(date('H'),date('i'),date('s'),$value->bulan,date('j'),$value->tahun)));
            array_push($data, $value->total_bulan);
            $arr['chart'][$key]['name'] = date('M',mktime(0,0,0,$value->bulan,0,$value->tahun));
            $arr['chart'][$key]['data'] = $data;
            $total += $value->total_bulan;
        }
        //$arr['chart'][0]['name'] = 'Statistik';
        //$arr['chart'][0]['data'] = $data;
        $arr['category'] = $category;
        $arr['total'] = $total;
        return response($arr);
    }

    public function getChartPesanan(){
       
        $arr = array();
        $category = array();
        $total = 0;
        $month = 0;
        $data = [];
        
        foreach ($chartbar as $key => $value) {
            array_push($category,date('M',mktime(date('H'),date('i'),date('s'),$value->bulan,date('j'),$value->tahun)));
            array_push($data, $value->total_bulan);
            $arr['chart'][$key]['name'] = $value->sewa_type;
            $arr['chart'][$key]['data'] = $data;
            $total += $value->total_bulan;
        }
        //$arr['chart'][0]['name'] = 'Statistik';
        //$arr['chart'][0]['data'] = $data;
        $arr['category'] = $category;
        $arr['total'] = $total;
        return json_encode($arr);
    }

    
    
}
