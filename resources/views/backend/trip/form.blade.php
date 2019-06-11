@extends($ctemplates.'.main')
@section('title')
<h5>
    <a href="{{ route('backend.packages.index') }}"><i class="icon-arrow-left52 mr-2"></i></a>
    <span class="font-weight-semibold">Paket</span>
    <small class="d-block text-muted">Manajemen Data Paket</small>
</h5>
@endsection
@section('content-admin')
<?php

if (session('aksi') == 'edit') {
    $id = $trip->id;
    $trip_code = $trip->trip_code;
    $alamat = $trip->trip_address_origin .' '.$trip->trip_address_destination;
    $status = $trip->status;
    $total = $trip->trip_total;
} else {
	$id = "";
    $trip_code = "";
    $alamat = "";
    $rp_miles_km = "";
    $rp_hour = "";
    $rp_add_mile_km = "";
    $rp_add_min = "";
    $status ="";

}
?>

<form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.trip_job.post')}}">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-default">
				<div class="box-header with-border">
					<h6 class="box-title"><i class="fa fa-road"></i> Form Pemesanan</h6>
					<div class="header-elements text-right">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-send ico-save"></i> Simpan
                            </button>
							<a href="{{ route('backend.packages.index') }}" class=" btn btn-sm btn-success ">
                            <i class="fa fa-mail-reply"></i> Kembali</a>
                        </div>
                    </div>
				</div>
				<div class="box-body">
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{ $id }}">
					
						
					<div class="form-group {{ $errors->has('rp_name') ? ' has-error' : '' }}">
						<label>No Pemesanan</label>
						<input type="text" class="form-control" name="rp_name" value="{{ $trip_code }}" required>
						<div class="col-md-6"></div>
					</div>

                    <div class="form-group {{ $errors->has('rp_total_price') ? ' has-error' : '' }}">
						<label>Alamat</label>
						<input type="text" class="form-control" name="rp_total_price" value="{{ $alamat }}" required>
						<div class="col-md-6"></div>
					</div>

					<div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
						<label for="no_ruas_pangkal">Status : {{$status}}</label>
                    </div>
                    
                    <table class="table">
                        <tr>
                            <td>Total Harga</td>
                        </tr>
                        <tr>
                            <td><h2>Total Harga</h2></td>
                        </tr>
                    </table>
					
					
						
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							Simpan
						</button>
					</div>
				</div>
			</div>
        </div>
        <div class="col-md-4">
            <div class="{{$div_box}}">
                <div class="box-header">
                    <h4 class="header-title">Driver Tersedia</h4>
                </div>
                <div class="box box-body">
                    <div class="driverSelected">
                        <span class="bg-green">Driver : </span>
                    </div>
                    <div class="driverList">
                    <li onclick="">
                        <label class="map-tab-img">
                            <label class="map-tab-img1">
                                <img class="img img-circle"  src="http://cubetaxishark.bbcsproducts.com/webimages/upload/Driver/40/2_1550039252.jpg">
                            </label>
                            <img src="../assets/img/offline-icon.png">
                        </label>
                        <p class="driver_40">Alex M*** <b>+*****78</b></p>
                        <a href="javascript:void(0)" class="btn btn-success assign-driverbtn" onclick="checkUserBalance(40);">Pilih Driver</a>
                    </li>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<div class="row">
        
    </div>
    
</form>
@endsection
@section('style-head')
@parent
<style>
/* ===========
File Manager
============== */
.file-man-box {
  padding: 10px;
  border: 2px solid #dfe3e6;
  border-radius: 0;
  position: relative;
  margin-bottom: 10px; }
  .file-man-box .file-close {
    color: #f15642;
    position: absolute;
    line-height: 24px;
    font-size: 24px;
    right: 10px;
    top: 10px;
    visibility: hidden; }
  .file-man-box .file-img-box {
    line-height: 120px;
    text-align: center; }
    .file-man-box .file-img-box img {
      height: 64px; }
  .file-man-box .file-download {
    font-size: 32px;
    color: #98a6ad;
    position: absolute;
    right: 10px; }
    .file-man-box .file-download:hover {
      color: #313a46; }
  .file-man-box .file-man-title {
    padding-right: 25px; }
  .file-man-box:hover {
    border-color: #4489e4; }
    .file-man-box:hover .file-close {
      visibility: visible; }
</style>
@endsection
@section('script-end')
@parent
<script type="text/javascript" src="{{ url('/plugins/bootbox/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/rm.js')}}"></script>
<script type="text/javascript">
    $(function () {
        //Initialize Select2 Elements
		$('.select2').select2();
		//Date picker
		// loadKecamatan(3271);
		// CKEDITOR.replace( 'keterangan', {
        //     toolbar : [
		// 		{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
		// 		{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
		// 		{ name: 'tools', items : [ 'Maximize','-' ] }
		// 	]
        // } );
    
	});
</script>

@endsection

