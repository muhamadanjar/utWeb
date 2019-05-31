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
                                <td>{{$item->status}}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection