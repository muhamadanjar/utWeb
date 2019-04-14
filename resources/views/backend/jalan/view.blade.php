@extends($ctemplates.'.main')
@section('content-admin')
    <div class="invoice">
        <div class="row">
            <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-road"></i> {{$jalan->nama_ruas}}.
                <small class="pull-right">Tanggal: {{$jalan->updated_at}}</small>
            </h2>
            </div>
        <!-- /.col -->
        </div>
      <!-- info row -->
        
      <!-- /.row -->

      <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                    <th>No Ruas</th>
                    <th>Nama Ruas</th>
                    <th>Kecamatan</th>
                    <th>Keterangan</th>
                    <th>Panjang</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td>{{$jalan->no_ruas}}</td>
                    <td>{{$jalan->nama_ruas}}</td>
                    <td>{{$jalan->kecamatan}}</td>
                    <td>{{$jalan->ket}}</td>
                    <td>{{$jalan->panjang}} Km</td>
                    </tr>
                
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
      <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <div class="table-responsive">
                    <table class="table">
                    <tr>
                        <th style="width:50%">Baik:</th>
                        <td>{{$jalan->ptk_baik_km}} Km ({{$jalan->ptk_baik_persentase}}%)</td>
                    </tr>
                    <tr>
                        <th>Kerikil:</th>
                        <td>{{$jalan->ptk_sedang_km}} Km ({{$jalan->ptk_sedang_persentase}}%)</td>
                    </tr>
                    <tr>
                        <th>Tanah:</th>
                        <td>{{$jalan->ptk_rusakringan_km}} Km ({{$jalan->ptk_rusakringan_persentase}}%)</td>
                    </tr>
                    <tr>
                        <th>Beton:</th>
                        <td>{{$jalan->ptk_rusakberat_km}} Km ({{$jalan->ptk_rusakberat_persentase}}%)</td>
                    </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                
                <div class="table-responsive">
                    <table class="table">
                    <tr>
                        <th style="width:50%">Aspal:</th>
                        <td>{{$jalan->ptjp_aspal}}</td>
                    </tr>
                    <tr>
                        <th>Kerikil:</th>
                        <td>{{$jalan->ptjp_kerikil}}</td>
                    </tr>
                    <tr>
                        <th>Tanah:</th>
                        <td>{{$jalan->ptjp_tanah}}</td>
                    </tr>
                    <tr>
                        <th>Beton:</th>
                        <td>{{$jalan->ptjp_beton}}</td>
                    </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
      <!-- /.row -->
      <div class="row">
							@if(isset($file))
							@foreach($file as $files)								
							<!-- <div class="col-sm-6">
								<img class="img-responsive" src="{{$jalan->getPermalink()}}{{ $files->namafile }}" alt="Photo">
							</div> -->
							<div class="col-sm-6">
                                <div class="file-man-box">
                                    <div class="file-img-box">
                                        <img src="{{$jalan->getPermalink()}}{{ $files->namafile }}" class="img img-responsive" alt="icon">
                                    </div>
                                        
    
                                </div>
                            </div>
							@endforeach
							
							@endif
						</div>
    </div>
        <!-- this row will not appear when printing -->
        

@endsection
@section('script-end')
@parent
<script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/select2/dist/js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{ url('/plugins/bootbox/bootbox.js') }}"></script>
<script type="text/javascript" src="{{ url('js/rm.js')}}"></script>

@endsection

