@extends('consultant/frame')
@section('content-header')
    <h1>
        Manage users
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('ConsultantController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
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
                    <h3 class="box-title">Users</h3>
                    {!! Form::open([
                        'role' => 'form',
                        'url' => action('ConsultantController@listUsers'),
                        'files' => true,
                        'method' => 'GET'
                    ]) !!}
                    {!! Form::text('search', $search, ['class' => 'form-control w200px inline']) !!}
                    <input type="submit" value="Search" class="btn btn-sm btn-default">
                    {!! Form::close() !!}
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover users-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Gender</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Questions</th>
                                <th>Balance</th>
                                <th>Auth</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr onclick="window.location.href = '{{ action('ConsultantController@detailsUser', ['id' => $user->id]) }}';">
                                {{-- action('AdminController@detailsConsultant', $user->id) --}}
                                <td><i class="fa fa-angle-right hov-icon"></i></td>
                                <td>#{{ $user->id }}</td>
                                <td><i class="fa fa-{{ $user->userData->gender == 'male' ? 'mars' : ($user->userData->gender == null ? 'genderless' : 'venus') }}"></i></td>
                                <td>{{ $user->userData->first_name }} {{ $user->userData->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->questions()->count() }}</td>
                                <td>£{{ $user->points }}</td>
                                <td>
                                    @if($user->local)<i class="fa fa-home"></i>@endif
                                    @if($user->social()->first())
                                        @if($user->social()->where(['provider' => 'facebook'])->count() > 0)<i class="fa fa-facebook"></i>@endif
                                        @if($user->social()->where(['provider' => 'google'])->count() > 0)<i class="fa fa-google"></i>@endif
                                        @if($user->social()->where(['provider' => 'twitter'])->count() > 0)<i class="fa fa-twitter"></i>@endif
                                    @endif
                                </td>
                                <td>{{ date('d M, Y',strtotime($user->created_at)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop