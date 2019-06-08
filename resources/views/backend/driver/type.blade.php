@extends($ctemplates.'.main')
@section('content-admin')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Type Mobil</h3>
                </div>
                <div class="box-body">
                    <table class="display table table-bordered">
                        <thead>
                            <tr>
                                <td>Type</td>
                                <td>Description</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($type as $item)
                            <tr>
                                <td>{{$item->type}}</td>
                                <td>{{$item->description}}</td>
                                <td>{!!$item->status == 1 ? "<i class='fa fa-check'></i>":"<i class='fa fa-close'></i>"!!}</td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-xs btn-icon dropdown-toggle" type="button"><i class="icon-cog4"></i><span class="caret"></span></button>
                                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                                                <li><a class="dropdown-item" href="{{ route('backend.typevehicle.edit', ['id' => $item->id]) }}"><i class="fa fa-edit"></i> Ubah</a></li>
                                                <li class=""
                                                    data-form="#frmdelete-{{$item->id}}" 
                                                    data-title="Aktif {{ $item->id }}" 
                                                    data-message="Apa anda yakin menghapus {{ $item->type }} ?">
                                                    <a class= "dropdown-item formConfirm" href="#"><i class="fa fa-close"></i> Hapusf</a>
                                                </li>
                                                <form action="{{ route('backend.packages.na', array($item->id) ) }}" method="post" style="display:none" id="frmdelete-{{$item->id}}">
                                                    {{ @csrf_field() }}
                                                </form>
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