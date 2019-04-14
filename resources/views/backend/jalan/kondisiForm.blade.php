@extends($ctemplates.'.main')
@section('title','Jalan')
@section('content-admin')
<?php

if(session('aksi') == 'edit'){
	$id =$jalan->id;
    $no_ruas = $jalan->no_ruas;
    $nama_ruas = $jalan->nama_ruas;
	
	$panjang = $jalan->panjang;
    $lebar = $jalan->lebar;
    $kec_dilalui = $jalan->kecamatan_dilalui;
	$tahun= $jalan->tahun;
	$jenis = $jalan->jenis;
	
    $pembiayaan = $jalan->pembiayaan;
    $biaya = $jalan->biaya;
	$keterangan = $jalan->ket;
	$ex = 0;
	
	if(strpos($kec_dilalui,",") == true){
		$ex = explode(",",$kec_dilalui);
	}
    
}else{
    $id =$id_jalan;
    $no_ruas = '';
    $nama_ruas = '';
	
	$panjang = '';
    $lebar = '';
    $kec_dilalui = '';
	$tahun= '';
	$jenis = '';
	
    $pembiayaan = '';
    $biaya = '';

	

	$keterangan = '';
	
	
}
?>

<form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.jalan.kondisipost') }}">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title"><i class="fa fa-road"></i> Form Jalan</h4>
					<div class="box-toolbar text-right">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-send ico-save"></i> Simpan
                            </button>
                            <a href="{{ route('backend.jalan.kondisiindex') }}" class=" btn btn-sm btn-primary">
                            <i class="fa fa-mail-reply ico-reply3"></i> Kembali</a>
                        </div>
                    </div>
				</div>
				<div class="box-body">
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{ $id }}">
						
					<div class="form-group {{ $errors->has('no_ruas') ? ' has-error' : '' }}">
						<label>No Ruas</label>
						<input type="text" class="form-control" name="no_ruas" value="{{ $no_ruas }}">
						<div class="col-md-6"></div>
					</div>

                    <div class="form-group {{ $errors->has('nama_ruas') ? ' has-error' : '' }}">
						<label>Nama Ruas</label>
						<input type="text" class="form-control" name="nama_ruas" value="{{ $nama_ruas }}">
						<div class="col-md-6"></div>
					</div>

					<div class="form-group {{ $errors->has('kec_dilalui') ? ' has-error' : '' }}">
						<label>Kecamatan (Yang dilalui)</label>
						
						<select name="kec_dilalui[]" class="form-control select2" id="kec_dilalui" multiple="multiple">
							<option value="0">----------</option>
							{!!$kecamatan!!}
                            
                            
						</select>
					</div>

                    <div class="form-group {{ $errors->has('tahun') ? ' has-error' : '' }}">
						<label>Tahun</label>
						<input type="text" class="form-control" name="tahun" value="{{ $tahun }}">
						<div class="col-md-6"></div>
					</div>

                    <div class="form-group {{ $errors->has('jenis') ? ' has-error' : '' }}">
						<label>Jenis</label>
						
						<select name="jenis" class="form-control" id="jenis">
							<option value="0">----------</option>
                            <option @if($jenis==1) selected @endif value="1">Perbaikan</option>
                            <option @if($jenis==2) selected @endif value="2">Peningkatan</option>
                            <option @if($jenis==3) selected @endif value="3">Pembangunan</option>
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
								<input type="text" class="form-control numberonly" placeholder="Panjang (Km)" name="panjang" id="panjang" value="{{ $panjang }}">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control numberonly" placeholder="Lebar (m)" name="lebar" id="lebar" value="{{ $lebar }}">
							</div>
						</div>
					</div>

					
					<div class="form-group {{ $errors->has('pembiayaan') ? ' has-error' : '' }}">
						<label for="no_ruas_pangkal">Pembiayaan</label>
						<input type="text" class="form-control" id="pembiayaan" name="pembiayaan" value="{{$pembiayaan}}" placeholder="Pembiayaan">
					</div>

                    <div class="form-group {{ $errors->has('biaya') ? ' has-error' : '' }}">
						<label for="no_ruas_pangkal">Biaya</label>
						<input type="text" class="form-control numberonly" id="biaya" name="biaya" value="{{$biaya}}" placeholder="Biaya">
					</div>

					<div class="form-group {{ $errors->has('keterangan') ? ' has-error' : '' }}">
						<label for="no_ruas_pangkal">Keterangan</label>
						<textarea class="form-control" id="keterangan" name="keterangan">
							{{$keterangan}}
						</textarea>
					</div>
					
						
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							Simpan
						</button>
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

@endsection
@section('script-end')
@parent
<script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/select2/dist/js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{ url('/plugins/bootbox/js/bootbox.js') }}"></script>
<script type="text/javascript" src="{{ url('js/rm.js')}}"></script>
<script type="text/javascript">
    $(function () {
        //Initialize Select2 Elements
		$('#kec_dilalui').select2({
			tags: true,
    		tokenSeparators: [',', ' ']
		});
		//Date picker
		//loadKecamatan(7472);
		CKEDITOR.replace( 'keterangan', {
            toolbar : [
				{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
				{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
				{ name: 'tools', items : [ 'Maximize','-' ] }
			]
        } );
    
	});
</script>

@endsection

