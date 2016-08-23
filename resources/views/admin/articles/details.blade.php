@extends('admin/frame')
@section('content-header')
    <h1>
        Article
        <small>details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('AdminController@articles', ['type' => $type]) }}">{{ ucfirst($type) }}</a></li>
        <li class="active">Details</li>
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
                    <h3 class="box-title">Article</h3>
                </div>
                <div class="box-body box-profile">
                    <div class="col-md-4">
                        <a target="_blank" href="{{ url()->to('/').$article->image->path.$article->image->filename }}">
                            <img class="answer-question-image" src="{{ url()->to('/').'/blog/500x500/'.$article->image->filename }}">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="question-date">{{ date('Y, M d H:i', strtotime($article->created_at)) }}</div>
                        <div class="question-body">{!! $article->content !!}</div>
                    </div>
                </div>
                <div class="article-details box-footer">
                    <span><i class="fa fa-user"></i> Hide name: <strong>{{ $article->hide_name ? 'YES' : 'NO' }}</strong></span>
                    <span><i class="fa fa-envelope"></i> Hide email: <strong>{{ $article->hide_email ? 'YES' : 'NO' }}</strong></span>
                    <span><i class="fa fa-comment"></i> Disable comments: <strong>{{ $article->disable_comments ? 'YES' : 'NO' }}</strong></span>
                    <div class="article-actions">
                        <div class="mt-15px pull-left">
                            <span class="article-current-status">Current status: <strong class="text-color-{{ $type }}">{{ ucfirst($type) }}</strong></span>
                        </div>
                        <div class="mt-15px pull-right">
                            @if($article->status == 1 || $article->status == 3)
                                <div class="article-action-btn">
                                    {!! Form::open([
                                        'role' => 'form',
                                        'url' => action('AdminController@editArticle', ['id' => $article->id]),
                                        'method' => 'POST'
                                    ]) !!}
                                    <input type="hidden" name="type" value="{{ $type }}">
                                    <input type="hidden" name="action" value="archive">
                                    <button type="submit" class="btn btn-warning btn-lg">Archive</button>
                                    {!! Form::close() !!}
                                </div>
                            @endif

                            @if($article->status == 1 || $article->status == 2)
                                <div class="article-action-btn">
                                    {!! Form::open([
                                        'role' => 'form',
                                        'url' => action('AdminController@editArticle', ['id' => $article->id]),
                                        'method' => 'POST'
                                    ]) !!}
                                    <input type="hidden" name="type" value="{{ $type }}">
                                    <input type="hidden" name="action" value="publish">
                                    <button type="submit" class="btn btn-success btn-lg">Publish</button>
                                    {!! Form::close() !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop