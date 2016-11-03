@extends('admin/frame')
@section('content-header')
    <h1>
        Preview
        <small>answer</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('AdminController@answers') }}">Answers</a></li>
        <li class="active">View</li>
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
                        @if(count($question->images) > 0)
                            @foreach($question->images as $image)
                                <div class="col-md-12 margin-bottom">
                                    <a target="_blank" href="{{ url()->to('/').$image->path.$image->filename }}">
                                        <img class="answer-question-image" src="{{ url()->to('/').'/photo/200x200/'.$image->filename }}">
                                    </a>
                                </div>
                            @endforeach
                            <div class="clearfix"></div>
                        @endif
                        <div class="question-date mt-15px">{{ date('Y, M d H:i', strtotime($question->updated_at)) }}</div>
                        <div class="question-ip">IP: {{ $question->ip }}</div>
                        <div class="question-body">{{ $question->question }}</div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ action('AdminController@detailsUser', ['id' => $question->user()->first()->id]) }}">{{ $question->user()->first()->email }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <div class="box-header">
                        <i class="fa fa-question-circle-o"></i>
                        <h3 class="box-title">Answer</h3>
                    </div>
                    <div class="box-body box-profile">
                        {!! $answer->answer !!}
                    </div>
                    @if($answer->question()->first()->status == 2)
                        <div class="box-footer">
                            <div class="rating-stars">
                                @if($answer->rating)
                                    @for ($i = 0; $i < $answer->rating; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    @for ($i = 5; $i > $answer->rating; $i--)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                @endif
                            </div>
                            @if($answer->feedback)
                                <div class="italic">"{{ $answer->feedback }}"</div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop