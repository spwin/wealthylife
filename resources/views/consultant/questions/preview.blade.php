@extends('consultant/frame')
@section('content-header')
    <h1>
        Preview
        <small>answer</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('ConsultantController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('ConsultantController@listPending') }}">Pending</a></li>
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
                        <h3 class="box-title">Answer</h3>
                    </div>
                    <div class="box-body box-profile">
                        {!! $answer->answer !!}
                    </div>
                    @if($answer->question()->first()->status == 1)
                        <div class="box-footer">
                            {!! Form::open([
                                'role' => 'form',
                                'url' => action('ConsultantController@answerSend', ['id' => $answer->id]),
                                'method' => 'POST',
                                'class' => 'inline'
                            ]) !!}
                            <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-letter"></i> Send</button>
                            {!! Form::close() !!}
                            <a href="{{ action('ConsultantController@answerQuestion', ['id' => $question->id]) }}" class="btn btn-lg btn-default">Edit</a>
                        </div>
                    @elseif($answer->question()->first()->status == 2)
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
                            <div class="pull-right">
                                <a href="{{ action('ConsultantController@listAnswered') }}" class="btn btn-default">Show all answered</a>
                            </div>
                        </div>
                    @else
                        <div class="box-footer">
                            <a href="{{ action('ConsultantController@listAnswered') }}" class="btn btn-default">Show all answered</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop