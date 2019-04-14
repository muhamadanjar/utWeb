<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('backend.dashboard.index')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img width="40px" src="{{ asset('images/logo_sukabumi.png') }}"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img width="40px" src="{{ asset('images/logo_sukabumi.png') }}"><b>SIMTEK</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!--<li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>-->
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label bg-maroon notifikasicount"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header header_notifikasi"></li>
              <li>
                
                <ul class="menu menu_notifikasi">
                  
                </ul>
              </li>
              <li class="footer"><a href="{{ route('backend.notifikasi') }}">Lihat Semua</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <!--<li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>-->
          <!-- User Account: style can be found in dropdown.less -->
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
          @if(auth()->check())
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ auth()->user()->fotoPath }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ auth()->user()->nama  }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ auth()->user()->fotoPath }}" class="img-circle" alt="User Image">
                <p>
                {{ auth()->user()->nama }} - @if(auth()->user()->isSuper()) SuperAdmin @elseif(auth()->user()->hasRole('pencaker')) Pencaker @elseif(auth()->user()->hasRole('perusahaan')) Perusahaan @else Administrator @endif
                  <small>Bergabung Sejak {{auth()->user()->created_at->format('d M Y') }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('backend.setting.profile')}}" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('gerbang.logout') }}" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          @endif
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
</header>