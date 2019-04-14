@extends('layouts.admin.admin')
@section('content-admin')
    <div class="row">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading ">
            <h3 class="panel-title"><i class="fa fa-building"></i>Data Faq</h3>
            <div class="panel-toolbar text-right">
                <div class="btn-group">
                    <?php //if(\Gate::check('create.global')){ ?>
                        <a href="{{ route('backend.faq.create') }}" class="btn btn-primary btn-flat btn-sm"><span class="fa fa-plus"></span> Tambah</a>
                    <?php //} ?>
                </div>
            </div>
            
        </div>
        <div class="panel-body">
        	<table id="table_dom" class="display table table-responsive table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="3%"></th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th>Aktif</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faq as $key => $p)
                    <tr>
                        <td>
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-sm btn-default btn-flat dropdown-toggle" type="button">
                                <i class="caret"></i>&nbsp;
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('backend.faq.edit',array($p->id)) }}"><i class="fa fa-edit"></i> Edit</a></li>
                                    <li data-form="#frmDelete-{{ $p->id }}" 
                                        data-title="Hapus Informasi" 
                                        data-message="Anda yakin menghapus informasi ini ?">
                                        <a href="#" class="formConfirm"><i class="fa fa-trash"></i> Hapus</a></li>
                                        <form 
                                            action="{{ route('backend.faq.destroy',array($p->id)) }}" 
                                            method="post" 
                                            style="display:none" 
                                            id="frmDelete-{{ $p->id }}">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="DELETE">    
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>{{ $p->pertanyaan }}</td>
                        <td>{{ substr(strip_tags($p->jawaban), 0, 250) }}...</td>
                        <td>{{ $p->aktif }}</td>        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>

@endsection
@section('title','Agenda')
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-transparent nm">
    <li class="active"><a href="javascript:void(0);">Agenda</a></li>
</ol>
@endsection
@section('style-head')
@parent
<link rel="stylesheet" href="{{ url('assets/plugins/datatables/css/datatables.css')}}">
<link rel="stylesheet" href="{{ url('assets/plugins/datatables/css/tabletools.css')}}">
@endsection
@section('script-end')
@parent
<script type="text/javascript" src="{{ url('assets/plugins/selectize/js/selectize.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/jquery-ui/js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/jquery-ui/js/addon/timepicker/jquery-ui-timepicker.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/jquery-ui/js/jquery-ui-touch.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/inputmask/js/inputmask.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/select2/js/select2.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/touchspin/js/jquery.bootstrap-touchspin.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/javascript/backend/forms/element.js')}}"></script>

<script type="text/javascript" src="{{ url('assets/plugins/datatables/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/datatables/tabletools/js/dataTables.tableTools.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/datatables/js/datatables-bs3.js')}}"></script>
<script type="text/javascript" src="{{ url('js/sikko.js')}}"></script>
@endsection