@extends('consultant/frame')
@section('content-header')
    <h1>
        Article
        <small>create</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('ConsultantController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('ConsultantController@articles') }}">Articles</a></li>
        <li class="active">Create</li>
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
        {!! Form::model($article, [
            'role' => 'form',
            'url' => action('ConsultantController@updateArticle', $article->id),
            'method' => 'POST'
        ]) !!}
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-send-o"></i>
                    <h3 class="box-title">Information</h3>
                </div>
                <div class="box-body box-profile">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Status</b> <span class="badge bg-{{ $article->status == 3 ? 'green' : 'red' }} pull-right">{{ $article->status == 3 ? 'Published' : 'Unpublished' }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Visits</b> <span class="pull-right">{{ $article->visits }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Created</b> <span class="pull-right">{{ date('d M, Y \a\t H:i:s', strtotime($article->created_at)) }}</span>
                        </li>
                        @if($article->status== 3)
                            <li class="list-group-item">
                                <b>Published</b> <span class="pull-right">{{ date('d M, Y \a\t H:i:s', strtotime($article->published_at)) }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="box-footer">
                    <a href="{{ action('ConsultantController@previewArticle', ['url' => $article->url]) }}" class="btn btn-warning btn-sm" target="_blank">Preview</a>
                    @if($article->status == 3)
                        <input type="submit" name="unpublish" value="Unpublish" class="btn btn-danger btn-sm">
                    @else
                        <input type="submit" name="publish" value="Publish" class="btn btn-primary btn-sm">
                    @endif
                    <input type="submit" name="save" value="Save" class="btn btn-success btn-sm pull-right">

                </div>
                <!-- /.box-body -->
            </div>

            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-photo"></i>
                    <h3 class="box-title">Main image <span class="text-danger">*</span></h3>
                </div>
                <div class="box-body box-profile">
                    <div class="form-group {{ $errors->first('image_url', 'has-error') }}">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            {!! Form::text('image_url', null, ['class' => 'form-control', 'id' => 'thumbnail', 'readonly' => 'readonly']) !!}
                        </div>
                        <span class="help-block text-danger">{{ $errors->first('image_url') }}</span>
                    </div>
                    <img id="holder" class="main-article-image-holder" src="{{ $image_url }}">
                </div>
                <!-- /.box-body -->
            </div>

            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-user"></i>
                    <h3 class="box-title">Article details</h3>
                </div>
                <div class="box-body box-profile">
                    <div class="form-group {{ $errors->first('hide_name', 'has-error') }}">
                        {!! Form::checkbox('hide_name', 1, null, ['id' => 'hide_name']) !!}
                        {!! Form::label('hide_name', 'Hide my name', ['class' => 'regular-font-weight ml5px']) !!}
                        <span class="help-block">{{ $errors->first('hide_name') }}</span>
                    </div>
                    <div class="form-group {{ $errors->first('hide_email', 'has-error') }}">
                        {!! Form::checkbox('hide_email', 1, null, ['id' => 'hide_email']) !!}
                        {!! Form::label('hide_email', 'Hide my email', ['class' => 'regular-font-weight ml5px']) !!}
                        <span class="help-block">{{ $errors->first('hide_email') }}</span>
                    </div>
                    <div class="form-group {{ $errors->first('disable_comments', 'has-error') }}">
                        {!! Form::checkbox('disable_comments', 1, null, ['id' => 'disable_comments']) !!}
                        {!! Form::label('disable_comments', 'Disable comments', ['class' => 'regular-font-weight ml5px']) !!}
                        <span class="help-block">{{ $errors->first('disable_comments') }}</span>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-newspaper-o"></i>
                    <h3 class="box-title">Article</h3>
                </div>
                <div class="box-body box-profile">
                    <div class="form-group {{ $errors->first('title', 'has-error') }}"><span class="text-danger">*</span>
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Article title']) !!}
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    </div>
                    <div class="form-group {{ $errors->first('content', 'has-error') }}"><span class="text-danger">*</span>
                        {!! Form::label('content', 'Content') !!}
                        <span class="help-block">{{ $errors->first('content') }}</span>
                        {!! Form::textarea('content', null, ['size' => '0x0', 'class' => 'form-control article_content', 'id' => 'article_content', 'placeholder' => 'Article title']) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.row -->
@stop
@push('scripts')
<script src="{{ URL::to('/') }}/vendor/ckeditor/ckeditor.js"></script>
<script src="{{ URL::to('/') }}/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
    ($)(function(){
        $('#lfm').filemanager('image');
        CKEDITOR.replace( 'article_content', {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
    });
</script>
@endpush