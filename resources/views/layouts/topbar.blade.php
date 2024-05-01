<div class="navbar navbar-default" role="navigation">

    <div class="navbar-inner">
        {{-- <button type="button" class="navbar-toggle pull-left animated flip">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button> --}}
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <a class="brand" href=""> <img src="{{asset('/admin/img/logo-greyscale-512.png') }}" /> <span> Admin Panel</span></a>

        <!-- theme selector starts -->
        <div class="btn-group pull-right theme-container animated tada">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-tint"></i><span class="hidden-sm hidden-xs"> Change Theme / Skin</span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" id="themes">
                <li><a data-value="classic" href="{{ asset('/') }}#"><i class="whitespace"></i> Classic</a></li>
                <li><a data-value="cerulean" href="{{ asset('/') }}#"><i class="whitespace"></i> Cerulean</a></li>
                <li><a data-value="cyborg" href="{{ asset('/') }}#"><i class="whitespace"></i> Cyborg</a></li>
                <li><a data-value="simplex" href="{{ asset('/') }}#"><i class="whitespace"></i> Simplex</a></li>
                <li><a data-value="darkly" href="{{ asset('/') }}#"><i class="whitespace"></i> Darkly</a></li>
                <li><a data-value="lumen" href="{{ asset('/') }}#"><i class="whitespace"></i> Lumen</a></li>
                <li><a data-value="slate" href="{{ asset('/') }}#"><i class="whitespace"></i> Slate</a></li>
                <li><a data-value="spacelab" href="{{ asset('/') }}#"><i class="whitespace"></i> Spacelab</a></li>
                <li><a data-value="united" href="{{ asset('/') }}#"><i class="whitespace"></i> United</a></li>
            </ul>
        </div>
        <!-- theme selector ends -->
        <!-- user dropdown starts -->
        <div class="btn-group pull-right">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> admin</span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="">Profile</a></li>
                <li class="divider"></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <i class="icon icon-color icon-arrow-w"></i>
                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        <!-- user dropdown ends -->

        

    </div>
</div>
<!-- topbar ends -->