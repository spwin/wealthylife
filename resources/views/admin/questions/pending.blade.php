@extends('admin/frame')
@section('content-header')
    <h1>
        Questions
        <small>Pending</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pending</li>
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
                    <h3 class="box-title">Pending</h3>
                    {!! Form::open([
                        'role' => 'form',
                        'url' => action('AdminController@pending'),
                        'files' => true,
                        'method' => 'GET'
                    ]) !!}
                    {!! Form::text('search', $search, ['class' => 'form-control w200px inline']) !!}
                    <input type="submit" value="Search" class="btn btn-sm btn-default">
                    {!! Form::close() !!}
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
                            <th>Consultant</th>
                            <th>Change Consultant</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td class="w40px">#{{ $question->id }}</td>
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
                                            <a href="{{ action('AdminController@detailsUser', ['id' => $question->user->id]) }}">{{ $question->user->email }}</a>
                                        @else
                                            Deleted
                                        @endif
                                    </td>
                                    <td><a href="{{ action('AdminController@detailsConsultant', ['id' => $question->consultant->id]) }}">{{ $question->consultant->email }}</a></td>
                                    <td class="w100px">
                                        {!! Form::open([
                                            'role' => 'form',
                                            'url' => action('AdminController@changeConsultant', ['id' => $question->id]),
                                            'files' => true,
                                            'method' => 'GET'
                                        ]) !!}
                                        {!! Form::select('consultant', $consultants, $question->consultant->id, ['class' => 'form-control w200px inline']) !!}
                                        <button type="submit" class="btn btn-primary">Change consultant</button>
                                        {!! Form::close() !!}
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