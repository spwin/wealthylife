@extends('consultant/frame')
@section('content-header')
    <h1>
        Questions
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('ConsultantController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Questions</li>
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
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $status }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="pending-questions" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Question</th>
                            <th>User</th>
                            <th>IP</th>
                            <th class="w60px">{{ $stat == 1 ? 'Paid' : 'Seen' }}</th>
                            <th class="w100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
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
                                    <td><a href="{{ action('ConsultantController@detailsUser', ['id' => $question->user()->first()->id]) }}">{{ $question->user()->first()->email }}</a></td>
                                    <td>{{ $question->ip }}</td>
                                    <td class="w100px">
                                        @if($question->status == 1)
                                            {{ date('d M, Y H:i', strtotime($question->updated_at)) }}
                                        @else
                                            {{ $question->answer()->first() ? ($question->answer()->first()->seen ? 'YES' : 'NO') : 'NO' }}
                                        @endif
                                    </td>
                                    <td class="w100px">
                                        @if($question->status == 1)
                                            <a href="{{ action('ConsultantController@answerQuestion', ['id' => $question->id]) }}" class="btn btn-success">Answer</a>
                                        @elseif($question->status == 3)
                                            <a href="{{ action('ConsultantController@rejectionPreview', $question->id) }}" class="btn btn-primary">Check reason</a>
                                        @else
                                            <a href="{{ action('ConsultantController@answerPreview', $question->answer()->first() ? $question->answer()->first()->id : '') }}" class="btn btn-primary">Show answer</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $questions->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop