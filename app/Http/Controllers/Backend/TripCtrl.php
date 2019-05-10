<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use DataTables;
use DB;
use App\Trip;

class TripCtrl extends BackendCtrl
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trip = \App\Trip::get();
        return view('backend.trip.index')->withTrip($trip);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($trip_job)
    {   
        $trip = Trip::join('trip_detail','trip.trip_id','trip_detail.trip_id')->where('trip.trip_id',$trip_job)->orderBy('trip_date','DESC')->first();
        return view('backend.trip.show')->with(['trip'=>$trip]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_data(Request $request){

        \DB::statement(DB::raw('set @rownum=0'));
            $sewa = Trip::join('trip_detail','trip.trip_id','=','trip_detail.trip_id')
            ->orderBy('trip.created_at','DESC')
            ->select(
            [
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'trip.trip_id',
                'trip.trip_type',
                'trip.trip_bookby',
                'trip_code',
                'trip_address_origin',
                'trip_date',
                'trip_driver',
                \DB::raw("CONCAT('Rp.',FORMAT(trip_total,2)) as trip_total"),
                'trip_status',
            ]
        );
        
    
        return Datatables::of($sewa)
        ->addColumn('action', function ($user) {
            $content = '<div class="btn-group">';
            $content .= '<a href="'.route('backend.trip_job.edit',[$user->id]).'" class="btn btn-xs btn-primary btn-edit"><i class="fa fa-edit"></i> Edit</a>';
            $content .= '<a href="#" class="btn btn-xs btn-primary btn-detail"><i class="fa fa-more"></i> Detail</a>';
            $content .= '</div>';
            return $content;
        })
        
        ->editColumn('rownum', function ($tr) {
            return '<b>'.$tr->rownum.'</b>';
        })
        ->editColumn('trip_total', function ($tr) {
            return '<i>'.$tr->trip_total.'</i>';
        })
        ->editColumn('created_at', function ($user) {
            return date('D M Y',strtotime($user->created_at));
        })
        ->addColumn('details_url', function($user) {
            return url('backend/trip_job/'.$user->trip_id);
        })
        ->setRowClass(function ($data) {
            return $data->trip_type == '1' ? 'alert-default' : 'alert-info';
        })
        ->editColumn('trip_status', function($transaksi){
            $class = $transaksi->trip_status == '0' ? 'bg-orange' : 'label-success';
            return '<span class="label '.$class.'">'.$transaksi->status.'</span>';
        })
        ->rawColumns(['rownum', 'action','trip_status','trip_total'])
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
}
