<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{
                            URL::to('/')
                            .Auth::guard('consultant')->user()->userData->image->path
                            .Auth::guard('consultant')->user()->userData->image->filename
                             }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::guard('consultant')->user()->userData->first_name.' '.Auth::guard('consultant')->user()->userData->last_name }}</p>
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
            <li class="{{ (Request::is('consultant') ? 'active' : '') }}">
                <a href="{{ action('ConsultantController@index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ (Request::is('consultant/users*') ? 'active' : '') }}">
                <a href="{{ action('ConsultantController@listUsers') }}">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="{{ (Request::is('consultant/questions*') ? 'active' : '') }} treeview">
                <a href="#">
                    <i class="fa fa-paper-plane-o"></i>
                    <span>Questions</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('consultant/questions/pending*') ? 'active' : '') }}"><a href="{{ action('ConsultantController@listPending') }}"><i class="fa fa-circle-o"></i> Pending</a></li>
                    <li class="{{ (Request::is('consultant/questions/answered*') ? 'active' : '') }}"><a href="{{ action('ConsultantController@listAnswered') }}"><i class="fa fa-circle-o"></i> Answered</a></li>
                    <li class="{{ (Request::is('consultant/questions/rejected*') ? 'active' : '') }}"><a href="{{ action('ConsultantController@listRejected') }}"><i class="fa fa-circle-o"></i> Rejected</a></li>
                </ul>
            </li>
            <li class="{{ (Request::is('consultant/timetable*') ? 'active' : '') }}">
                <a href="{{ action('ConsultantController@timetable') }}">
                    <i class="fa fa-coffee"></i>
                    <span>Timetable</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>