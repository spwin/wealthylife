@extends('consultant/frame')
@section('content-header')
    <h1>
        Answer
        <small>questions</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('ConsultantController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Answer questions</li>
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
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Answered today</span>
                    <span class="info-box-number">{{ count($answers) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-clock-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Today average</span>
                    <span class="info-box-number">{{ $average_time }} min</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red-gradient"><i class="fa fa-database"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total pending</span>
                    <span class="info-box-number">{{ $pending }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>

    @if(count($questions) > 0)
        <div class="row">
            <div class="col-sm-9">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td>
                                    @if(count($current->images) > 0)
                                        @foreach($current->images as $image)
                                            <a href="{{ url()->to('/').$image->path.$image->filename }}" target="_blank">
                                                <img class="admin-user-questions" src="{{ url()->to('/').'/photo/100x100/'.$image->filename }}">
                                            </a>
                                        @endforeach
                                    @else
                                        <img class="admin-user-questions" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                    @endif
                                </td>
                                <td>
                                    {{ $current->question }}
                                </td>
                                <td>
                                    <a href="{{ action('ConsultantController@detailsUser', $current->user->id) }}">{{ $current->user->email }}</a>
                                </td>
                                <td class="w100px text-bold">
                                    {{ date('d M, Y', strtotime($current->asked_at)) }}
                                </td>
                                <td>
                                    <a href="{{ action('ConsultantController@answerQuestion', ['id' => $current->id]) }}" class="btn btn-lg btn-success">Answer NOW</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Next 10 pending questions:</h3>
                    </div>
                    <div class="box-body">
                        @if(count($questions) > 1)
                            <table id="pending-questions" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Question</th>
                                    <th>User</th>
                                    <th>Asked at</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($first = true)
                                @foreach($questions as $question)
                                    @if($first)
                                        @php($first = false)
                                    @else
                                        <tr>
                                            <td class="w300px">
                                                @if(count($question->images) > 0)
                                                    @foreach($question->images as $image)
                                                        <a href="{{ url()->to('/').$image->path.$image->filename }}" target="_blank">
                                                            <img class="admin-user-questions" src="{{ url()->to('/').'/photo/100x100/'.$image->filename }}">
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <img class="admin-user-questions" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                                @endif
                                            </td>
                                            <td>{{ $question->question }}</td>
                                            <td>
                                                @if($question->user)
                                                    <a href="{{ action('ConsultantController@detailsUser', ['id' => $question->user->id]) }}">{{ $question->user->email }}</a>
                                                @else
                                                    Deleted
                                                @endif
                                            </td>
                                            <td class="w100px">
                                                {{ date('d M, Y', strtotime($question->asked_at)) }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            0 pending questions
                        @endif
                    </div>
                    <div class="box-footer">
                        <a href="{{ action('ConsultantController@listPending') }}">Show all pending</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-8">
                <h3>There are no pending questions..</h3>
            </div>
        </div>
    @endif
@stop