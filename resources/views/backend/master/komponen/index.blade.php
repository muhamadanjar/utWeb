
@extends('layouts.limitless.main')
@section('content-admin')
    <div class="card">
		<div class="card-header header-elements-inline">
						<h5 class="card-title">Data jenis</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
		</div>
		<div class="card-body">
			
		</div>
		<table class="table datatable-responsive-column-controlled">
			<thead>
				<tr>
					<th></th>
					<th>jenis</th>
					<th>Grup</th>
                    <th>Nama komponen/Sub komponen</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
                @foreach($komponen as $k => $v)
                <tr>
					<th></th>
					<th>{{isset($v->jenis) ? $v->jenis->nama:'-'}}</th>
					<th>{{isset($v->parentgroup) ? $v->parentgroup->nama:'-'}}</th>
                    <th>{{$v->nama}}</th>
					<th class="text-center">
						<div class="list-icons">
							<div class="dropdown">
								<a href="#" class="list-icons-item" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a href="{{ route('backend.komponen.edit',[$v->id]) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
									<a href="{{ route('backend.komponen.destroy',[$v->id]) }}" class="dropdown-item"><i class="icon-trash"></i> Hapus</a>
								</div>
							</div>
						</div>
					</th>
				</tr>
                @endforeach
            </tbody>
		</table>
	</div>
	

@endsection                
@section('title')
<h4><span class="font-weight-semibold">Data</span> komponen</h4>
@endsection
@section('breadcrumb')
<a href="{{ route('backend.dashboard.index')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<a href="#" class="breadcrumb-item">Master</a>
<span class="breadcrumb-item active">Data komponen</span>
@endsection

@section('script-end')
@parent
<script src="{{ asset('assets/limitless/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('assets/limitless/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
<script src="{{ asset('assets/limitless/js/plugins/forms/selects/select2.min.js')}}"></script>

<script src="{{ asset('assets/limitless/js/demo_pages/datatables_responsive.js')}}"></script>

@endsection