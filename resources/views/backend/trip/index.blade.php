@extends('templates::adminlte.main')
@section('content-admin')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Trip</h3>
            <div class="box-tools text-right">
                <div class="btn-group">
                    <a href="{{ route('backend.promo.create') }}" class="btn btn-sm btn-primary"><span class="fa fa-plus"></span> Tambah</a>
                    
                </div>
            </div>
            
        </div>
            <!-- /.box-header -->
        <div class="box-body">
        	<table class="display table" cellspacing="0" width="100%" id="table_reservation">
                <thead>
                    <tr>
                        <th></th>
                        <th>Trip Type</th>
                        <th>Book By</th>
                        <th>Book No</th>
                        <th>Alamat</th>
                        <th>Trip Date</th>
                        <th>Driver</th>
                        <th>Fare</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                </tbody>
                
            </table>
        </div>
    </div>

@endsection
@section('title','Data Transaksi')
@section('style-head')
@parent
<link rel="stylesheet" href="{{ url('/plugins/datatables/datatables.min.css')}}">

@endsection
@section('script-end')
@parent

<script type="text/javascript" src="{{ url('/plugins/jquery-ui/js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{ url('/plugins/bootbox/js/bootbox.js') }}"></script>
<script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/js/rm.js') }}"></script>


@endsection