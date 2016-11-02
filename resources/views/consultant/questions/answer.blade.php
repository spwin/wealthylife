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
                            <b>About</b> <div>{{ $user->userData()->first()->about }}</div>
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
                    <div class="col-md-12 margin-bottom">
                        <div class="question-date">{{ date('Y, M d H:i', strtotime($question->updated_at)) }}</div>
                        <div class="question-ip">IP: {{ $question->ip }}</div>
                        <div class="question-body">{{ $question->question }}</div>
                    </div>
                    <div class="col-md-12 margin-bottom">
                        @if(count($question->images) > 0)
                            @foreach($question->images as $image)
                                <div class="col-md-4">
                                    <a target="_blank" href="{{ url()->to('/').$image->path.$image->filename }}">
                                        <img class="answer-question-image" src="{{ url()->to('/').$image->path.$image->filename }}">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#rejectionReason">
                        Reject question
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="rejectionReason" tabindex="-1" role="dialog" aria-labelledby="rejectionReason">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                {!! Form::open([
                                    'role' => 'form',
                                    'url' => action('ConsultantController@rejectQuestion', ['id' => $question->id]),
                                    'method' => 'POST'
                                ]) !!}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Rejection reason</h4>
                                </div>
                                <div class="modal-body">
                                    <h4>Credits will be returned to user after rejection.</h4>
                                    <div class="form-group"><span class="text-danger">*</span>
                                        {!! Form::label('reason', 'Please enter rejection reason here:') !!}
                                        {!! Form::textarea('reason', null, ['class' => 'form-control', 'placeholder' => 'Rejection reason', 'size' => '30x4', 'id' => 'reject-reason', 'required' => true]) !!}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Reject</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
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