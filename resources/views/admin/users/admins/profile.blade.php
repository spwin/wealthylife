@extends('admin/frame')
@section('content-header')
    <h1>
        User profile
        <small>ADMIN</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Users</li>
        <li><a href="{{ action('AdminController@listAdmins') }}">Admins</a></li>
        <li class="active">Profile</li>
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
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ URL::to('/').$user->userData()->first()->image()->first()->path.$user->userData()->first()->image()->first()->filename }}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ $user->userData()->first()->first_name }} {{ $user->userData()->first()->last_name }}</h3>

                    <p class="text-muted text-center">{{ ucfirst($user->type) }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>ID</b> <a class="pull-right">{{ $user->id }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Created</b> <a class="pull-right">{{ date('d/m/Y', strtotime($user->created_at)) }}</a>
                        </li>
                    </ul>
                    {!! Form::open([
                    'method' => 'DELETE',
                    'action' => ['AdminController@destroyAdmin', $user->id],
                    'onclick'=> 'return confirm("Are you sure?")'
                    ]) !!}
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete profile</button>
                    {!! Form::close() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li {{ $tab == '1' ? 'class=active' : '' }}><a href="#settings" data-toggle="tab">General</a></li>
                    <li {{ $tab == '2' ? 'class=active' : '' }}><a href="#password" data-toggle="tab">Login details</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane {{ $tab == '1' ? 'active' : '' }}" id="settings">
                        {!! Form::model($user_data, [
                            'role' => 'form',
                            'url' => action('AdminController@updateAdminData', ['id' => $user->id]),
                            'files' => true,
                            'method' => 'POST'
                        ]) !!}
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
                            <div class="form-group">
                                {!! Form::label('gender', 'Gender') !!}
                                <div class="input-group">
                                    <label class="cursor-pointer mr-15px">
                                        <input type="radio" name="gender" value="male" class="minimal" {{ $user_data->gender == 'male' ? 'checked' : '' }}>
                                        Male
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="gender" value="female" class="minimal" {{ $user_data->gender == 'female' ? 'checked' : '' }}>
                                        Female
                                    </label>
                                </div>
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
                                    {!! Form::text('birth_date', $user_data->birth_date ? date('d/m/Y', strtotime($user_data->birth_date)) : null, ['class' => 'form-control pull-right', 'id' => 'datepicker']) !!}
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group {{ $errors->first('image', 'has-error') }}">
                                {!! Form::label('image', 'Change Photo') !!}
                                {!! Form::file('image') !!}
                                <span class="help-block">{{ $errors->first('image') }}</span>
                                <p class="help-block text-black">Max file size 1Mb, recommended dimension 160x160</p>
                            </div>
                            <div class="form-group">
                                {!! Form::label('about', 'About') !!}
                                {!! Form::textarea('about', null, ['class' => 'form-control', 'placeholder' => 'Enter ...', 'rows' => '3']) !!}
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane {{ $tab == '2' ? 'active' : '' }}" id="password">
                        {!! Form::model($user, [
                            'role' => 'form',
                            'url' => action('AdminController@updateAdminLogin', ['id' => $user->id, 'type' => 'email']),
                            'method' => 'POST'
                        ]) !!}
                            <div class="form-group {{ $errors->first('email', 'has-error') }}"><span class="text-danger">*</span>
                                {!! Form::label('email', 'E-Mail Address') !!}
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email']) !!}
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Change email</button>
                        </div>
                        {!! Form::close() !!}
                        {!! Form::model($user, [
                            'role' => 'form',
                            'url' => action('AdminController@updateAdminLogin', ['id' => $user->id, 'type' => 'pass']),
                            'method' => 'POST'
                        ]) !!}
                            <div class="form-group {{ $errors->first('password', 'has-error') }}"><span class="text-danger">*</span>
                                {!! Form::label('password', 'New Password') !!}
                                {!! Form::input('password', 'password', '', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            </div>
                            <div class="form-group {{ $errors->first('password_confirmation', 'has-error') }}"><span class="text-danger">*</span>
                                {!! Form::label('password_confirmation', 'Repeat New Password') !!}
                                {!! Form::input('password', 'password_confirmation', '', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Change password</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
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