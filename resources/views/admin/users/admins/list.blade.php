@extends('admin/frame')
@section('content-header')
    <h1>
        Manage users
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Users</li>
        <li class="active">Admins</li>
    </ol>
@stop
@section('content')
    <div class="row">
        @if (Session::has('flash_notification.message'))
            <div class="col-xs-12">
                <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_notification.message') }}
                </div>
            </div>
        @endif
        <div class="col-xs-12">
            <div class="form-group">
                <a href="{{ action('AdminController@createAdmin') }}" type="button" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Add admin</a>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($users as $user)
            <div class="col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-light-blue">
                        <div class="widget-user-image">
                            <img class="img-circle" src="{{ URL::to('/').$user->userData()->first()->image()->first()->path.$user->userData()->first()->image()->first()->filename }}" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{ $user->userData()->first()->first_name }} {{ $user->userData()->first()->last_name }}</h3>
                        <h5 class="widget-user-desc">{{ ucfirst($user->type) }}</h5>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li class="text-center"><div class="form-group mt-15px"><a href="{{ action('AdminController@detailsAdmin', $user->id) }}" class="btn btn-success btn-flat">View profile</a></div></li>
                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        @endforeach
    </div>
                <!-- /.row -->
@stop