@extends($ctemplates.'.main')
@section('title','Import Data Jalan')
@section('content-admin')


	<div class="row">
		<div class="col-md-5">
			<div class="box box-default">
				<form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.jalan.import') }}">
					<div class="box-header with-border">
						<h6 class="box-title"><i class="fa fa-road"></i> Form Jalan</h6>
						<div class="box-tools text-right">
							<div class="btn-group pull-right">
								<button type="submit" class="btn btn-sm btn-primary">
									<i class="fa fa-send ico-save"></i> Simpan
								</button>
								<a href="{{ route('backend.jalan.index') }}" class=" btn btn-sm btn-primary">
								<i class="fa fa-mail-reply ico-reply3"></i> Kembali</a>
							</div>
						</div>
					</div>
					<div class="box-body">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label>File Excel</label>
							<input type="file" name="files" id="files"/>
						</div>	
						<div class="form-group">
							<button type="submit" class="btn btn-primary">
								Simpan
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-default">
				<form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.jalan.importskj') }}">
					<div class="box-header with-border">
						<h6 class="box-title"><i class="fa fa-road"></i> Form Detil Jalan</h6>
						<div class="box-tools text-right">
							<div class="btn-group pull-right">
								<button type="submit" class="btn btn-sm btn-primary">
									<i class="fa fa-send ico-save"></i> Simpan
								</button>
								<a href="{{ route('backend.jalan.index') }}" class=" btn btn-sm btn-primary">
								<i class="fa fa-mail-reply ico-reply3"></i> Kembali</a>
							</div>
						</div>
					</div>
					<div class="box-body">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label>File Excel</label>
							<input type="file" name="files" id="files"/>
						</div>	
						<div class="form-group">
							<button type="submit" class="btn btn-primary">
								Simpan
							</button>
						</div>
					</div>
				</form>
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
		$('.select2').select2();
		//Date picker
		loadKecamatan(7472);
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

