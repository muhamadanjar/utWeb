<style>
	html, body, #map_canvas {
	    width: 100%;
	    height: 92%;
	    margin: 0;
	    padding: 0;
	}
	#map_canvas {
	    position: relative;
	}
</style>
@extends('layouts.full.full')
@section('body-class','hold-transition layout-top-nav skin-yellow sidebar-mini fixed')
@section('content')
    <header class="main-header">
        <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="{{ route('backend.dashboard.index')}}" class="navbar-brand"><img width="30px" src="{{ asset('images/logo.png') }}"></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('backend.dashboard.index')}}">Beranda</a></li>
                    
                </ul>
            
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    
                    <!-- /.messages-menu -->

                    <!-- Notifications Menu -->
                    
                    <!-- Tasks Menu -->
                    <li>
                        <a id="reload" href="#" title="Refresh">
                            <b><i class="fa fa-refresh"></i></b>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="control-sidebar">
                        <div id="clock" class="rt-clock">
                            <b><span class="hours"></span>:<span class="minutes"></span>:<span class="seconds"></span></b>
                        </div>
                        </a>
                    </li>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{auth()->user()->fotoPath}}" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{auth()->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                        <img src="{{auth()->user()->fotoPath}}" class="img-circle" alt="User Image">

                        <p>
                            {{auth()->user()->name}}
                            <small></small>
                        </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                        <div class="pull-left">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                        </li>
                    </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
        </nav>
    </header>
    <div class="content-wrapper">
        
        @include('layouts.elements.alert')
            <div id="map_canvas"></div>
            <div id="main_menu"></div>
            <div id="layer_adm" title="Layer Administrasi"></div>
            <div id="layer_jalan" title="Layer Jalan">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="checkbox jln" id="kondisi_jlan" name="kondisi_jlan" value="kondisi_jlan">
                              Kondisi Jalan
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="checkbox jln" id="jln_kota" name="jln_kota" value="jln_kota">
                              Jalan Kota
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="checkbox jln" id="jln_kab" name="jln_kab" value="jln_kab">
                              Jalan Nasional
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="checkbox jln" id="jln_prov" name="jln_prov" value="jln_prov">
                              Jalan Provinsi
                        </label>
                    </div>
                </div>
            </div>
            <div id="sigi_tools" style="position: absolute; bottom: 0px;visibility: hidden;">
                <div id="layerContainer" style="position: relative; left: 80px; bottom: 1px; z-index: 100; visibility: visible;">
                    <a href="#" id="dialog_link_adm" class="ui-state-default ui-corner-all"><span style="font-weight: bold;">Daftar Administrasi&nbsp;</span></a> 
                    <a href="#" id="dialog_link_jln" class="ui-state-default ui-corner-all"><span style="font-weight: bold;">Daftar Jalan&nbsp;</span></a> 
                </div>
            </div>
    </div>
    @include('layouts.elements.modal')
    @include('layouts.handlebar')
    @include('layouts.elements.loader')

@endsection
@section('style-head')
@parent
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('/plugins/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('/plugins/Ionicons/css/ionicons.min.css')}}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap-daterangepicker/daterangepicker.css')}}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

<link rel="stylesheet" href="{{ url('components/jquery-ui/themes/base/all.css')}}" type="text/css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('/plugins/iCheck/all.css')}}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{ asset('/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css')}}">

<link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/AdminLTE.min.css')}}">

<link rel="stylesheet" href="{{ asset('/plugins/nprogress/nprogress.css')}}">

<link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/skins/skin-yellow.css')}}">
<link rel="stylesheet" href="{{ asset('css/loader.css')}}">
<link href="{{ asset('/plugins/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

@endsection
@section('script-end')
    @parent
    <script src="{{ url('js/app.js') }}"></script>
    <!-- nprogress -->
    <script src="{{ asset('/plugins/nprogress/nprogress.js')}}"></script>
    <script src="{{ asset('/plugins/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{ asset('plugins/handlebars/handlebars.min.js')}}"></script>
    <!-- <script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script> -->

    <script type="text/javascript" src="{{ url('/components/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/rm.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/g.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-kEXeuhgPWY__PZ9mzePYwJuMwOzLyC0&callback=initialize&libraries=places&libraries=geometry" async defer></script>
    <!-- <script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false&key=AIzaSyC-kEXeuhgPWY__PZ9mzePYwJuMwOzLyC0&callback=initialize">
    </script> -->

@endsection