@extends($ctemplates.'.main')
@section('content-admin')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Paket {{ $type->type }}</h3>
                </div>
                <div class="box-body">
                    <table class="display table table-bordered">
                        <thead>
                            <tr>
                                <td>Paket</td>
                                <td>Harga</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $item)
                            <?php $active_class = ($item->status == 1 ? "eye":"eye") ?>
                            <tr>
                                <td>{{$item->rp_name}}</td>
                                <td>{{$item->rp_total_price}}</td>
                                <td>{!!($item->status == 1 ? "<i class='fa fa-check text-green'></i>":"<i class='fa fa-cross text-red'></i>")!!}</td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-xs btn-icon dropdown-toggle" type="button"><i class="icon-cog4"></i><span class="caret"></span></button>
                                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                                                <li><a class="dropdown-item" href="{{ route('backend.packages.edit', ['id' => $item->rp_id,'type'=>$type->id]) }}"><i class="fa fa-edit"></i> Ubah</a></li>
                                                <li class=""
                                                    data-form="#frmaktif-{{$item->rp_id}}" 
                                                    data-title="Aktif {{ $item->rp_id }}" 
                                                    data-message="Apa anda yakin mengaktifkan/menonaktifkan {{ $item->rp_name }} ?">
                                                    <a class= "dropdown-item formConfirm" href="#"><i class="fa {{$active_class}}"></i> Aktif / Non Aktif</a>
                                                </li>
                                                <form action="{{ route('backend.packages.na', array($item->rp_id) ) }}" method="get" style="display:none" id="frmaktif-{{$item->rp_id}}"></form>
                                            </ul>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script-end')
    @parent
    <script type="text/javascript" src="{{ url('js/rm.js')}}"></script>
@endsection