<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(auth()->user()->isSuper() || auth()->user()->hasRole('admin'))
          <img src="{{ auth()->user()->fotoPath }}" class="img-circle" alt="User Image">
          @elseif(auth()->user()->hasRole('pencaker'))
          <img src="{{ auth()->user()->pencaker->fotoPath }}" class="img-circle" alt="User Image">
          @elseif(auth()->user()->hasRole('perusahaan'))
          <img src="{{ auth()->user()->perusahaan->fotoPath }}" class="img-circle" alt="User Image">
          @endif
        </div>
        <div class="pull-left info">
          <p>{{ auth()->user()->nama }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ (session('link_web') == 'dashboard')?'active':'' }}">
          <a href="{{ route('backend.dashboard.index') }}">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        
        
        @if(auth()->user()->isRole('superadmin'))
        <li class="treeview {{ (session('link_web') == 'pengaturan')?'active':'' }}">
          <a href="#">
            <i class="fa fa-gear"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('backend/setting/index')}}"><i class="fa fa-circle-o"></i> Setting</a></li>
            <li><a href="{{ route('backend.setting.profile')}}"><i class="fa fa-circle-o"></i> Profil</a></li>
            <li><a href="{{ route('backend.log.index')}}"><i class="fa fa-circle-o"></i> Log</a></li>
            <li><a href="{{ route('backend.pengaturan.users')}}"><i class="fa fa-circle-o"></i> User</a></li>
            <li><a href="{{ route('backend.setting.syncdata')}}"><i class="fa fa-circle-o"></i> Sinkronasi Data</a></li>
            
          </ul>
        </li>
        @endif
        
        
        <li class="header">LABELS</li>
        
        
      </ul>
    </section>
    
</aside>