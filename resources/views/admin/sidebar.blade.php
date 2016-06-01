<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{
                            URL::to('/')
                            .Auth::guard('admin')->user()->userData()->first()->image()->first()->path
                            .Auth::guard('admin')->user()->userData()->first()->image()->first()->filename
                             }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::guard('admin')->user()->userData()->first()->first_name.' '.Auth::guard('admin')->user()->userData()->first()->last_name }}</p>
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
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ (Request::is('admin') ? 'active' : '') }}">
                <a href="{{ action('AdminController@index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ (Request::is('admin/users*') ? 'active' : '') }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('admin/users/admins*') ? 'active' : '') }}"><a href="{{ action('AdminController@listAdmins') }}"><i class="fa fa-circle-o"></i> Admins</a></li>
                    <li class="{{ (Request::is('admin/users/consultants*') ? 'active' : '') }}"><a href="{{ action('AdminController@listConsultants') }}"><i class="fa fa-circle-o"></i> Consultants</a></li>
                    <li class="{{ (Request::is('admin/users/users*') ? 'active' : '') }}"><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Users</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>