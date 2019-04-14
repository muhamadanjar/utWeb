@extends('layouts.limitless.main')

@section('content-admin')
  <?php
    $id = '';
    $judul_dokumen='';
    $tanggal='';
    $upload = '';
    $kategori = '';
    
    if (session('aksi') == 'edit') {
      $id = $dokumen->id;
      $judul_dokumen = $dokumen->judul_dokumen;
      $tanggal= $dokumen->tanggal;
      $upload = $dokumen->upload;
      $kategori = $dokumen->kategori;
    }
  ?>
<form role="form" method="post" action="{{ route('backend.dokumen.post')}}" enctype='multipart/form-data'>
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"> Dokumen</h3>
            </div>
            <div class="card-body">
                <input type="hidden" name="id" class="form-control" id="id" value="{{$id}}">
                <div class="form-group">
                  <label for="judul_info">Judul Dokumen</label>
                  <input type="text" name="judul_dokumen" class="form-control" id="judul_info" value="{{$judul_dokumen}}">
                </div>
                <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input type="text" name="tanggal" class="form-control datepicker" id="tanggal" value="{{$tanggal}}">
                </div>
                <div class="form-group">
                  <label for="tanggal">Kategori</label>
                  <select name="kategori" class="form-control">
                    <option value="">-----------</option>
                    @foreach($dokumen->getKategori() as $key)
                    <option value="{{$key}}" @if($kategori == $key) selected @endif>{{$key}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="tanggal">File Upload</label>
                  <div class="input-group">
                    <input type="text" name="file_name" class="form-control" id="file_name">
                      <input type="file" id="filedokumen" class="d-none filedokumen" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                      <span class="input-group-append">
                        <button class="btn btn-sm bg-indigo btn-browsedokumen" type="button">
                        <i class="icon-upload"></i>
                        </button>
                      </span>
                  </div>
                </div>
            </div>

            <div class="card-footer">
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
<script type="text/javascript">
        $(function () {
            //Date picker
            $('#tanggal').datepicker({
                autoclose: true
            });
        });
</script>
<script type="text/javascript" src="{{ url('js/rm.js')}}"></script>
@endsection
