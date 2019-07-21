@extends('templates::adminlte.main')

@section('content-admin')
  <?php
    $id = '';
    $no_plat= old('no_plat');
    $merk=old('merk');
    $type=old('type');
    $warna=old('warna');
    $harga=old('harga');
    $tahun=old('tahun');
    $fotoMobil = '';
    $harga_perjam =old('harga_perjam');
    $deposit=0;
    $driverName='';
    $username='';
    $password='';
    $email='';
    $no_telp='';
    $nip='';
    $alamat='';

    $mobilName = '';
    $tahun = '';
    
    if (session('aksi') == 'edit') {
        $id = $mobil->id;
        $no_plat= $mobil->no_plat;
        $merk= $mobil->merk;
        $type = $mobil->type;
        $warna = $mobil->warna;
        $harga = $mobil->harga;
        $harga_perjam = $mobil->harga_perjam;
        $mobilName = $mobil->name;
        $tahun = $mobil->tahun;
        $fotoMobil = $mobil->foto;

        $driverName = $officers->name;
        $username = $user->username;
        $password = $user->password;
        $email = $user->email;
        $nip = $officers->nip;
        
        $no_telp = $officers->no_telp;
        $alamat = $officers->alamat;
        $deposit=$officers->deposit;
    }
    
   
  ?>
<form role="form" method="post" action="{{ route('backend.mobil.driver')}}" enctype='multipart/form-data'>
  {{ csrf_field() }}
  <div class="row">
    
    <div class="col-md-12">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-tag"></i> Tambah Pengemudi</h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                        <h3 class="panel-title"> Data Mobil</h3>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" name="id" class="form-control" id="id" value="{{$id}}">
                            
                            <div class="form-group {{ $errors->has('no_plat') ? ' has-error' : '' }}">
                                <label for="no_plat">No Plat</label>
                                <input type="text" name="no_plat" class="form-control" id="no_plat" value="{{$no_plat}}">
                            </div>
                            <div class="form-group {{ $errors->has('merk') ? ' has-error' : '' }}">
                                <label for="merk">Type Mobil</label>
                                <!--<select name="merk" class="select2 form-control" id="merk">
                                    <option value="--">----</option>

                                    @foreach($merkselect as $k => $v)
                                    <option value="{{$v->merk}}">{{$v->merk}}</option>
                                    @endforeach
                                </select>-->
                                <input type="text" name="merk" class="form-control" id="merk" value="{{$merk}}">
                            </div>
                            <div class="form-group {{ $errors->has('mobil_name') ? ' has-error' : '' }}">
                                <label for="mobil_name">Nama Mobil</label>
                                <input type="text" name="mobil_name" class="form-control" id="mobil_name" value="{{$mobilName}}">
                            </div>
                            <!--<div class="form-group">
                                <label for="type">Type Mobil</label>
                                
                                <select name="type" class="select2 form-control" id="type">
                                    <option value="--">----</option>

                                    @foreach($typeselect as $k => $v)
                                    <option value="{{$v->type}}">{{$v->type}}</option>
                                    @endforeach
                                </select>
                            </div>-->
                            <div class="form-group {{ $errors->has('warna') ? ' has-error' : '' }}">
                                <label for="warna">Warna Mobil</label>
                                <input type="text" name="warna" class="form-control" id="warna" value="{{$warna}}">
                            </div>
                            <div class="form-group {{ $errors->has('tahun') ? ' has-error' : '' }}">
                                <label for="tahun">Tahun Mobil</label>
                                <input type="text" name="tahun" class="form-control" id="tahun" value="{{$tahun}}">
                            </div>
                            @if(isset($mobil))
                            <div class="foto">
                                        <?php 
                                        if (file_exists($mobil->getPath().'/'.$fotoMobil)) {
                                        ?>
                                        <img src="{{ $mobil->getPermalink()}}/{{ $fotoMobil }}" alt="Foto Mobil" class="img-responsive imgfoto" width="100%">
                                        <?php  
                                        }else{
                                        ?>
                                        <img src="http://placehold.it/180" alt="{{$fotoMobil}}" class="img-responsive imgfoto" width="100%">
                                        <?php  
                                        }
                                        ?>
                            </div>
                            <div class="input-group margin controlupload">
                                        <input type="text" class="form-control txtfoto" readonly="readonly" name="foto" value="{{ $fotoMobil }}">
                                        <span class="input-group-btn">
                                            <input type="file" name="users_file" class="hidden file fileupload" data-url="{{ route('backend.mobil.changephoto',['id'=>$id])}}" data-path="/images/uploads/car/">
                                            <button type="button" class="btn btn-info btn-flat formUpload">Foto!</button>
                                        </span>
                            </div>
                            @endif
                            <!--<div class="form-group {{ $errors->has('harga') ? ' has-error' : '' }}">
                                <label for="harga">Harga Mobil (per Kilo)</label>
                                <input type="text" name="harga" class="form-control" id="harga" value="{{$harga}}">
                            </div>
                            <div class="form-group {{ $errors->has('harga_perjam') ? ' has-error' : '' }}">
                                <label for="harga_perjam">Harga Mobil (per Jam)</label>
                                <input type="text" name="harga_perjam" class="form-control" id="harga_perjam" value="{{$harga_perjam}}">
                            </div>-->

                        </div>

                        <div class="panel-footer">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"> Data Personal</h3>
                        </div>
                        <div class="panel-body">
                            
                            <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" placeholder="Full name" name="name" value="{{$driverName}}">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" placeholder="Username" name="username" value="{{$username}}">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{$email}}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" class="form-control" placeholder="Password" name="password" value="{{$password}}">
                                <span class="fa fa-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation" value="{{$password}}">
                                <span class="fa fa-lock form-control-feedback"></span>
                            </div>
                            @if(session('aksi') == 'edit')	
                                <input type="hidden" class="form-control" name="oldpassword" value="{{ $password }}">			
                            @endif
                            <div class="form-group has-feedback {{ $errors->has('jk') ? ' has-error' : '' }}">
                                <select name="jk" id="jk">
                                    <option value=""></option>
                                    <option value="L">Laki - laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <span class="fa fa-mobile-phone form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('provinsi') ? ' has-error' : '' }}">
                                <select name="provinsi" id="provinsi">
                                    <option value=""></option>
                                    
                                </select>
                                <span class="fa fa-mobile-phone form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('kabupaten') ? ' has-error' : '' }}">
                                <select name="kabupaten" id="kabupaten">
                                    <option value=""></option>
                                    
                                </select>
                                <span class="fa fa-mobile-phone form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback {{ $errors->has('no_telp') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" placeholder="No Telp/Handphone" name="no_telp" value="{{$no_telp}}">
                                <span class="fa fa-mobile-phone form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('nip') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" placeholder="No KTP" name="nip" value="{{$nip}}">
                                <span class="fa fa-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('alamat') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="{{$alamat}}">
                                <span class="fa fa-home form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('kode_pos') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" placeholder="Kode Pos" name="kode_pos" value="{{$kode_pos}}">
                                <span class="fa fa-home form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" placeholder="Nama Bank" name="bank_name" value="{{$kode_pos}}">
                                <span class="fa fa-home form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('bank_location') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" placeholder="Lokasi Bank" name="bank_location" value="{{$kode_pos}}">
                                <span class="fa fa-home form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('no_rekening') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" placeholder="Lokasi Bank" name="no_rekening" value="{{$kode_pos}}">
                                <span class="fa fa-home form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <b>Saldo:</b> {{$deposit}}
                                <input type="hidden" class="form-control" placeholder="Deposit" name="deposit_temp" value="{{$deposit}}">
                            </div>

                        </div>

                        <div class="panel-footer">
                            <div class="form-group has-feedback {{ $errors->has('deposit') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" placeholder="Deposit" name="deposit">
                                <span class="fa fa-money form-control-feedback"></span>
                            </div>
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
