@extends($ctemplates.'.main')
@section('content-admin')

    <div class="row">
    <div class="col-md-12">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-road" style="color:#3097D1"></i> Data Jalan</h3>
            <div class="box-tools pull-right">
                <div class="btn-group">
                <?php if(\Gate::check('create.jalan')){ ?>
                   <a href="{{route('backend.jalankondisi.add')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-square"></i> Tambah</a>
                <?php } ?>   
                </div>
            </div>
            
        </div>
        <div class="box-body">
            <form id="table_jalankondisi_search_form">
                <div class="row">
                    <div class="col-md-6" style="float:right">
                        <div class="input-group input-group-sm"> 
                            
                            <input type="text" class="form-control" id="q" name="q" placeholder="Cari">
                            
                            <div class="input-group-btn">
                                
                                <button type="submit" class="btn btn-primary">Proses</button>        
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" >
                    
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                    
                    </div>
                </div>
                
            </form>
        	<table id="table_jalankondisi" class="display table table-responsive table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>No Ruas</th>
                        <th>Nama Ruas</th>
                        <th>Panjang</th>
                        <th>Lebar</th>
                        <th>Kecamatan</th>
                        <th>Tahun</th>
                        <th>Pembiayaan</th>
                        <th>Biaya</th>
                        <th>Jenis</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            
        </div>
    </div>
    </div>
    </div>

@endsection
@section('style-head')
@parent
<link rel="stylesheet" href="{{ url('/plugins/datatables/datatables.min.css')}}">
<style>
.dt-buttons.btn-group {
    float: right;
}
</style>
@endsection

@section('script-end')
@parent
<script>
var api_token = '{!! auth()->user()->api_token !!}';
</script>

<script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ url('/plugins/bootbox/js/bootbox.js') }}"></script>
@include('layouts.handlebar')
<script type="text/javascript" src="{{ url('js/rm.js')}}"></script>




@endsection