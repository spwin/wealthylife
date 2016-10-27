@extends('admin/frame')
@section('content-header')
    <h1>
        Answers
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                                    <td><a href="{{ action('AdminController@detailsUser', ['id' => $question->user()->first()->id]) }}">{{ $question->user()->first()->email }}</a></td>
                                    <td>{{ $question->ip }}</td>
                                    <td class="w100px">{{ $question->answer ? ($question->answer->seen ? 'YES' : 'NO') : 'NO' }}</td>
                                    <td class="w100px"><a href="{{ action('AdminController@showAnswer', ['id' => $question->answer->id]) }}" class="btn btn-primary">Show answer</a></td>
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