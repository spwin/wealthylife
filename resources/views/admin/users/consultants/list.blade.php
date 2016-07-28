@extends('admin/frame')
@section('content-header')
    <h1>
        Manage users
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Users</li>
        <li class="active">Consultants</li>
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
                <a href="{{ action('AdminController@createConsultant') }}" type="button" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Add consultant</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Consultants</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Pending</th>
                                <th>Answered</th>
                                <th>Response time</th>
                                <th>To pay</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr onclick="window.location.href = '{{ action('AdminController@detailsConsultant', ['id' => $user->id]) }}';">
                                <td>{{ $user->id }}</td>
                                <td><i class="fa fa-circle text-success"></i> Online</td>
                                <td>
                                    <a href="{{ action('AdminController@detailsConsultant', $user->id) }}">
                                        {{ $user->userData()->first()->first_name }} {{ $user->userData()->first()->last_name }}
                                    </a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->questions()->where(['status' => 1])->count() }}</td>
                                <td>{{ $user->answers()->where(['payroll_id' => $current->id])->count() }}</td>
                                <td>30 min</td>
                                <td>{{ $total += ($price->value * $user->answers()->where(['payroll_id' => $current->id])->count()) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="7" class="text-right">
                                TOTAL:
                            </td>
                            <td colspan="1">£ {{ $total }}</td>
                        </tr>
                        </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop