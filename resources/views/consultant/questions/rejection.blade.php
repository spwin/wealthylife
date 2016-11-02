@extends('consultant/frame')
@section('content-header')
    <h1>
        Preview
        <small>rejection</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('ConsultantController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('ConsultantController@listRejected') }}">Rejected</a></li>
        <li class="active">Preview</li>
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
                    <div class="box-header">
                        <i class="fa fa-question-circle-o"></i>
                        <h3 class="box-title">Question</h3>
                    </div>
                    <div class="box-body box-profile">
                        <div class="images-container">
                            @if(count($question->images) > 0)
                                @foreach($question->images as $image)
                                    <div class="col-md-12 margin-bottom">
                                        <a target="_blank" href="{{ url()->to('/').$image->path.$image->filename }}">
                                            <img class="answer-question-image" src="{{ url()->to('/').'/photo/200x200/'.$image->filename }}">
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <img class="admin-user-questions" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <div class="question-date mt-15px">{{ date('Y, M d H:i', strtotime($question->updated_at)) }}</div>
                        <div class="question-ip">IP: {{ $question->ip }}</div>
                        <div class="question-body">{{ $question->question }}</div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ action('ConsultantController@detailsUser', ['id' => $question->user()->first()->id]) }}">{{ $question->user()->first()->email }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <div class="box-header">
                        <i class="fa fa-question-circle-o"></i>
                        <h3 class="box-title">Rejection reason</h3>
                    </div>
                    <div class="box-body box-profile">
                        {!! $question->rejection !!}
                    </div>
                    <div class="box-footer">
                        <a href="{{ action('ConsultantController@listRejected') }}" class="btn btn-default">Show all rejected</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop