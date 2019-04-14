@extends('layouts.full.full')
@section('head_title')
  - Map
@endsection

@section('content')
<section id="header" role="header">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="{{ url('/images/kotabogor.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
      <span class="appName">{{ config('app.name') }}</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
      </form> -->
      <ul class="nav justify-content-end">
        @if(Auth::user())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ auth()->user()->name}}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a href="{{ route('backend.dashboard.index') }}" class="dropdown-item"><i class="fa fa-dashboard"></i> Dashboard</a>
            <a href="{{ route('gerbang.logout') }}" class="dropdown-item"><i class="fa fa-sign-out"></i> Logout</a>

          </div>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('gerbang.login') }}">Login</a>
        </li>
        @endif
      </ul>

    </div>
  </nav>
</section>
<section id="main" role="main">
  <div id="app">
  </div>
</section>
@include('layouts.elements.modal')
@endsection
@section('style-head')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <!-- Application stylesheet : mandatory -->
     <!--<link rel="stylesheet" href="{{ url('css/app.css')}}"> -->
     <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css" type="text/css">
     <style>
      .ol-popup {
        position: absolute;
        background-color: white;
        -webkit-filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
        filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #cccccc;
        bottom: 12px;
        left: -50px;
        min-width: 280px;
      }
      .ol-popup:after, .ol-popup:before {
        top: 100%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
      }
      .ol-popup:after {
        border-top-color: white;
        border-width: 10px;
        left: 48px;
        margin-left: -10px;
      }
      .ol-popup:before {
        border-top-color: #cccccc;
        border-width: 11px;
        left: 48px;
        margin-left: -11px;
      }
      .ol-popup-closer {
        text-decoration: none;
        position: absolute;
        top: 5px;
        right: 5px;
      }
    </style>
     <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ asset('css/ol-contextmenu.min.css') }}">
    <link rel="stylesheet" href="main_op.css">
    <link rel="stylesheet" href="{{ asset('css/jspanel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/ol-geocoder.min.css')}}">
@endsection
@section('script-head')
    @parent
@endsection
@section('script-body')
@endsection
@section('script-end')
@parent
<script src="{{ asset('js/app.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script src="{{ url('js/app.js')}}"></script> -->

<!-- Plugins and page level script : optional -->


@endsection
