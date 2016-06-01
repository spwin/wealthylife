<header class="main-header">
    <!-- Logo -->
    <a href="{{ action('AdminController@index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>F</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>FIT</b>sensei</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 0 new messages</li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 0 new notifications</li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 0 new tasks</li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{
                            URL::to('/')
                            .Auth::guard('admin')->user()->userData()->first()->image()->first()->path
                            .Auth::guard('admin')->user()->userData()->first()->image()->first()->filename
                             }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">
                            {{ Auth::guard('admin')->user()->userData()->first()->first_name.' '.Auth::guard('admin')->user()->userData()->first()->last_name }}
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{
                            URL::to('/')
                            .Auth::guard('admin')->user()->userData()->first()->image()->first()->path
                            .Auth::guard('admin')->user()->userData()->first()->image()->first()->filename
                             }}" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::guard('admin')->user()->userData()->first()->first_name.' '.Auth::guard('admin')->user()->userData()->first()->last_name }} - Admin
                                <small>Member since {{ date('d/m/Y', strtotime(Auth::guard('admin')->user()->created_at)) }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ Auth::guard('admin')->user()->type == 'admin' ?
                                        action('AdminController@detailsAdmin', Auth::guard('admin')->user()->id) :
                                        action('AdminController@detailsConsultant', Auth::guard('admin')->user()->id) }}"
                                   class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ action('Auth\AuthController@getAdminLogout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>