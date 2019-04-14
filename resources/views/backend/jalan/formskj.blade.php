@extends($ctemplates.'.main')
@section('title','Form SKJ Per 100 Km')
@section('content-admin')
<?php
$no_ruas = '';
$nama_ruas = '';
$id = $JalanID;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header with-border">
                <h6 class="card-title"><i class="fa fa-road"></i> Form STA Jalan</h6>
                <div class="card-toolbar text-right">
                    <div class="btn-group pull-right">
                        <a href="{{ route('backend.jalan.index') }}" class=" btn btn-sm btn-primary">
                        <i class="fa fa-mail-reply ico-reply3"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" class="form-control" name="provinsi" value="{{ $no_ruas }}">
                            <div class="col-md-5"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No Ruas</label>
                            <input type="text" class="form-control" name="no_ruas" value="{{ $jalan->no_ruas }}">
                            <input type="hidden" class="form-control" name="jalan_id_primary" id="jalan_id_primary" value="{{$id}}">
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Ruas</label>
                            <input type="text" class="form-control" name="nama_ruas" value="{{ $jalan->nama_ruas }}">
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                    
                </div>              
                <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-tambah-djalan btn-success" data-toggle="modal" data-target="#form-djalan">
                            <i class="fa fa-plus-square"></i>
                            Tambah
                        </button>
                        
                    </span>
                    
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-tambah-djalan btn-primary" data-toggle="modal" data-target="#form-import-data">
                            <i class="fa fa-upload"></i>
                            Import Data
                        </button>
                    </span>
                </div>
                <table id="table_djalan" class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th width='15%'>Aksi</th>
                            <th>Dari M</th>
                            <th>Sampai M</th>
                            <th>Tipe Jalan</th>
                            <th>Nilai IRI</th>
                            <th>Nilai SDI</th>
                            <th>Baik</th>
                            <th>Sedang</th>
                            <th>Rusak Ringan</th>
                            <th>Rusak Berat</th>
                            <th>Lajur</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="modal fade" id="form-import-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">               
                                <h5 class="modal-title" id="exampleModalLabel">Import Data Jalan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form data-toggle="validator" id="import-detil-jalan" enctype="multipart/form-data" method="post" action="{{ route('backend.jalan.uploadiri')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="jalan_id" id="jalan_id" value="{{$id}}">
                                    <input type="hidden" name="no_ruas" id="no_ruas" value="{{$jalan->no_ruas}}">
                                    <div class="form-group">
                                        <label>File :</label>
                                        <input type="file" name="file_upload"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Lajur :</label>
                                        <select name="lajur_ke" id="lajur" class="form-control">
                                            {{ $jalan->jumlah_lajur}}
                                            @for($i=1;$i <= $jalan->jumlah_lajur;$i++)
                                            <option>{{$i}}</option>
                                            @endfor
                                        </select>
                                        
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            

                <div id="form-djalan" class="modal fade" data-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detil Jalan</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                
                                <form id="formSKJ" action="#" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" class="form-control" placeholder="Dari Km" name="jalan_id" id="jalan_id" value="{{$id}}">
                                    <input type="hidden" class="form-control" placeholder="Dari Km" name="no_ruas" id="no_ruas" value="{{$jalan->no_ruas}}">
                                    
                                    <select name="tipe_jalan" id="tipe_jalan" class="form-control">
                                        <option value="aspal">Aspal</option>
                                        <option value="tanah">Tanah/Agregat</option>
                                        <option value="rijit">Rijit</option>
                                    </select>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4> Patok Km</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label"> Dari (m)</label>
                                                <input type="text" class="form-control numberonly" placeholder="Dari M" name="dari_km" id="dari_km">

                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label"> Sampai (m)</label>
                                                <input type="text" class="form-control numberonly" placeholder="Sampai M" name="sampai_km" id="sampai_km">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label"> Nilai IRI</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control numberonly" placeholder="Nilai IRI" name="nilai_iri" id="nilai_iri">
                                                    <input type="file" id="fileiri" class="d-none fileiri" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                                    <span class="input-group-append">
                                                            <button class="btn btn-sm bg-indigo btn-browseiri" type="button">
                                                            <i class="icon-upload"></i>
                                                            </button>
                                                    </span>


                                                </div>
                                                
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label"> Lajur</label>
                                                <select name="lajur_ke" id="lajur" class="form-control">
                                                    {{ $jalan->jumlah_lajur}}
                                                    @for($i=1;$i <= $jalan->jumlah_lajur;$i++)
                                                    <option>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title"><span class="font-weight-semibold">Permukaan Perkerasan</span></h6>
                                        </div>
                                        
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header bg-white header-elements-inline">
                                                            <h6 class="card-title">Susunan</h6>
                                                            <div class="header-elements">
                                                            
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label class="font-weight-semibold">Susunan</label>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_susunan" name="pp_susunan" checked="" value="1">
                                                                        Baik
                                                                    </label>
                                                                </div>

                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_susunan" name="pp_susunan" value="2">
                                                                        Kasar
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header bg-white header-elements-inline">
                                                            <h6 class="card-title">Kondisi</h6>
                                                            <div class="header-elements">
                                                            
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_kondisi" name="pp_kondisi" checked="" value="1">
                                                                        Baik / Tidak ada Kelainan
                                                                    </label>
                                                                </div>

                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_kondisi" name="pp_kondisi" value="2">
                                                                        Aspal Berlebihan
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_kondisi" name="pp_kondisi" value="3">
                                                                        Lepas - Lepas
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_kondisi" name="pp_kondisi" value="4">
                                                                        Hancur
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header bg-white header-elements-inline">
                                                            <h6 class="card-title">Kemiringan Melintang</h6>
                                                            <div class="header-elements">
                                                            
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_kemiringan_melintang" name="pp_kemiringan_melintang" checked="" value="1">
                                                                        Baik / Tidak ada Kelainan
                                                                    </label>
                                                                </div>

                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_kemiringan_melintang" name="pp_kemiringan_melintang" value="2">
                                                                        Aspal Berlebihan
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_kemiringan_melintang" name="pp_kemiringan_melintang" value="3">
                                                                        Lepas - Lepas
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_kemiringan_melintang" name="pp_kemiringan_melintang" value="4">
                                                                        Hancur
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header bg-white header-elements-inline">
                                                            <h6 class="card-title">Penurunan</h6>
                                                            <div class="header-elements">
                                                            
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_penurunan" name="pp_penurunan" checked="" value="1">
                                                                        Tidak ada
                                                                    </label>
                                                                </div>

                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_penurunan" name="pp_penurunan" value="2">
                                                                        < 10% Luas
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_penurunan" name="pp_penurunan" value="3">
                                                                        10 - 30% Luas
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_penurunan" name="pp_penurunan" value="4">
                                                                        > 30% Luas
                                                                    </label>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-header bg-white header-elements-inline">
                                                            <h6 class="card-title">% Tambalan</h6>
                                                            <div class="header-elements">
                                                            
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_tambalan" name="pp_tambalan" checked="" value="1">
                                                                        Tidak ada
                                                                    </label>
                                                                </div>

                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_tambalan" name="pp_tambalan" value="2">
                                                                        < 10% Luas
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_tambalan" name="pp_tambalan" value="3">
                                                                        10 - 30% Luas
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_tambalan" name="pp_tambalan" value="4">
                                                                        > 30% Luas
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header bg-white header-elements-inline">
                                                            <h6 class="card-title">Erosi Permukaan</h6>
                                                            <div class="header-elements">
                                                            
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_erosi_permukaan" name="pp_erosi_permukaan" checked="" value="1">
                                                                        Baik / Tidak ada Kelainan
                                                                    </label>
                                                                </div>

                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_erosi_permukaan" name="pp_erosi_permukaan" value="2">
                                                                        Aspal Berlebihan
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_erosi_permukaan" name="pp_erosi_permukaan" value="3">
                                                                        Lepas - Lepas
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input pp_erosi_permukaan" name="pp_erosi_permukaan" value="4">
                                                                        Hancur
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Retak retak -->
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="bg-orange color-palette">
                                                <th colspan=3><h4 class="text-center">Retak - Retak</h4></th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Jenis
                                                                    </h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label class="font-weight-semibold"> Jenis</label>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="retak_jenis" checked="" value="1">
                                                                                Tidak ada
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="retak_jenis" value="2">
                                                                                tidak Berhubungan
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="retak_jenis" value="3">
                                                                                Saling berhubungan (Berbidang luas)
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="retak_jenis" value="4">
                                                                                Saling berhubungan (Berbidang sempit)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Lebar
                                                                    </h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label class="font-weight-semibold"> Lebar</label>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input retak_lebar" name="retak_lebar" checked="" value="1">
                                                                                Tidak ada
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input retak_lebar" name="retak_lebar" value="2">
                                                                                Halus < 1mm
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input retak_lebar" name="retak_lebar" value="3">
                                                                                Sedang 1 - 3 mm
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input retak_lebar" name="retak_lebar" value="4">
                                                                                Lebar > 3mm
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title"><i class="icon-cog3"></i> Luas</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input retak_luas" name="retak_luas" checked="" value="1">
                                                                                Tidak ada
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input retak_luas" name="retak_luas" value="2">
                                                                                < 10 % luas
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input retak_luas" name="retak_luas" value="3">
                                                                                10 - 30 % luas
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input retak_luas" name="retak_luas" value="4">
                                                                                > 30 % luas
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>              
                                                    </div>           
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--Kerikil Batu-->
                                    <table class="table table-bordered table-kb d-none">
                                        <tbody>
                                            <tr class="bg-orange color-palette">
                                                <th colspan=5><h4 class="text-center"> Kerikil dan Batu</h4></th>
                                            </tr>
                                            <tr>
                                                <td colspan=5>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Ukuran Terbanyak
                                                                    </h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_ukuranterbanyak" checked="" value="1">
                                                                                Tidak ada
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_ukuranterbanyak" value="2">
                                                                                < 1 cm
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_ukuranterbanyak" value="3">
                                                                                1 - 5 cm
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_ukuranterbanyak" value="4">
                                                                                >5 cm
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_ukuranterbanyak" value="5">
                                                                                Tidak tentu
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Tebal Lapisan
                                                                    </h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                    
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_teballapisan" checked="" value="1">
                                                                                Tidak ada
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_teballapisan" value="2">
                                                                                < 1 cm
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_teballapisan" value="3">
                                                                                5 - 10 cm
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_teballapisan" value="4">
                                                                                10 - 20 cm
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_teballapisan" value="5">
                                                                                > 20 cm
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Distribusi
                                                                    </h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">

                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_distribual" value="1">
                                                                                Tidak ada
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_distribual" value="2">
                                                                                Rata
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_distribual" value="3">
                                                                                Tidak Rata
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" class="form-check-input" name="kerikil_distribual" value="4">
                                                                                Gundukan Memanjang
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <!--Kerusakan Lain-->
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="bg-orange color-palette">
                                                <th colspan=5><h4 class="text-center"> Kerusakan Lain</h4></th>
                                            </tr>
                                            <tr>
                                                <td colspan=5>
                                                    <div class="row">
                                                        
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Gelombang
                                                                    </h6>
                                                                </div>
                                                                
                                                                <div class="card-body">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input kl_gelombang" name="kl_gelombang"  checked="" value="1">
                                                                            Tidak ada
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input kl_gelombang" name="kl_gelombang"  checked="" value="2">
                                                                            < 10%
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input kl_gelombang" name="kl_gelombang"  checked="" value="3">
                                                                            10-30%
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input kl_gelombang" name="kl_gelombang"  checked="" value="4">
                                                                            > 30%
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Jumlah Lubang
                                                                    </h6>
                                                                </div>
                                                                
                                                                <div class="card-body">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input kl_jml_lubang" name="kl_jml_lubang"  checked="" value="1">
                                                                            Tidak ada
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input kl_jml_lubang" name="kl_jml_lubang"  value="2">
                                                                            1 / 200 M
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input kl_jml_lubang" name="kl_jml_lubang"  value="3">
                                                                            2 - 5 /200 M
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input kl_jml_lubang" name="kl_jml_lubang"  value="4">
                                                                            > 500 /200 M
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Ukuran Lubang
                                                                    </h6>
                                                                </div>
                                                                
                                                                <div class="card-body">
                                                                    
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input" name="kl_ukuran_lubang" checked="" value="1">
                                                                            Tidak ada
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input" name="kl_ukuran_lubang" value="2">
                                                                            kecil dangkal
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input" name="kl_ukuran_lubang" value="3">
                                                                            kecil dalam
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input" name="kl_ukuran_lubang" value="4">
                                                                            besar dangkal
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input" name="kl_ukuran_lubang" value="5">
                                                                            besar dalam
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Bekas Roda
                                                                    </h6>
                                                                </div>
                                                                
                                                                <div class="card-body">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input kl_bekas_roda" name="kl_bekas_roda" checked="" value="1">
                                                                            Tidak ada
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input kl_bekas_roda" name="kl_bekas_roda" value="2">
                                                                            < 1 cm dalam
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input kl_bekas_roda" name="kl_bekas_roda" value="3">
                                                                            1 - 3 cm dalam
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input kl_bekas_roda" name="kl_bekas_roda" value="4">
                                                                            > 3 cm dalam
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="col-md-4">
                                                        <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Kerusakan Tepi
                                                                    </h6>
                                                                </div>
                                                                
                                                                <div class="card-body">
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kl_kt_kiri" name="kl_kt_kiri" checked="" value="1">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Tidak ada" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kl_kt_kanan"  name="kl_kt_kanan" value="1">
                                                                            </span>
                                                                        </span>
                                                                    </div>

                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kl_kt_kiri" name="kl_kt_kiri" value="2">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Ringan" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kl_kt_kanan" name="kl_kt_kanan" value="2">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kl_kt_kiri" name="kl_kt_kiri" value="3">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Berat" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kl_kt_kanan" name="kl_kt_kanan" value="3">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                    </div> 
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <!--KSS dan Lain-->
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="bg-orange color-palette">
                                                <th colspan=10><h4 class="text-center"> Kondisi Saluran Samping dan Lain lain</h4></th>
                                            </tr>
                                            
                                            <tr>
                                                <th colspan="10">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Kondisi Bahu
                                                                    </h6>
                                                                </div>
                                                                
                                                                <div class="card-body">
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_kondisibahu_kiri" name="kss_kondisibahu_kiri" value="1" checked>
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Tidak ada" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_kondisibahu_kanan"  name="kss_kondisibahu_kanan" value="1" checked>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_kondisibahu_kiri"  name="kss_kondisibahu_kiri" value="2">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Baik / Rata" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_kondisibahu_kanan" name="kss_kondisibahu_kanan" value="2">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_kondisibahu_kiri" name="kss_kondisibahu_kiri" value="3">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Bekas Erosi Ringan" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_kondisibahu_kanan" name="kss_kondisibahu_kanan" value="3">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_kondisibahu_kiri" name="kss_kondisibahu_kiri" value="4">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Bekas Erosi Berat" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_kondisibahu_kanan" name="kss_kondisibahu_kanan" value="4">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Permukaan Bahu
                                                                    </h6>
                                                                </div>
                                                                
                                                                <div class="card-body">
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_permukaanbahu_kiri"  name="kss_permukaanbahu_kiri" value="1" checked>
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="tidak ada" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_permukaanbahu_kanan" name="kss_permukaanbahu_kanan" value="1" checked>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_permukaanbahu_kiri" name="kss_permukaanbahu_kiri" value="2">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="bersih" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_permukaanbahu_kanan"  name="kss_permukaanbahu_kanan" value="2">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_permukaanbahu_kiri" name="kss_permukaanbahu_kiri" value="3">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="tersumbat" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_permukaanbahu_kanan" name="kss_permukaanbahu_kanan" value="3">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_permukaanbahu_kiri" name="kss_permukaanbahu_kiri" value="4">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Erosi" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_permukaanbahu_kanan" name="kss_permukaanbahu_kanan" value="4">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Kodisi Saluran Samping
                                                                    </h6>
                                                                </div>
                                                                
                                                                <div class="card-body">
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_kiri" name="kss_kiri" value="1">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="tidak ada" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_kanan" name="kss_kanan" value="1">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_kiri" name="kss_kiri" value="2">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="di atas permukaan jalan" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_kanan" name="kss_kanan" value="2">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_kiri" name="kss_kiri" value="3">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Rata Permukaan jalan" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_kanan" name="kss_kanan" value="3">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_kiri" name="kss_kiri" value="4">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="di bawah permukaan jalan" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_kanan" name="kss_kanan" value="4">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_kiri" name="kss_kiri" value="5">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="> 10 cm" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_kanan" name="kss_kanan" value="5">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Kerusakan Lereng
                                                                    </h6>
                                                                </div>
                                                                
                                                                <div class="card-body">
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_kerusakanlereng_kiri"  name="kss_kerusakanlereng_kiri" value="1">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="tidak ada" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_kerusakanlereng_kanan" name="kss_kerusakanlereng_kanan" value="1">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_kerusakanlereng_kiri" name="kss_kerusakanlereng_kiri" value="2">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Longsor / Runtuh" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_kerusakanlereng_kanan" name="kss_kerusakanlereng_kanan" value="2">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header bg-white">
                                                                    <h6 class="card-title">
                                                                        <i class="icon-cog3 mr-2"></i>
                                                                        Trotoar
                                                                    </h6>
                                                                </div>
                                                                
                                                                <div class="card-body">
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_trotoar_kiri" name="kss_trotoar_kiri" value="1">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="tidak ada" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_trotoar_kanan" name="kss_trotoar_kanan" value="1">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_trotoar_kiri" name="kss_trotoar_kiri" value="2">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="baik / aman" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_trotoar_kanan" name="kss_trotoar_kanan" value="2">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                            <input type="radio" class="kss_trotoar_kiri" name="kss_trotoar_kiri" value="3">
                                                                            </span>
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="Berbahaya" disabled>
                                                                        <span class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <input type="radio" class="kss_trotoar_kanan" name="kss_trotoar_kanan" value="3">
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </th>

                                            </tr>

                                        </tbody>
                                    </table>

                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="bg-orange color-palette">
                                                <th>Retak Luas</th>
                                                <th>Retak Lebar</th>
                                                <th>Jumlah Lubang</th>
                                                <th>Bekas Roda</th>
                                                <th>Nilai SDI</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="p_retakluas"></p>
                                                </td>
                                                <td>
                                                    <p class="p_retaklebar"></p>
                                                </td>
                                                <td>
                                                    <p class="p_jumlahlubang"></p>
                                                </td>
                                                <td>
                                                    <p class="p_bekasroda"></p>
                                                </td>
                                                <td>
                                                    <p class="p_nilaisdi"></p>
                                                    <input type="hidden" name="nilai_sdi" id="nilai_sdi" class="nilai_sdi form-control">
                                                </td>
                                                <!-- <td>
                                                    <p class="p_mantap"></p>
                                                </td>
                                                <td>
                                                    <p class="p_tdkmantap"></p>
                                                </td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- Summary data -->
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="bg-orange color-palette">
                                                <th>Baik</th>
                                                <th>Sedang</th>
                                                <th>Rusak Ringan</th>
                                                <th>Rusak Berat</th>
                                                <th>Mantap</th>
                                                <th>Tidak Mantap</th>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" name="k_baik" class="k_baik form-control numberonly" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="k_sedang" class="k_sedang form-control numberonly" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="k_rusakringan" class="k_rusakringan form-control numberonly" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="k_rusakberat" class="k_rusakberat form-control numberonly" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="k_mantap" class="k_mantap form-control numberonly" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="k_tdkmantap" class="k_tdkmantap form-control numberonly" readonly>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>

                                    
                                </form>
                                
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
                                <button type="button" id="tambahskj" class="btn bg-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('style-head')
@parent
<link rel="stylesheet" href="{{ url('/plugins/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{ url('components/bootstrapvalidator/dist/css/bootstrapValidator.css')}}">
@endsection

@section('script-end')
@parent
<script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/select2/dist/js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{ url('/plugins/bootbox/js/bootbox.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
<script type="text/javascript" src="{{ mix('js/all.js')}}"></script>
<script type="text/javascript" src="{{ url('js/calculatesdiiri.js')}}"></script>
<script type="text/javascript" src="{{ url('components/bootstrapvalidator/dist/js/bootstrapValidator.js')}}"></script>
<script src="{{ asset('assets/limitless/js/plugins/forms/validation/validate.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        let tipejalan = $('#tipe_jalan');
		//Date picker
        loadKecamatan(3271);
        $('button.btn-browseiri').on('click',function(){
            console.log($(this).closest('.input-group'));
            $(this).closest('.input-group').find('input#fileiri').trigger('click');
        })
        $('#fileiri').on('change',function(){
            let fileinput = $(this);
            let fileinput_url = fileinput.attr('data-url');
            let fileinput_path = fileinput.attr('data-path');
            let formData = new FormData($('*formId*')[0]);
            formData.append("_token", window.Laravel.csrfToken);
            formData.append("path", fileinput_path);
            var file = this.files[0];
                name = file.name;
                size = file.size;
                type = file.type;
                if(file.name.length < 1) {
                }else if(file.size > 209715200) {
                    alert("File Terlalu Besar, Maksimal 200 Mb");
                }else {
                    if(!!file.type.match(/.*/)){
                        formData.append("images", file);
                    }
                    $.ajax({
                        url: fileinput_url,
                        type: "POST",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        dataType:'json',
                        beforeSend: function(){
                            $("#loader-wrapper").show();
                            $('.btn-simpan').prop("disabled",true);
                        },
                        complete: function(){
                            $("#loader-wrapper").hide();
                            $('.btn-simpan').prop("disabled",false);
                        },
                        success: function(data){
                            $('#images_preview').attr('src',`${data.url_location}/${data.filename}`).attr('class','img img-thumbnail');
                            $('#images_sizes').html(data.sizes);
                            $('.txtfiledokumentasi').
                                css({"color": "peru", "border": "2px solid blue"}).val(data.filename);
                        },
                        error: errorHandler = function(e) {
                            alert("Something went wrong!");
                            console.log(e);
                        },
                    });
                }
        });

        tipejalan.on('change',function(){
            let t = $(this);
            if(t.val() =='tanah' || t.val() == 'kerikil'){
                $('.table-kb').removeClass('d-none');
            }else{
                $('.table-kb').addClass('d-none');
            }
        });

        

	});
</script>
<script type="text/javascript">
$(document).ready(function() {
    var _componentValidation = function() {
        if (!$().validate) {
            console.warn('Warning - validate.min.js is not loaded.');
            return;
        }

        // Initialize
        var validator = $('.form-validate-jquery').validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            success: function(label) {
                label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
            },

            // Different components require proper error label placement
            errorPlacement: function(error, element) {

                // Unstyled checkboxes, radios
                if (element.parents().hasClass('form-check')) {
                    error.appendTo( element.parents('.form-check').parent() );
                }

                // Input with icons and Select2
                else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }

                // Input group, styled file input
                else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }

                // Other elements
                else {
                    error.insertAfter(element);
                }
            },
            rules: {
                password: {
                    minlength: 5
                },
                repeat_password: {
                    equalTo: '#password'
                },
                email: {
                    email: true
                },
                repeat_email: {
                    equalTo: '#email'
                },
                minimum_characters: {
                    minlength: 10
                },
                maximum_characters: {
                    maxlength: 10
                },
                minimum_number: {
                    min: 10
                },
                maximum_number: {
                    max: 10
                },
                number_range: {
                    range: [10, 20]
                },
                url: {
                    url: true
                },
                date: {
                    date: true
                },
                date_iso: {
                    dateISO: true
                },
                numbers: {
                    number: true
                },
                digits: {
                    digits: true
                },
                creditcard: {
                    creditcard: true
                },
                basic_checkbox: {
                    minlength: 2
                },
                styled_checkbox: {
                    minlength: 2
                },
                switchery_group: {
                    minlength: 2
                },
                switch_group: {
                    minlength: 2
                }
            },
            messages: {
                custom: {
                    required: 'This is a custom error message'
                },
                basic_checkbox: {
                    minlength: 'Please select at least {0} checkboxes'
                },
                styled_checkbox: {
                    minlength: 'Please select at least {0} checkboxes'
                },
                switchery_group: {
                    minlength: 'Please select at least {0} switches'
                },
                switch_group: {
                    minlength: 'Please select at least {0} switches'
                },
                agree: 'Please accept our policy'
            }
        });

        // Reset form
        $('#reset').on('click', function() {
            validator.resetForm();
        });
    };
    _componentValidation();
});
</script>
@endsection

