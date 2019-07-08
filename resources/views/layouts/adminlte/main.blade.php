@extends('layouts.full.full')
@section('body-class','hold-transition skin-yellow sidebar-mini fixed')
@section('style-head')
<link rel="icon" href="{{ asset('favicon.ico')}}" type="image/icon">
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('/plugins/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('/plugins/Ionicons/css/ionicons.min.css')}}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap-daterangepicker/daterangepicker.css')}}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{ asset('/plugins/jquery-ui/css/jquery-ui.css')}}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('/plugins/iCheck/all.css')}}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{ asset('/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css')}}">

<link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/AdminLTE.min.css')}}">

<!--<link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/skins/_all-skins.min.css')}}">-->
<link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/skins/skin-yellow.css')}}">
<link rel="stylesheet" href="{{ asset('css/loader.css')}}">

<link rel="stylesheet" href="{{ asset('/plugins/nprogress/nprogress.css')}}">
<link rel="stylesheet" href="{{ asset('/plugins/lightbox/css/lightbox.min.css')}}" >
<link rel="stylesheet" href="{{ asset('/plugins/toastr/toastr.min.css')}}" >
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,600,700,300italic,400italic,600italic">

<link href="{{ asset('/plugins/dx/css/dx.common.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/dx/css/dx.greenmist.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/dx/css/dx.light.css')}}" rel="stylesheet" type="text/css"/>
<!-- Add fancyBox -->
<link rel="stylesheet" href="{{asset('/plugins/fancybox/source/jquery.fancybox.css?v=2.1.7')}}" type="text/css" media="screen" />

<!-- <link href="{{ asset('/plugins/dx/css/dx.spa.css')}}" rel="stylesheet" type="text/css"/> -->

@endsection
@section('content')
    @include('layouts.adminlte.header')
    @include('layouts.adminlte.sidebar-left')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @yield('title')
            </h1>
            <ol class="breadcrumb">
                @yield('breadcrumb')
            </ol>
        </section>

        <section class="content">
            @include('layouts.elements.alert')
            @yield('content-admin')
        </section>
    
    </div>
    @include('layouts.elements.modal')
    @include('layouts.elements.handlebar')
    @include('layouts.elements.loader')
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2018 <a href="{{url('/')}}"> Studio</a>.</strong> All rights
        reserved.
    </footer>
    @include('layouts.adminlte.sidebar-right')
    <div class="control-sidebar-bg"></div>
@endsection

@section('script-end')
@parent
<script src="{{ asset('/js/app.js') }}"></script>
<script type="text/javascript" src="{{asset('plugins/fancybox/lib/jquery.mousewheel.pack.js')}}"></script>
<script type="text/javascript" src="{{asset('/plugins/fancybox/source/jquery.fancybox.pack.js?v=2.1.7')}}"></script>
<script type="text/javascript" src="{{asset('/plugins/fancybox/lib/jquery-1.10.2.min.js')}}"></script>
<script type="text/javascript" src="{{ url('/plugins/jquery-ui/js/jquery-ui.js')}}"></script>
<script src="{{asset('/plugins/lightbox/js/lightbox.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="{{ asset('assets/adminlte/dist/js/demo.js')}}"></script>-->
<script src="{{ asset('plugins/ckeditor/ckeditor.js')}}"></script>
<!-- handlebar -->
<script src="{{ asset('plugins/handlebars/handlebars.min.js')}}"></script>
<!-- nprogress -->
<script src="{{ asset('/plugins/nprogress/nprogress.js')}}"></script>
<!-- toastr -->
<script src="{{ asset('/plugins/toastr/toastr.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('plugins/select2/dist/js/select2.full.min.js')}}"></script>

@endsection