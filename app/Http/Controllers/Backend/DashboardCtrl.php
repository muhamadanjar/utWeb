<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Carbon\Carbon;
use MulutBusuk\Workspaces\Repositories\Eloquent\Moderator\RepositoryInterface as ModeratorInterface;
use MulutBusuk\Workspaces\Repositories\Eloquent\Post\RepositoryInterface as PostInterface;
use MulutBusuk\Workspaces\Repositories\Eloquent\AuditTrail\Activity\RepositoryInterface as ActivityInterface;
use App\Mobil\Contracts\RepositoryInterface as MobilInterface;
use App\Trip;
use App\Role;
use DB;
class DashboardCtrl extends BackendCtrl{
    public $muser;
    public function __construct(
        ModeratorInterface $mi,
        PostInterface $post,
        MobilInterface $mobil,
        ActivityInterface $activity){
            parent::__construct();
        $this->muser = $mi;
        $this->post = $post;
        $this->mobil = $mobil;
        $this->activity = $activity;
        
    }
    public function getIndex(){
        session(['link_web'=>'dashboard']);
        $datastatistik = $this->activity->statistikPengunjung();
        $totalpengunjung = $this->activity->totalpengunjung();
        $totaluser = $this->muser->countUser();
        $totalpemesanan = Trip::count();
        //$chartstatistik = $this->getChartStatistik();
        // $totaldriver = $this->driver->count();

        $driver = Role::where('name','driver')->first()->users;
        $trip = Trip::orderBy('date','DESC')->limit(10);
        
    
        return view('backend.dashboard.index')->with([
            'datastatistik'=>$datastatistik,
            'totalpengunjung'=>$totalpengunjung,
            'totaluser'=>$totaluser,
            'totalpemesanan' => $totalpemesanan,
            'driver' => $driver,
            'listtransaksi'=>$trip
        ]);
        
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
