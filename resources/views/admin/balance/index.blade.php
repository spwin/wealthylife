@extends('admin/frame')
@section('content-header')
    <h1>
        Balance
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Balance</li>
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
        <div class="col-xs-9">
            <div class="box">
                {!! Form::open([
                    'role' => 'form',
                    'url' => action('AdminController@addBalance'),
                    'files' => true,
                    'method' => 'POST'
                ]) !!}
                    <div class="box-body">
                        <div class="form-group {{ $errors->first('email', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('email', 'E-Mail Address') !!}
                            {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Enter email']) !!}
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('credits', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('credits', 'Credits amount') !!}
                            {!! Form::input('number','credits', old('credits'), ['class' => 'form-control']) !!}
                            <span class="help-block">{{ $errors->first('credits') }}</span>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Add balance</button>
                    </div>
                {!! Form::close() !!}
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop