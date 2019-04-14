@extends('layouts.limitless.main')
@section('content-admin')
@php
    $namabidang = '';
    $parent = '';
    $id = '';
    if(session('aksi')== 'edit'){
        $id = $bidang->id;
        $namabidang = $bidang->nama;
        $parent =  $bidang->parent;
    }
@endphp
<form action="{{ route('backend.bidang.post') }}" method="post">
    {{ csrf_field()}}
    <div class="card">
		<div class="card-header header-elements-inline">
			<h5 class="card-title">Tambah / Ubah Bidang</h5>
			<div class="header-elements">
				<div class="list-icons">
		    		<a class="list-icons-item" data-action="collapse"></a>
		    		<a class="list-icons-item" data-action="reload"></a>
		    		<a class="list-icons-item" data-action="remove"></a>
		    	</div>
	    	</div>
		</div>

		<div class="card-body">
			<input type="hidden" id="id" name="id" value="{{$id}}"/>
            <div class="form-group">
                <label>Group:</label>
                <select name="parent" class="form-control">
                    <option value="0">-------</option>
                    @foreach($bidang->get() as $k => $v)
                    <option value="{{ $v->id }}" @if($parent == $v->id) selected @endif>{{$v->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" class="form-control" name="namabidang" value="{{$namabidang}}" placeholder="Nama Bidang">
            </div>	
            
            <div class="text-right">
			    <button type="submit" class="btn btn-primary legitRipple ">Submit <i class="icon-paperplane ml-2"></i></button>
			</div>
		</div>
	</div>
</form>
@endsection
@section('title')
<h4><span class="font-weight-semibold">Register</span> - Pelanggan</h4>
@endsection
@section('breadcrumb')
<a href="{{ route('backend.dashboard.index')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="#" class="breadcrumb-item">Laptop</a>
<span class="breadcrumb-item active">Register Pelanggan</span>
@endsection
@section('script-end')
@parent
<script src="{{ asset('assets/limitless/js/plugins/notifications/bootbox.min.js')}}"></script>
<script src="{{ asset('assets/limitless/js/plugins/forms/selects/select2.min.js')}}"></script>

<script src="{{ asset('assets/limitless/js/plugins/media/fancybox.min.js')}}"></script>

<script src="{{ asset('assets/limitless/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{ asset('assets/limitless/js/plugins/pickers/daterangepicker.js')}}"></script>
<script src="{{ asset('assets/limitless/js/plugins/pickers/anytime.min.js')}}"></script>
<script src="{{ asset('assets/limitless/js/plugins/pickers/pickadate/picker.js')}}"></script>
<script src="{{ asset('assets/limitless/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
<script src="{{ asset('assets/limitless/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
<script src="{{ asset('assets/limitless/js/plugins/pickers/pickadate/legacy.js')}}"></script>
<script src="{{ asset('assets/limitless/js/plugins/notifications/jgrowl.min.js')}}"></script>

<!-- <script src="{{ asset('assets/limitless/js/app.js')}}"></script> --> -->
<script src="{{ asset('assets/limitless/js/demo_pages/gallery.js')}}"></script>
<script>
    // Custom bootbox dialog
    $('#bootbox_custom').on('click', function() {
            bootbox.dialog({
                message: 'Data Telah Tersimpan',
                title: 'Dialog',
                buttons: {
                    success: {
                        label: 'OK!',
                        className: 'btn-success',
                        callback: function() {
                            bootbox.alert({
                                title: 'Success!',
                                message: 'This is a great success!'
                            });
                        }
                    },
                    danger: {
                        label: 'Baru!',
                        className: 'btn-primary',
                        callback: function() {
                            bootbox.alert({
                                title: 'Ohh noooo!',
                                message: 'Uh oh, look out!'
                            });
                        }
                    },
                    main: {
                        label: 'Cetak!',
                        className: 'btn-info',
                        callback: function() {
                            bootbox.alert({
                                title: 'Hooray!',
                                message: 'Something awesome just happened!'
                            });
                        }
                    }
                }
            });
    });
	$('.daterange-single').daterangepicker({ 
        singleDatePicker: true
    });
	$('.pickatime-format').pickatime({

		format: 'h:i a',
		formatLabel: '<b>h</b>:i <!i>a</!i>',
		formatSubmit: 'HH:i',
		hiddenPrefix: 'prefix__',
		hiddenSuffix: '__suffix'
	});
</script>
@endsection