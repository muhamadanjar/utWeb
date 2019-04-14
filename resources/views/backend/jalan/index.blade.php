@extends($ctemplates.'.main')
@section('content-admin')

<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header with-border">
                <h3 class="card-title"><i class="fa fa-road" style="color:#3097D1"></i> Data Jalan</h3>
                <div class="card-tools pull-right">
                    <div class="btn-group">
                        <?php if(\Gate::check('create.jalan')){ ?>
                        <a href="{{route('backend.jalan.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-square"></i>
                            Tambah</a>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <form id="table_jalan_search_form">
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-xs-12" style="float:right">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="q" name="q" placeholder="Cari">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Proses</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                        </div>
                    </div>

                </form>
                <table id="table_jalan" class="display table table-responsive table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No Ruas</th>
                            <th>Nama Ruas</th>
                            <th>Kecamatan</th>
                            <th>Panjang</th>
                            <th>Lebar</th>
                            <th>Aspal</th>
                            <th>Beton</th>
                            <th>Kerikil</th>
                            <th>Tanah</th>
                            <th>Akses Jalan</th>
                            <th>Pembiayaan</th>
                            <th>Tahun</th>
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
<script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ url('/plugins/bootbox/js/bootbox.js') }}"></script>
<script type="text/javascript" src="{{ url('js/datatable_app.js')}}"></script>
@endsection