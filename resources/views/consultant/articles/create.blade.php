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
        {!! Form::open([
            'role' => 'form',
            'url' => action('ConsultantController@saveArticle'),
            'method' => 'POST'
        ]) !!}
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-send-o"></i>
                    <h3 class="box-title">Information</h3>
                </div>
                <div class="box-body box-profile">
                    Article is not saved yet
                </div>
                <div class="box-footer">
                    <input type="submit" name="save" value="Save article" class="btn btn-success btn-sm">
                </div>
                <!-- /.box-body -->
            </div>

            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-photo"></i>
                    <h3 class="box-title">Main image <span class="text-danger">*</span></h3>
                </div>
                <div class="box-body box-profile">
                    <div class="form-group {{ $errors->first('image', 'has-error') }}">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            {!! Form::text('image_url', null, ['readonly' => 'readonly', 'class' => 'form-control', 'id' => 'thumbnail']) !!}
                        </div>
                        <span class="help-block text-danger">{{ $errors->first('image') }}</span>
                    </div>
                    <img id="holder" class="main-article-image-holder">
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