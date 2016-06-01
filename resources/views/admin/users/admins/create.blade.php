@extends('admin/frame')
@section('content-header')
    <h1>
        Create user
        <small>ADMIN</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Users</li>
        <li><a href="{{ action('AdminController@listAdmins') }}">Admins</a></li>
        <li class="active">Create</li>
    </ol>
    @stop
    @section('content')
            <!-- Small boxes (Stat box) -->
    {!! Form::open([
        'role' => 'form',
        'url' => action('AdminController@saveAdmin'),
        'files' => true,
        'method' => 'POST'
    ]) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Login details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->first('email', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('email', 'E-Mail Address') !!}
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email']) !!}
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('password', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('password', 'Password') !!}
                            {!! Form::input('password', 'password', '', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('password_confirmation', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('password_confirmation', 'Repeat Password') !!}
                            {!! Form::input('password', 'password_confirmation', '', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                            <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Create admin</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">User information</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group {{ $errors->first('first_name', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('first_name', 'First Name') !!}
                            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First name']) !!}
                            <span class="help-block">{{ $errors->first('first_name') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('last_name', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('last_name', 'Last name') !!}
                            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last name']) !!}
                            <span class="help-block">{{ $errors->first('last_name') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                            {!! Form::label('gender', 'Gender') !!}
                            <div class="input-group">
                                <label class="cursor-pointer mr-15px">
                                    {!! Form::radio('gender', 'male', null, ['class' => 'minimal']) !!}
                                    Male
                                </label>
                                <label class="cursor-pointer">
                                    {!! Form::radio('gender', 'female', null, ['class' => 'minimal']) !!}
                                    Female
                                </label>
                            </div>
                            <span class="help-block">{{ $errors->first('gender') }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('weight', 'Weight') !!}
                            <div class="input-group">
                                {!! Form::text('weight', null, ['class' => 'form-control', 'placeholder' => 'Weight']) !!}
                                <span class="input-group-addon">kg</span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('height', 'Height') !!}
                            <div class="input-group">
                                {!! Form::text('height', null, ['class' => 'form-control', 'placeholder' => 'Height']) !!}
                                <span class="input-group-addon">cm</span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('birth_date', 'Date of birth') !!}
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {!! Form::text('birth_date', null, ['class' => 'form-control pull-right', 'id' => 'datepicker']) !!}
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            {!! Form::label('about', 'About') !!}
                            {!! Form::textarea('about', null, ['class' => 'form-control', 'placeholder' => 'Enter ...', 'rows' => '3']) !!}
                        </div>
                        <div class="form-group {{ $errors->first('image', 'has-error') }}">
                            {!! Form::label('image', 'Photo') !!}
                            {!! Form::file('image') !!}
                            <span class="help-block">{{ $errors->first('image') }}</span>
                            <p class="help-block text-black">Max file size 1Mb, recommended dimension 160x160</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    <!-- /.row -->
@stop
@push('scripts')
<script>
    $(function() {
        //Date picker
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });

        $('input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    });
</script>
@endpush