<section id="header" role="header">
    <div class="appHeader">
            <div class="headerLogo">
                <img alt="logo" src="{{ url('/images/logo_icon.png')}}" height="54" />
            </div>
            <div class="headerTitle">
                <span id="headerTitleSpan">
                    Jaringan Jalan
                </span>
                <div id="subHeaderTitleSpan" class="subHeaderTitle">
                    
                </div>
            </div>
            <div class="search">
                <div id='geocodeDijit'>
                </div>
            </div>
            
            <div class="headerLinks">
                <div id="login">
                    @if(Auth::user())
                    <a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a> |
                    <a href="{{ route('gerbang.logout') }}"><i class="icon-user"></i> Logout</a>
                    @else
                    <a href="{{ route('gerbang.login') }}"><i class="icon-user"></i> Login</a>
                    @endif
                </div>
                <div id="helpDijit">
                </div> 
            </div>
    </div>
</section>