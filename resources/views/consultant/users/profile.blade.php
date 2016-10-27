@extends('consultant/frame')
@section('content-header')
    <h1>
        User profile
        <small>USER</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('ConsultantController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('ConsultantController@listUsers') }}">Users</a></li>
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
                    <img class="profile-user-img img-responsive img-circle" src="{{ $user->userData()->first()->image()->first() ? URL::to('/').$user->userData()->first()->image()->first()->path.$user->userData()->first()->image()->first()->filename : URL::to('/').'/images/avatars/no_image.png'}}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ $user->userData()->first()->first_name }} {{ $user->userData()->first()->last_name }}</h3>

                    <p class="text-muted text-center">{{ $user->email }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>ID</b> <span class="pull-right">#{{ $user->id }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Balance</b> <span class="pull-right">£ {{ $user->points }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Created</b> <span class="pull-right">{{ date('d/m/Y', strtotime($user->created_at)) }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Confirmed</b> <span class="badge bg-{{ $econf['color'] }} pull-right">{{ $econf['status'] }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b> <span class="badge bg-{{ $user->status == 1 ? 'green' : 'red' }} pull-right">{{ $user->status == 1 ? 'active' : 'dormant' }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Asked</b> <span class="badge bg-light-blue pull-right">{{ $user->questions() && $user->questions()->first() ? $user->questions()->where('status', '>', 0)->count() : 0 }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Articles</b> <span class="badge bg-light-blue pull-right">{{ $user->articles() && $user->articles()->first() ? $user->articles()->where('status', '>', 0)->count() : 0 }}</span>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#general" data-toggle="tab">General</a></li>
                    <li><a href="#social" data-toggle="tab">Social</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="general">
                        {!! Form::model($user_data, [
                            'role' => 'form',
                            'url' => action('AdminController@updateUserData', ['id' => $user->id]),
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
                                    {!! Form::text('birth_date', $user_data->birth_date && $user_data->birth_date != '0000-00-00' ? date('d/m/Y', strtotime($user_data->birth_date)) : '00/00/0000', ['class' => 'form-control pull-right', 'id' => 'datepicker']) !!}
                                </div>
                                <!-- /.input group -->
                            </div>
                            {{--<div class="form-group {{ $errors->first('image', 'has-error') }}">
                                {!! Form::label('image', 'Change Photo') !!}
                                {!! Form::file('image') !!}
                                <span class="help-block">{{ $errors->first('image') }}</span>
                                <p class="help-block text-black">Max file size 5Mb</p>
                            </div>--}}
                            <div class="form-group">
                                {!! Form::label('about', 'About') !!}
                                {!! Form::textarea('about', null, ['class' => 'form-control', 'placeholder' => 'Enter ...', 'rows' => '3']) !!}
                            </div>
                            {{--<div class="box-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>--}}
                        {!! Form::close() !!}
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="social">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Provider</th>
                                <th>User ID</th>
                                <th>Social profile</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i class="fa fa-facebook"></i> Facebook</td>
                                <td>{{ $user->social()->first() && $user->social()->where(['provider' => 'facebook'])->count() > 0  ? $user->social()->where(['provider' => 'facebook'])->first()->social_id : 'none'}}</td>
                                <td>
                                    @if($user->social()->first() && $user->social()->where(['provider' => 'facebook'])->count() > 0)
                                        <a href="https://www.facebook.com/{{ $user->social()->where(['provider' => 'facebook'])->first()->social_id }}" target="_blank" class="btn btn-success">See profile</a>
                                    @else
                                        <a href="#" class="btn btn-success disabled">See profile</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-google"></i> Google</td>
                                <td>{{ $user->social()->first() && $user->social()->where(['provider' => 'google'])->count() > 0  ? $user->social()->where(['provider' => 'google'])->first()->social_id : 'none'}}</td>
                                <td>
                                    @if($user->social()->first() && $user->social()->where(['provider' => 'google'])->count() > 0)
                                        <a href="https://plus.google.com/{{ $user->social()->where(['provider' => 'google'])->first()->social_id }}" target="_blank" class="btn btn-success">See profile</a>
                                    @else
                                        <a href="#" class="btn btn-success disabled">See profile</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-twitter"></i> Twitter</td>
                                <td>{{ $user->social()->first() && $user->social()->where(['provider' => 'twitter'])->count() > 0  ? $user->social()->where(['provider' => 'twitter'])->first()->social_id : 'none'}}</td>
                                <td>
                                    @if($user->social()->first() && $user->social()->where(['provider' => 'twitter'])->count() > 0)
                                        <a href="https://twitter.com/intent/user?user_id={{ $user->social()->where(['provider' => 'twitter'])->first()->social_id }}" target="_blank" class="btn btn-success">See profile</a>
                                    @else
                                        <a href="#" class="btn btn-success disabled">See profile</a>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>

    <div id="questions-section" class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Questions</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#questions_1" data-toggle="tab" aria-expanded="true">
                                    Pending
                                    @if($user->questions() && $user->questions()->where(['status' => 1])->count() > 0)
                                        (<span class="numbers">{{ $user->questions()->where(['status' => 1])->count() }}</span>)
                                    @endif
                                </a>
                            </li>
                            <li class="">
                                <a href="#questions_2" data-toggle="tab" aria-expanded="false">
                                    Answered
                                    @if($user->questions() && $user->questions()->where(['status' => 2])->count() > 0)
                                        (<span class="numbers">{{ $user->questions()->where(['status' => 2])->count() }}</span>)
                                    @endif
                                </a>
                            </li>
                            <li class="">
                                <a href="#questions_3" data-toggle="tab" aria-expanded="false">
                                    Drafts
                                    @if($user->questions() && $user->questions()->where(['status' => 0])->count() > 0)
                                        (<span class="numbers">{{ $user->questions()->where(['status' => 0])->count() }}</span>)
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="questions_1">
                                <table id="pending-questions" class="table table-bordered table-hover scripted-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Question</th>
                                            <th class="w60px">Date</th>
                                            <th class="w100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($user->questions() && $user->questions()->where(['status' => 1])->count() > 0)
                                        @foreach($user->questions()->where(['status' => 1])->get() as $question)
                                            <tr>
                                                <td class="w40px">#{{ $question->id }}</td>
                                                <td class="w300px">
                                                    @if(count($question->images) > 0)
                                                        @foreach($question->images as $image)
                                                            <img class="admin-user-questions" src="{{ url()->to('/').$image->path.$image->filename }}">
                                                        @endforeach
                                                    @else
                                                        <img class="admin-user-questions" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                                    @endif
                                                </td>
                                                <td>{{ $question->question }}</td>
                                                <td>{{ date('d M, Y', strtotime($question->updated_at)) }}</td>
                                                <td class="w100px"><a href="{{ action('ConsultantController@answerQuestion', ['id' => $question->id]) }}" class="btn btn-primary">Answer</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="questions_2">
                                <table id="answered-questions" class="table table-bordered table-hover scripted-table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Question</th>
                                        <th class="w60px">Date</th>
                                        <th class="w100px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($user->questions() && $user->questions()->where(['status' => 2])->count() > 0)
                                        @foreach($user->questions()->where(['status' => 2])->get() as $question)
                                            <tr>
                                                <td class="w40px">#{{ $question->id }}</td>
                                                <td class="w300px">
                                                    @if(count($question->images) > 0)
                                                        @foreach($question->images as $image)
                                                            <img class="admin-user-questions" src="{{ url()->to('/').$image->path.$image->filename }}">
                                                        @endforeach
                                                    @else
                                                        <img class="admin-user-questions" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                                    @endif
                                                </td>
                                                <td>{{ $question->question }}</td>
                                                <td>{{ date('d M, Y', strtotime($question->updated_at)) }}</td>
                                                <td class="w100px"><a href="{{ action('ConsultantController@answerPreview', $question->answer()->first() ? $question->answer()->first()->id : '') }}" class="btn btn-success">View answer</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="questions_3">
                                <table id="questions-drafts" class="table table-bordered table-hover scripted-table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Question</th>
                                        <th class="w60px">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($user->questions() && $user->questions()->where(['status' => 0])->count() > 0)
                                        @foreach($user->questions()->where(['status' => 0])->get() as $question)
                                            <tr>
                                                <td class="w40px">#{{ $question->id }}</td>
                                                <td class="w300px">
                                                    @if(count($question->images) > 0)
                                                        @foreach($question->images as $image)
                                                            <img class="admin-user-questions" src="{{ url()->to('/').$image->path.$image->filename }}">
                                                        @endforeach
                                                    @else
                                                        <img class="admin-user-questions" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                                    @endif
                                                </td>
                                                <td>{{ $question->question }}</td>
                                                <td>{{ date('d M, Y', strtotime($question->updated_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop
@push('scripts')
<script src="{{ URL::to('/') }}/js/admin/jquery.dataTables.min.js"></script>
<script src="{{ URL::to('/') }}/js/admin/dataTables.bootstrap.min.js"></script>
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

        $('.scripted-table').each(function(){
            $(this).DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    });
</script>
@endpush