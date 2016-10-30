@extends('admin/frame')
@section('content-header')
    <h1>
        User profile
        <small>CONSULTANT</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Users</li>
        <li><a href="{{ action('AdminController@listConsultants') }}">Consultants</a></li>
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
                    'action' => ['AdminController@destroyConsultant', $user->id],
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
                    <li {{ $tab == '3' ? 'class=active' : '' }}><a href="#timetable" data-toggle="tab">Timetable</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane {{ $tab == '1' ? 'active' : '' }}" id="settings">
                        {!! Form::model($user_data, [
                            'role' => 'form',
                            'url' => action('AdminController@updateConsultantData', ['id' => $user->id]),
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
                            'url' => action('AdminController@updateConsultantLogin', ['id' => $user->id, 'type' => 'email']),
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
                            'url' => action('AdminController@updateConsultantLogin', ['id' => $user->id, 'type' => 'pass']),
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
                    <div class="tab-pane {{ $tab == '3' ? 'active' : '' }}" id="timetable">
                        {!! Form::open([
                            'role' => 'form',
                            'url' => action('AdminController@updateConsultantTimetable', ['id' => $user->id]),
                            'method' => 'POST',
                            'class' => 'timetable-form'
                        ]) !!}
                        @foreach(json_decode($user->timetable) as $day => $slots)
                            <div class="col-md-12">
                                <div class="box {{ $day }}">
                                    <div class="box-header">{{ $matcher[$day] }}</div>
                                    <div class="box-body">
                                        @php($counter = 0)
                                        @foreach($slots as $slot)
                                            <div class="time-slot">{{ $slot->from.' - '.$slot->to }}<input type="hidden" name="days[{{ $day }}][{{ $counter }}][from]" value="{{ $slot->from }}">
                                                <input type="hidden" name="days[{{ $day }}][{{ $counter }}][to]" value="{{ $slot->to }}">
                                                <span class="btn btn-timetable btn-danger remove-slot" onclick="removeSlot(event, this)">remove</span>
                                            </div>
                                            @php($counter++)
                                        @endforeach
                                    </div>
                                    <div class="box-footer">
                                        <input class="slot-from" type="text"> - <input class="slot-to" type="text">
                                        <button id="send" data-day="{{ $day }}" class="btn btn-timetable btn-success">Add</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="clearfix"></div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
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
    function removeSlot(e, button){
        e.preventDefault();
        $(button).parent().remove();
    }

    $(function() {
        var timetable = function(){
            var button;
            var from;
            var to;
            var container;
            var slotNumber = $('.time-slot').length;
            return {
                init: function(b,f,t,c){
                    button = b;
                    from = f;
                    to = t;
                    container = c;
                    timetable.bind();
                },
                addTime: function(day){
                    var slotFrom = $('.'+day+' '+from).val();
                    var slotTo = $('.'+day+' '+to).val();
                    var timeSlot = '<div class="time-slot">'+slotFrom+' - '+slotTo;
                    var inputFrom = '<input type="hidden" name="days['+day+']['+slotNumber+'][from]" value="'+slotFrom+'">';
                    var inputTo = '<input type="hidden" name="days['+day+']['+slotNumber+'][to]" value="'+slotTo+'">';
                    var removeButton = '<span class="btn btn-timetable btn-danger remove-slot" onclick="removeSlot(event, this);"">remove</span>';
                    timeSlot = timeSlot+inputFrom+inputTo+removeButton+'</div>';
                    $('.'+day+' '+container).append(timeSlot);
                    slotNumber++;
                },
                bind: function(){
                    $(button).on('click', function(e){
                        e.preventDefault();
                        timetable.addTime($(this).attr('data-day'));
                    });
                }
            }
        }();

        timetable.init('button#send', 'input.slot-from', 'input.slot-to', '.box-body');

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