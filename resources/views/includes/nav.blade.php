<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            {{--<a class="brand" href="index.html">Bootstrap Admin Template </a>--}}
            <div style="float: left;">
                <img src="/images/gcos-logo.jpeg" title="SMARTCCTVALARM" style="width:100px; height:100px">
            </div>
            <div style="float:left; margin-left: 25px; margin-top: 15px">
                <a class="brand" href="">
                    <h1>SMARTCCTVALARM</h1>
                    <h6 style="color: #ffffff">Your choice of security</h6>
                </a>
            </div>
            <div class="nav-collapse">
                <br><br><br>
                <ul class="nav pull-right">
                    <li class="dropdown">
                        @if(\App\Models\User::check())
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> Account <b class="caret"></b>
                        </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:;">My Orders</a></li>
                                <li><a href="javascript:;">My Bookings</a></li>
                                <li><a href="javascript:;">Edit Account</a></li>
                            </ul>
                        @else
                            <a href="{{action('UserController@getLogin')}}"> <i class="icon-signin"></i> Register/Sign in</a>
                        @endif
                    </li>
                    @if(\App\Models\User::check())
                    <li>
                        <a href="{{action('UserController@anyLogout')}}"> <i class="icon-signout"></i> Logout</a>
                    </li>
                    @endif
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!-- /container -->
    </div>
    <!-- /navbar-inner -->
</div>
<!-- /navbar -->
<div class="subnavbar">
    <div class="subnavbar-inner">
        <div class="container">
            <ul class="mainnav">
                <li class=""><a href="{{action('HomeController@anyIndex')}}"><i class="icon-home"></i><span>Home</span> </a> </li>

                @if($super_admin)
                    <li class=""><a href="{{action('DashboardController@anyDashboard')}}"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
                @endif

                <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-shopping-cart"></i><span>Shop</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">

                        @if($super_admin)
                            <li><a href="{{action('ProductController@anyManageShop')}}">Manage Store</a></li>
                        @endif

                        <li><a href="{{action('ProductController@anyProduct', 'analog_cctv')}}">Analog CCTV</a></li>
                        <li><a href="{{action('ProductController@anyProduct', 'digital_cctv')}}">Digital CCTV</a></li>
                        <li><a href="{{action('ProductController@anyProduct', 'ip_camera')}}">IP Camera</a></li>
                        <li><a href="{{action('ProductController@anyProduct', 'alarm')}}">Alarm</a></li>
                        <li><a href="{{action('ProductController@anyProduct', 'combo')}}">Combo</a></li>
                    </ul>
                </li>

                @if($super_admin)
                    <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-tasks"></i><span>Book a Service</span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{action('BookingController@anyManageBookings')}}">Manage Bookings</a></li>
                            <li><a href="{{action('BookingController@anyBooking')}}">Book a Service</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{action('BookingController@anyBooking')}}"><i class="icon-tasks"></i><span>Book a Service</span> </a> </li>
                @endif

                @if($super_admin)
                    <li><a href=""><i class="icon-list-alt"></i><span>Reports</span> </a> </li>
                @endif
                <li><a href=""><i class="icon-group"></i><span>About</span> </a> </li>
                <li><a href=""><i class="icon-phone"></i><span>Contact Us</span> </a> </li>
            </ul>
        </div>
        <!-- /container -->
    </div>
    <!-- /subnavbar-inner -->
</div>
<!-- /subnavbar -->