@extends($ctemplates.'.main')

@section('content-admin')
  <?php
    $id = '';
    $type_name= old('type');
    $images="";
    $after_min_km = "";
    $min_km = "10";
    $description=old('description');
    $status=old('status');
    $base_harga = old('base_harga');
    $per_min=old('per_min');
    $per_miles=old('per_miles');
    $person_capacity =old('person_capacity');
    $status =old('status');
    $com =old('com');
    if (session('aksi') == 'edit') {
        $id = $type->id;
        $after_min_km = $type->after_min_km;
        $min_km = $type->min_km;
        $type_name= $type->type;
        $images=$type->image;
        $description=$type->description;
        $status=$type->status;
        $base_harga =$type->base_harga;
        $per_min=$type->per_min;;
        $per_miles=$type->per_miles;
        $person_capacity = $type->person_capacity;
        $com=$type->com;
        $status=$type->status;
    }
    
   
  ?>
<form role="form" method="post" action="{{ route('backend.typevehicle.post')}}" enctype='multipart/form-data'>
  {{ csrf_field() }}
  <div class="row">
    
    <div class="col-md-12">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-tag"></i> Reguler</h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                        <h3 class="panel-title"> Reguler</h3>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" name="id" class="form-control" id="id" value="{{$id}}">
                            
                            <div class="form-group hidden {{ $errors->has('merk') ? ' has-error' : '' }}">
                                <label for="merk">Type</label>
                                <input type="text" name="type" class="form-control" id="merk" value="{{$type_name}}">
                            </div>
                            <div class="form-group hidden {{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description">Deskripsi</label>
                                <input type="text" name="description" class="form-control" id="description" value="{{$description}}">
                            </div>
                            <div class="form-group {{ $errors->has('min_km') ? ' has-error' : '' }}">
                                <label for="per_min">Per Minimum (Km)</label>
                                <input type="text" name="min_km" class="form-control" id="min_km" value="{{$min_km}}">
                            </div>
                            <div class="form-group {{ $errors->has('base_harga') ? ' has-error' : '' }}">
                                <label for="per_min">Harga Per Minimum (Rp)</label>
                                <input type="text" name="base_harga" class="form-control" id="base_harga" value="{{$base_harga}}">
                            </div>
                            <div class="form-group {{ $errors->has('after_min_km') ? ' has-error' : '' }}">
                                <label for="per_min">Setelah Minimum (Km)</label>
                                <input type="text" name="after_min_km" class="form-control" id="after_min_km" value="{{$after_min_km}}">
                            </div>
                            <div class="form-group hidden {{ $errors->has('per_min') ? ' has-error' : '' }}">
                                <label for="per_min">Harga (Menit)</label>
                                <input type="text" name="per_min" class="form-control" id="per_min" value="{{$per_min}}">
                            </div>
                            <div class="form-group {{ $errors->has('per_miles') ? ' has-error' : '' }}">
                                <label for="tahun">Harga Setelah Minimum (Rp)</label>
                                <input type="text" name="per_miles" class="form-control" id="per_miles" value="{{$per_miles}}">
                            </div>
                            <div class="form-group hidden {{ $errors->has('person_capacity') ? ' has-error' : '' }}">
                                <label for="tahun">Jumlah Orang</label>
                                <input type="text" name="person_capacity" class="form-control" id="person_capacity" value="{{$person_capacity}}">
                            </div>
                            <div class="form-group {{ $errors->has('com') ? ' has-error' : '' }}">
                                <label for="tahun">Komisi Persentase (%)</label>
                                <input type="number" min="0" max="100" name="com" class="form-control" id="com" value="{{$com}}">
                            </div>
                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status">Status</label>
                                <input type="checkbox" name="status" class="" id="status" {{ $status == 1 ? 'checked' : '' }} value="1">
                            </div>

                            @if(isset($images))
                            <div class="foto hidden">
                                        <?php 
                                        if (file_exists($type->getPath().'/'.$images)) {
                                        ?>
                                        <img src="{{ $type->getPermalink()}}/{{ $images }}" alt="Foto Type" class="img-responsive imgfoto" width="100%">
                                        <?php  
                                        }else{
                                        ?>
                                        <img src="http://placehold.it/180" alt="{{$images}}" class="img-responsive imgfoto" width="100%">
                                        <?php  
                                        }
                                        ?>
                            </div>
                            <div class="input-group margin controlupload hidden">
                                <input type="text" class="form-control txtfoto" readonly="readonly" name="foto" value="{{ $images }}">
                                <span class="input-group-btn">
                                    <input type="file" name="users_file" class="hidden file fileupload" 
                                    data-url="{{ route('backend.typevehicle.upload')}}"
                                    data-type="single"
                                    data-path="{{ asset('/files/uploads/type/')}}"
                                    />
                                    <button type="button" class="btn btn-info btn-flat formUpload">Foto!</button>
                                </span>
                            </div>
                            @endif
                           

                        </div>

                        <div class="panel-footer">
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
            </div>
        </div>
    </div>
  </div>
        
</form>
@endsection
@section('style-head')
@parent

@endsection
@section('script-end')
@parent
        
<script src="{{ asset('plugins/select2/dist/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
</script>
<script src="{{ asset('/js/rm.js')}}"></script>
@endsection
