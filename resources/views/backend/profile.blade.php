@extends('templates::adminlte.main')
@section('content-admin')
<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/no-user.jpg')}}"
                    alt="User profile picture">

                <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>


                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Total Booking</b> <a class="pull-right">1,322</a>
                    </li>
                    
                </ul>

                <a href="{{ route('dev.me.profile')}}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> Personal Information</strong>

                <p class="text-muted">
                    {{ auth()->user()->name }}<br>
                    {{ auth()->user()->email }}<br>
                    {{ auth()->user()->no_telp }}<br>
                    {{ auth()->user()->alamat }}<br>
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Document</strong>

                <p class="text-muted">
                    License Number:
                    Expire Date:
                    Employee ID:373 
                </p>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    <h4>My Bookings</h4>
                    <div class="table-responsive">
                    <table class="table driver_table">
                        <thead class="thead-inverse">
                        <tr>
                            <th>Customer</th>
                            <th>Vehicle</th>
                            <th>Pickup Date & Time</th>
                            <th>Dropoff Date & Time</th>
                            <th>Pickup Address</th>
                            <th>Drop-off Address</th>
                            <th>Passengers</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection