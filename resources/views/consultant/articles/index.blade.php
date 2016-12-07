@extends('consultant/frame')
@section('content-header')
    <h1>
        Articles
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Articles</li>
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
                    <h3 class="box-title">Articles</h3>
                    <a href="{{ action('ConsultantController@createArticle') }}" class="btn btn-success btn-lg pull-right">Create new</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="pending-questions" class="table table-bordered table-hover scripted-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>User</th>
                            <th>Created</th>
                            <th>Published</th>
                            <th>Visits</th>
                            <th class="w100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td class="w40px">#{{ $article->id }}</td>
                                <td class="w100px"><img class="admin-user-questions" src="{{ url()->to('/').'/blog/100x100/'.$article->image->filename }}"></td>
                                <td><strong>{{ $article->title }}</strong></td>
                                <td><a href="{{ action('AdminController@detailsUser', ['id' => $article->user->id]) }}">{{ $article->user->email }}</a></td>
                                <td>{{ $article->created_at }}</td>
                                <td>{{ $article->published_at ? $article->published_at : 'NO' }}</td>
                                <td>{{ $article->visits }}</td>
                                <td class="w100px"><a href="{{ action('AdminController@detailsArticle', ['id' => $article->id]) }}" class="btn btn-success">Details</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop