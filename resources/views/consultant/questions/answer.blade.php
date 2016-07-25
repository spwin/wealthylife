@extends('consultant/frame')
@section('content-header')
    <h1>
        Question
        <small>answer</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('ConsultantController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('ConsultantController@listPending') }}">Pending</a></li>
        <li class="active">Answer</li>
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
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ $user->userData()->first()->image()->first() ? URL::to('/').$user->userData()->first()->image()->first()->path.$user->userData()->first()->image()->first()->filename : URL::to('/').'/images/avatars/no_image.png'}}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ $user->userData()->first()->first_name }} {{ $user->userData()->first()->last_name }}</h3>

                    <p class="text-muted text-center">{{ $user->email }}</p>

                    <div class="text-center">
                        <a class="btn btn-default" href="{{ action('ConsultantController@detailsUser', ['id' => $user->id]) }}"><i class="fa fa-user"></i> View profile</a>
                    </div>

                    <ul class="list-group list-group-unbordered mt-15px">
                        <li class="list-group-item">
                            <b>ID</b> <span class="pull-right">#{{ $user->id }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Gender</b> <span class="pull-right">{{ $user->userData()->first()->gender }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Age</b> <span class="pull-right">{{ $user->userData()->first()->birth_date == '0000-00-00' ? '-' : date('Y', time()) - date('Y', strtotime($user->userData()->first()->birth_date)) }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Weight</b> <span class="pull-right">{{ $user->userData()->first()->weight ? $user->userData()->first()->weight.' kg' : '-' }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Height</b> <span class="pull-right">{{ $user->userData()->first()->height ? $user->userData()->first()->height.' cm' : '-' }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>About</b> <span class="pull-right">{{ $user->userData()->first()->about }}</span>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-question-circle-o"></i>
                    <h3 class="box-title">Question</h3>
                </div>
                <div class="box-body box-profile">
                    <div class="col-md-4">
                        <a target="_blank" href="{{ $question->image()->first() ? url()->to('/').$question->image()->first()->path.$question->image()->first()->filename : '#' }}">
                            <img class="answer-question-image" src="{{ $question->image()->first() ? url()->to('/').$question->image()->first()->path.$question->image()->first()->filename : url()->to('/').'/images/avatars/no_image.png' }}">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="question-date">{{ date('Y, M d H:i', strtotime($question->updated_at)) }}</div>
                        <div class="question-ip">IP: {{ $question->ip }}</div>
                        <div class="question-body">{{ $question->question }}</div>
                    </div>
                </div>
            </div>
            <div class="box box-success">
                <div class="box-header">
                    <i class="fa fa-question-circle-o"></i>
                    <h3 class="box-title">Answer</h3>
                </div>
                <div class="box-body box-profile">
                    <div class="col-md-12">
                        {!! Form::open([
                            'role' => 'form',
                            'url' => action('ConsultantController@answerSave', ['id' => $question->id]),
                            'method' => 'POST'
                        ]) !!}
                        <textarea class="textarea-ckeditor" id="answer" name="answer">{{ $question->answer()->first() ? $question->answer()->first()->answer : '' }}</textarea>
                        <button type="submit" class="btn btn-success mt-15px">Save & Preview</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop
@push('scripts')
<script>
    $(function () {
        CKEDITOR.replace('answer', {
            height : '400px'
        });
    });
</script>
@endpush