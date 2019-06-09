@extends($ctemplates.'.main')
@section('content-admin')
    <div class="{{$div_box}} {{$div_box}}-default">
        <div class="{{$div_box}}-header with-border">
            <h3 class="{{$div_box}}-title">Mobil</h3>
            <div class="{{$div_box}}-tools text-right">
                <div class="btn-group">
                    
                    
                </div>
            </div>
            
        </div>
            <!-- /.box-header -->
        <div class="{{$div_box}}-body">
        	<table class="display table" cellspacing="0" width="100%" id="table_mobil">
                <thead>
                    <tr>
                        <th></th>
                        <th>Driver</th>
                        <th>Email</th>
                        <th>Tanggal Daftar</th>
                        <th>No Telepon</th>
                        <th>Saldo</th>
                        <th>Dokumen</th>
                        <th>Status</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($driver as $item)
                    <tr>
                        <td></th>
                        <td>{{ $item->name}}</th>
                        <td>{{ $item->email}}</th>
                        <td class="text-center">{{ (isset($item->created_at) !== NULL ? date('D m Y H:i',strtotime($item->created_at)):'-')}}</th>
                        <td>{{ $item->no_telepon}}</th>
                        <td><span class="badge bg-success">{{ $item->wallet}}</span></th>
                        <td><button class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat Dokumen</button></th>
                        <td class="text-center">{!! ($item->isactived==1 ? '<i class="fa fa-check text-green"></i>':'<i class="fa fa-close text-red"></i>') !!}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
                                <span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#">Edit</a></li>
                                    <li><a href="#">Hapus</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>

@endsection
@section('title','Mobil')
@section('style-head')
@parent
<link rel="stylesheet" href="{{ url('/plugins/datatables/datatables.min.css')}}">

@endsection
@section('script-end')
@parent

<script type="text/javascript" src="{{ url('/plugins/jquery-ui/js/jquery-ui.js')}}"></script>

<script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>

@include('layouts.elements.handlebar')
<script src="{{ asset('/js/rm.js') }}"></script>


@endsection