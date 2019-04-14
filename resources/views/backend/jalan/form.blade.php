@extends($ctemplates.'.main')
@section('title')
<h5>
    <a href="{{ route('backend.jalan.index') }}"><i class="icon-arrow-left52 mr-2"></i></a>
    <span class="font-weight-semibold">Jalan</span>
    <small class="d-block text-muted">Manajemen Data Jalan</small>
</h5>
@endsection
@section('content-admin')
<?php

if (session('aksi') == 'edit') {
	$id = $jalan->id;
	$no_ruas = $jalan->no_ruas;
	$nama_ruas = $jalan->nama_ruas;
	$kode_kec = $jalan->kode_kec;
	$panjang = $jalan->panjang;
	$lebar = $jalan->lebar;
	$lhr_rata = $jalan->lhr_rata;
	$akses_jalan = $jalan->akses_jalan;
	$no_ruas_ujung = $jalan->no_ruas_ujung;
	$no_ruas_pangkal = $jalan->no_ruas_pangkal;
	$pembiayaan = $jalan->pembiayaan;
	$biaya = $jalan->biaya;
	$jumlah_lajur = $jalan->jumlah_lajur;

	$ujung_latitude = $jalan->ujung_latitude;
	$ujung_longitude = $jalan->ujung_longitude;
	$pangkal_latitude = $jalan->pangkal_latitude;
	$pangkal_longitude = $jalan->pangkal_longitude;

	$aspal = $jalan->ptjp_aspal;
	$beton = $jalan->ptjp_beton;
	$kerikil = $jalan->ptjp_kerikil;
	$belum_tembus = $jalan->ptjp_tanah;

	$ptk_baik_persentase = $jalan->ptk_baik_persentase;
	$ptk_baik_km = $jalan->ptk_baik_km;
	$ptk_sedang_persentase = $jalan->ptk_sedang_persentase;
	$ptk_sedang_km = $jalan->ptk_sedang_km;
	$ptk_rusakringan_persentase = $jalan->ptk_rusakringan_persentase;
	$ptk_rusakringan_km = $jalan->ptk_rusakringan_km;
	$ptk_rusakberat_persentase = $jalan->ptk_rusakberat_persentase;
	$ptk_rusakberat_km = $jalan->ptk_rusakberat_km;
	$tahun = $jalan->tahun;
	$keterangan = $jalan->ket;
	$image = '';
	$file = $jalan->files;
} else {
	$id = $id_jalan;
	$no_ruas = '';
	$nama_ruas = '';
	$kode_kec = '';
	$panjang = '';
	$lebar = '';
	$lhr_rata = '';
	$akses_jalan = '';
	$no_ruas_ujung = '';
	$no_ruas_pangkal = '';
	$pembiayaan = '0';
	$biaya = '0';
	$jumlah_lajur = '1';
	$ujung_latitude = '';
	$ujung_longitude = '';
	$pangkal_latitude = '';
	$pangkal_longitude = '';

	$aspal = '';
	$beton = '';
	$kerikil = '';
	$belum_tembus = '';

	$ptk_baik_persentase = '';
	$ptk_baik_km = '';
	$ptk_sedang_persentase = '';
	$ptk_sedang_km = '';
	$ptk_rusakringan_persentase = '';
	$ptk_rusakringan_km = '';
	$ptk_rusakberat_persentase = '';
	$ptk_rusakberat_km = '';
	$tahun = '';

	$keterangan = '';
	$image = '';
	$file = [];
}
?>

<form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.jalan.post') }}">
	<div class="row">
		<div class="col-md-8">
			<div class="card card-default">
				<div class="card-header with-border">
					<h6 class="card-title"><i class="fa fa-road"></i> Form Jalan</h6>
					<div class="header-elements text-right">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-send ico-save"></i> Simpan
                            </button>
							<a href="{{ route('backend.jalan.index') }}" class=" btn btn-sm btn-primary">
							@if(session('aksi') == 'edit')
							<a href="{{ route('backend.jalan.formskj',[$id]) }}" class=" btn btn-sm btn-secondary">
                            <i class="fa fa-road"></i> STA</a>
							@endif
							<a href="{{ route('backend.jalan.index') }}" class=" btn btn-sm btn-success ">
                            <i class="fa fa-mail-reply"></i> Kembali</a>
                        </div>
                    </div>
				</div>
				<div class="card-body">
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{ $id }}">
					
						
					<div class="form-group {{ $errors->has('no_ruas') ? ' has-error' : '' }}">
						<label>No Ruas</label>
						<input type="text" class="form-control" name="no_ruas" value="{{ $no_ruas }}" required>
						<div class="col-md-6"></div>
					</div>

                    <div class="form-group {{ $errors->has('nama_ruas') ? ' has-error' : '' }}">
						<label>Nama Ruas</label>
						<input type="text" class="form-control" name="nama_ruas" value="{{ $nama_ruas }}" required>
						<div class="col-md-6"></div>
					</div>

					<div class="form-group {{ $errors->has('no_ruas') ? ' has-error' : '' }}">
						<label>Jumlah Lajur</label>
						<input type="text" class="form-control" name="jumlah_lajur" value="{{ $jumlah_lajur }}" required>
						<div class="col-md-6"></div>
					</div>

					<div class="form-group {{ $errors->has('kode_kec') ? ' has-error' : '' }}">
						<label>Kecamatan (Yang dilalui)</label>
						<input type="hidden" id="kode_kec" value="{{$kode_kec}}" />
						<select name="kode_kec[]" class="form-control select2" id="kec_dilalui" multiple="multiple">
							<option value="0">----------</option>
							{!! $kecamatan !!}
						</select>
					</div>

                    <div class="form-group {{ $errors->has('panjang') ? ' has-error' : '' }} {{ $errors->has('lebar') ? ' has-error' : '' }}">
						<div class="row">
                            <div class="col-sm-6">
                                <label class="control-label"> Panjang(Km) dan Lebar(m)</label>
                            </div>
                    	</div>
						<div class="row">
							<div class="col-md-6">
								<input type="text" class="form-control numberonly" placeholder="Panjang (Km)" name="panjang" id="panjang" value="{{ $panjang }}" required>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control numberonly" placeholder="Lebar (m)" name="lebar" id="lebar" value="{{ $lebar }}" required>
							</div>
						</div>
					</div>

                    <div class="form-group {{ $errors->has('lhr_rata') ? ' has-error' : '' }}">
						<label>LHR Rata -Rata</label>
						<input type="text" class="form-control" name="lhr_rata" value="{{ $lhr_rata }}" required>
						<div class="col-md-6"></div>
					</div>
					<div class="row">
						<div class="col-md-6">
						<div class="form-group {{ $errors->has('akses_jalan') ? ' has-error' : '' }}">
							<label class="col-md-6">Akses Ke Jalan</label>
							
							<div class="col-md-12">
								<select name="akses_jalan" class="form-control" id="akses_jalan">
									<option value="0">----------</option>
									<option value="N" @if($akses_jalan == 'N') selected @endif>Nasional</option>
									<option value="P" @if($akses_jalan == 'P') selected @endif>Provinsi</option>
									<option value="K" @if($akses_jalan == 'K') selected @endif>Kabupaten / Kota</option>
								</select>
							</div>
						</div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-6">Tahun</label>
							<div class="col-md-12">
								<input type="text" name="tahun" id="tahun" class="form-control numberonly" value="{{ $tahun }}" placeholder="Tahun" required>
							</div>
						</div>
						</div>
					</div>
					
					

					<table class="table table-bordered">
						<tbody>
						<tr class="bg-orange color-palette">
							<th>Kordinat Pangkal</th>
							<th>Kordinat Ujung</th>
						</tr>
						<tr>
							<th>
								<div class="form-group">
									<input type="text" class="form-control numberonly" name="pangkal_latitude" placeholder="Latitude" value="{{ $pangkal_latitude }}" required>
									<input type="text" class="form-control numberonly" name="pangkal_longitude" placeholder="Longitude" value="{{ $pangkal_longitude }}" required>
								</div>
							
							</th>
							<th>
								<div class="form-group">
									<input type="text" class="form-control numberonly" name="ujung_latitude" placeholder="Latitude" value="{{ $ujung_latitude }}" required>
									<input type="text" class="form-control numberonly" name="ujung_longitude" placeholder="Longitude"  value="{{ $ujung_longitude }}" required>
								</div>
							</th>
						</tr>
					
						</tbody>
					</table>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('no_ruas_ujung') ? ' has-error' : '' }}">
								<label for="no_ruas_ujung">No Ruas Ujung</label>
								<input type="text" class="form-control" id="no_ruas_ujung" name="no_ruas_ujung" value="{{$no_ruas_ujung}}" placeholder="No Ruas Ujung" required>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('no_ruas_pangkal') ? ' has-error' : '' }}">
								<label for="no_ruas_pangkal">No Ruas Pangkal</label>
								<input type="text" class="form-control" id="no_ruas_pangkal" name="no_ruas_pangkal" value="{{$no_ruas_pangkal}}" placeholder="No Ruas Pangkal" required>
							</div>
						</div>	
					</div>
					
					<div class="form-group {{ $errors->has('pembiayaan') ? ' has-error' : '' }}">
						<label for="no_ruas_pangkal">Pembiayaan</label>
						<input type="text" class="form-control" id="pembiayaan" name="pembiayaan" value="{{$pembiayaan}}" placeholder="Pembiayaan" required>
					</div>
					<div class="form-group {{ $errors->has('biaya') ? ' has-error' : '' }}">
						<label for="no_ruas_pangkal">Biaya</label>
						<input type="text" class="form-control numberonly" id="biaya" name="biaya" value="{{$biaya}}" placeholder="Biaya" required>
					</div>

					<div class="form-group {{ $errors->has('keterangan') ? ' has-error' : '' }}">
						<label for="no_ruas_pangkal">Keterangan</label>
						<textarea class="form-control" id="keterangan" name="keterangan">{{$keterangan}}</textarea>
					</div>
					
						
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							Simpan
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card card-default">
				<div class="card-header with-border">
					<h6 class="card-title"><i class="fa fa-building"></i> PANJANG TIAP JENIS PERMUKAAN (Km)</h6>
					<div class="card-toolbar text-right">
                        <div class="btn-group pull-right">

                        </div>
                    </div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label class="control-label"> PANJANG TIAP JENIS PERMUKAAN (Km)</label>
							</div>
						</div>
						<div class="row">
								<div class="col-md-6">
									<input type="text" class="form-control numberonly" placeholder="Aspal" name="aspal" value="{{ $aspal }}">
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control numberonly" placeholder="Beton" name="beton" value="{{ $beton }}">
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control numberonly" placeholder="Kerikil" name="kerikil" value="{{ $kerikil }}">
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control numberonly" placeholder="Belum Tembus" name="belum_tembus" value="{{ $belum_tembus }}">
								</div>
						</div>
						
					</div>
				</div>
			</div>

			<div class="card card-default">
				<div class="card-header with-border">
					<h6 class="card-title"><i class="fa fa-building"></i> PANJANG TIAP KONDISI</h6>
					<div class="card-toolbar text-right">
                        <div class="btn-group pull-right">

                        </div>
                    </div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label class="control-label"> </label>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-12">
								<div class="row">
										<label for="baik" class="col-sm-2 control-label">Baik</label>
										<div class="col-sm-5">
											<div class="input-group">
												<input type="text" class="form-control numberonly" id="ptk_baik_persentase" name="ptk_baik_persentase" value="{{$ptk_baik_persentase}}" maxlength="3" placeholder="%">
												<span class="input-group-prepend">
													<span class="input-group-text">%</span>
												</span>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="input-group">
												<input type="text" class="form-control numberonly" id="ptk_baik_km" name="ptk_baik_km" value="{{$ptk_baik_km}}" placeholder="Km">
												<span class="input-group-prepend">
													<span class="input-group-text bg-orange">Km</span>
												</span>
											</div>
										</div>
									
								</div>
								<div class="row">
									
										<label for="sedang" class="col-sm-2 control-label">Sedang</label>
										<div class="col-sm-5">
											<div class="input-group">
												<input type="text" class="form-control numberonly" id="ptk_sedang_persentase" name="ptk_sedang_persentase" maxlength="3" value="{{$ptk_sedang_persentase}}" placeholder="%">
												<span class="input-group-prepend">
													<span class="input-group-text bg-orange"><b>%</b></span>
												</span>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="input-group">
												<input type="text" class="form-control numberonly" id="ptk_sedang_km" name="ptk_sedang_km" value="{{$ptk_sedang_km}}" placeholder="Km">
												<span class="input-group-prepend">
													<span class="input-group-text bg-orange">Km</span>
												</span>
											</div>
										</div>
									
								</div>
								<div class="row">
									
										<label for="rusakringan" class="col-sm-2 control-label">Rusak Ringan</label>
										<div class="col-sm-5">
											<div class="input-group">
												<input type="text" class="form-control numberonly" id="ptk_rusakringan_persentase" name="ptk_rusakringan_persentase" maxlength="3" value="{{$ptk_rusakringan_persentase}}" placeholder="%">
												<span class="input-group-prepend">
													<span class="input-group-text bg-orange">%</span>
												</span>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="input-group">
											<input type="text" class="form-control numberonly" id="ptk_rusakringan_km" name="ptk_rusakringan_km" value="{{$ptk_rusakringan_km}}" placeholder="Km">
											<span class="input-group-prepend">
												<span class="input-group-text bg-orange">Km</span>
											</span>
											</div>
										</div>
									
								</div>
								<div class="row">
									
										<label for="rusakberat" class="col-sm-2 control-label">Rusak</label>
										<div class="col-sm-5">
											<div class="input-group">
												<input type="text" class="form-control numberonly" id="ptk_rusakberat_persentase" name="ptk_rusakberat_persentase" maxlength="3" value="{{$ptk_rusakberat_persentase}}" placeholder="%">
												<span class="input-group-prepend">
													<span class="input-group-text bg-orange">%</span>
												</span>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="input-group">
												<input type="text" class="form-control numberonly" id="ptk_rusakberat_km" name="ptk_rusakberat_km" value="{{$ptk_rusakberat_km}}" placeholder="Km">
												<span class="input-group-prepend">
													<span class="input-group-text bg-orange">Km</span>
												</span>
											</div>
										</div>
									
								</div>
							</div>	
							
						</div>
					</div>
				</div>
			</div>
			<div class="card card-default">
				<div class="card-header with-border">
					<h6 class="card-title"><i class="fa fa-image" style="color:#3097D1"></i> Foto</h6>
					<div class="card-toolbar text-right">
                        <div class="btn-group pull-right">

                        </div>
                    </div>
				</div>
				<div class="card-body">
					<div class="foto">
                        <div class="row">
							@if(isset($file))
							@foreach($file as $files)								
							<!-- <div class="col-sm-6">
								<img class="img-responsive" src="{{$jalan->getPermalink()}}{{ $files->namafile }}" alt="Photo">
							</div> -->
							<div class="col-sm-6">
                                <div class="file-man-box">
                                    <a href="{{ route('backend.jalan.deletefile',[$files->id])}}" class="file-close"><i class="fa fa-close"></i></a>
									<div class="file-img-box">
										<img src="{{$jalan->getPermalink()}}{{ $files->namafile }}" alt="icon">
									</div>
									<a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                    <div class="file-man-title">
										<h5 class="m-b-0 text-overflow">{{$files->keterangan}}</h5>
										{{-- <p class="m-b-0"><small>{{ _formatSizeUnits(File::size($jalan->getPath().$files->namafile))}}</small></p> --}}
                                    </div>
                                </div>
                            </div>
							@endforeach
							
							@endif
						</div>
                      
                    </div>
                    <div class="input-group margin controlupload">
                        <input type="text" class="form-control txtfoto" readonly="readonly" name="foto[]" id="foto[]" value="{{ $image }}" placeholder="Gambar Pangkal">
                        <span class="input-group-append">
                            <input type="file" name="users_file" class="hidden file fileupload" 
								data-url="{{ route('backend.jalan.upload',['path'=>'files/uploads/jalan'])}}" 
								data-path="{{url('/files/uploads/jalan/')}}"
								data-type="multiple"
								data-jalanid=""
								multiple accept="image/*" style="display:none">
                            <button type="button" class="btn btn-info btn-flat formUpload"><i class="fa fa-upload"></i> Foto!</button>
                        </span>
                    </div>
					<div class="foto">
                        <div class="row">
							@if(isset($file))

							@endif
						</div>
                      
                    </div>
                    
					
					<div class="input-group controlupload">
						<input type="text" class="form-control txtfoto" readonly="readonly" name="foto[]" id="foto[]" value="{{ $image }}" placeholder="Gambar Ujung">
						<span class="input-group-append">
							<input type="file" name="users_file" class="hidden file fileupload" 
								data-url="{{ route('backend.jalan.upload',['path'=>'files/uploads/jalan'])}}" 
								data-path="{{url('/files/uploads/jalan/')}}"
								data-type="multiple"
								data-jalanid=""
								multiple accept="image/*" style="display:none">
							<button type="button" class="btn btn-info btn-flat formUpload"><i class="fa fa-upload"></i>Foto!</button>
						</span>
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
<!-- <script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script> -->
<!-- <script type="text/javascript" src="{{ asset('plugins/select2/dist/js/select2.full.min.js')}}"></script> -->
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

