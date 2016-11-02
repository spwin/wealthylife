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
            <li class="{{ (Request::is('admin/answers*') ? 'active' : '') }}">
                <a href="{{ action('AdminController@answers') }}">
                    <i class="fa fa-suitcase"></i>
                    <span>Answers</span>
                </a>
            </li>
            <li class="{{ (Request::is('admin/rejections*') ? 'active' : '') }}">
                <a href="{{ action('AdminController@rejections') }}">
                    <i class="fa fa-ban"></i>
                    <span>Rejections </span>
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
                    <li class="{{ (Request::is('admin/users/users*') ? 'active' : '') }}"><a href="{{ action('AdminController@listUsers') }}"><i class="fa fa-circle-o"></i> Users</a></li>
                </ul>
            </li>
            <li class="{{ (Request::is('admin/timetable*') ? 'active' : '') }}">
                <a href="{{ action('AdminController@timetable') }}">
                    <i class="fa fa-coffee"></i>
                    <span>Timetable</span>
                </a>
            </li>
            <li class="{{ (Request::is('admin/articles*') ? 'active' : '') }} treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Articles</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('admin/articles/pending*') ? 'active' : '') }}"><a href="{{ action('AdminController@articles', ['type' => 'pending']) }}"><i class="fa fa-circle-o"></i> Pending</a></li>
                    <li class="{{ (Request::is('admin/articles/edited*') ? 'active' : '') }}"><a href="{{ action('AdminController@articles', ['type' => 'edited']) }}"><i class="fa fa-circle-o"></i> Edited</a></li>
                    <li class="{{ (Request::is('admin/articles/published*') ? 'active' : '') }}"><a href="{{ action('AdminController@articles', ['type' => 'published']) }}"><i class="fa fa-circle-o"></i> Published</a></li>
                    <li class="{{ (Request::is('admin/articles/archived*') ? 'active' : '') }}"><a href="{{ action('AdminController@articles', ['type' => 'archived']) }}"><i class="fa fa-circle-o"></i> Archived</a></li>
                </ul>
            </li>
            <li class="{{ (Request::is('admin/balance*') ? 'active' : '') }}">
                <a href="{{ action('AdminController@balance') }}">
                    <i class="fa fa-balance-scale"></i>
                    <span>Balance</span>
                </a>
            </li>
            <li class="{{ (Request::is('admin/payroll*') ? 'active' : '') }}">
                <a href="{{ action('AdminController@payroll') }}">
                    <i class="fa fa-money"></i>
                    <span>Payroll</span>
                </a>
            </li>
            <li class="{{ (Request::is('admin/phrases*') ? 'active' : '') }}">
                <a href="{{ action('AdminController@phrases') }}">
                    <i class="fa fa-graduation-cap"></i>
                    <span>Phrases</span>
                </a>
            </li>
            <li class="{{ (Request::is('admin/vouchers*') ? 'active' : '') }}">
                <a href="{{ action('AdminController@vouchers') }}">
                    <i class="fa fa-gift"></i>
                    <span>Vouchers</span>
                </a>
            </li>
            <li class="{{ (Request::is('admin/discounts*') ? 'active' : '') }}">
                <a href="{{ action('AdminController@discounts') }}">
                    <i class="fa fa-percent"></i>
                    <span>Discounts</span>
                </a>
            </li>
            <li class="{{ (Request::is('admin/orders*') ? 'active' : '') }}">
                <a href="{{ action('AdminController@orders') }}">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li class="{{ (Request::is('admin/prices*') ? 'active' : '') }}">
                <a href="{{ action('AdminController@prices') }}">
                    <i class="fa fa-gbp"></i>
                    <span>Prices</span>
                </a>
            </li>
            <li class="{{ (Request::is('admin/ratings*') ? 'active' : '') }}">
                <a href="{{ action('AdminController@ratings') }}">
                    <i class="fa fa-star"></i>
                    <span>Ratings</span>
                </a>
            </li>
            <li class="{{ (Request::is('admin/feedback*') ? 'active' : '') }} treeview">
                <a href="#">
                    <i class="fa fa-bullhorn"></i>
                    <span>Feedback</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('admin/feedback/unseen*') ? 'active' : '') }}"><a href="{{ action('AdminController@feedback', ['type' => 'unseen']) }}"><i class="fa fa-circle-o"></i> Unseen</a></li>
                    <li class="{{ (Request::is('admin/feedback/all*') ? 'active' : '') }}"><a href="{{ action('AdminController@feedback', ['type' => 'all']) }}"><i class="fa fa-circle-o"></i> All</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>