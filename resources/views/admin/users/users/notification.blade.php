@extends('admin/frame')
@section('content-header')
    <h1>
        Notification
        <small>details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('AdminController@listUsers') }}">Users</a></li>
        <li><a href="{{ action('AdminController@detailsUser', ['id' => $notification->user()->first()->id, 't' => 4]) }}">User</a></li>
        <li class="active">Notification</li>
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
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    {{ date('d M, Y H:i', strtotime($notification->created_at)) }}
                    <h3>{{ $notification->subject }}</h3>
                </div>
                <div class="box-body">{{ $notification->body }}</div>
                <div class="box-footer">
                    <p><strong>Notification details:</strong></p>
                    <ul>
                        <li>Type: <strong>{{ $notification->type }}</strong></li>
                        <li>Importance: <strong>{{ $notification->importance }}</strong></li>
                        <li>Email user: <strong>{{ $notification->email ? 'YES' : 'NO' }}</strong></li>
                        <li>User iD: <strong>{{ $notification->user_id }}</strong></li>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop