@extends($ctemplates.'.main')
@section('content-admin')
    <div class="{{$div_box}} {{$div_box}}-default">
        <div class="{{$div_box}}-header with-border">
            <h3 class="{{$div_box}}-title">Driver </h3>
            <div class="{{$div_box}}-tools text-right">
                <div class="btn-group">
                    <a class="btn btn-primary btn-sm" href="{{ route('backend.driver.create')}}"><i class="fa fa-plus"></i> Tambah Driver</a>
                </div>
            </div>
            
        </div>
            <!-- /.box-header -->
        <div class="{{$div_box}}-body">
        	<table class="display table" cellspacing="0" width="100%" id="table_dom">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Driver</th>
                        <th>Email</th>
                        <th>Tanggal Daftar</th>
                        <th>No Telepon</th>
                        <th>Saldo</th>
                        {{-- <th>Dokumen</th> --}}
                        <th>Status</th>
                        <th>Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $no=1;?>
                    @foreach ($driver as $item)
                    <?php if ($item->isonline == 1) {
                        $avail = 'Tersedia';
                    }else if($item->isonline == 2){
                        $avail = 'Menjemput';
                    }else if($item->isonline == 3){
                        $avail = 'Sampai titik jemput';
                    }else if($item->isonline == 4){
                        $avail = 'Perjalanan';
                    }else{
                        $avail = '-';
                    }
                    ?>
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{ $item->name}}</td>
                        <td>{{ $item->email}}</td>
                        <td class="text-center">{{ (isset($item->created_at) !== NULL ? date('D m Y H:i',strtotime($item->created_at)):'-')}}</td>
                        <td>{{ $item->no_telepon}}</td>
                        <td><span class="badge bg-success">{{ $item->wallet}}</span><button data-form="#frm_saldo-{{$item->id}}" data-userid="{{ $item->id }}"  class="btn btn-sm btn-success btn-xs formConfirmSaldo">Tambah Saldo</button></td>
                        {{-- <td><button class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat Dokumen</button></th> --}}
                        <td class="text-center">{!! $avail !!}</td>
                        <td class="text-center">{!! ($item->isactived==1 ? '<i class="fa fa-check text-green"></i>':'<i class="fa fa-close text-red"></i>') !!}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
                                <span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="{{ route('backend.driver.edit',array('id'=>$item->id)) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li class=""
                                            data-form="#frdelete-{{$item->id}}" 
                                            data-title="Delete User {{ $item->id }}" 
                                            data-message="Apa anda yakin Menghapus {{ $item->name }} ?">
                                            <a class= "dropdown-item formConfirm" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                        </li>
                                        <form action="{{ route('backend.driver.destroy', array($item->id) ) }}" method="post" style="display:none" id="frdelete-{{$item->id}}">
                                            <input type="hidden" name="_method" value="delete">
                                            {{ @csrf_field() }}
                                        </form>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php $no++;?>
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

<script src="{{ asset('/js/rm.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        
        $(".desctooltips").tooltip();
        $('.formConfirmSaldo').on('click', function (e) {
            e.preventDefault();
            if ($(this).hasClass('disabled')) return;
            var el = $(this);
            var userId = el.attr('data-userId');
            $('#formSaldo').find('#iRiderId').val(userId);
            $('#formSaldo')
            .find('form').attr('action',"<?php echo url('backend/driver/addsaldo')?>");
            $('#formSaldo').modal('show');

        });

        $('#formSaldo').on('click', '#frm_submit', function (e) {
            var id = $(this).attr('data-form');
            //console.log(id);
            $(id).submit();
        });
    });
</script>


@endsection