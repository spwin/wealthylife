@extends('admin/frame')
@section('content-header')
    <h1>
        Edit Phrase
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('AdminController@phrases') }}">Phrases</a></li>
        <li class="active">Edit</li>
    </ol>
    @stop
    @section('content')
    {!! Form::model($phrase, [
        'role' => 'form',
        'url' => action('AdminController@updatePhrase', ['id' => $phrase->id]),
        'method' => 'POST'
    ]) !!}
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->first('author', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('author', 'Author') !!}
                            {!! Form::text('author', null, ['class' => 'form-control', 'placeholder' => 'author']) !!}
                            <span class="help-block">{{ $errors->first('author') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('text', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('text', 'Phrase') !!}
                            {!! Form::textarea('text', null, ['class' => 'form-control', 'placeholder' => 'Phrase']) !!}
                            <span class="help-block">{{ $errors->first('text') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('style', 'has-error') }}">
                            {!! Form::label('style', 'CSS override') !!}
                            {!! Form::textarea('style', null, ['class' => 'form-control', 'placeholder' => 'CSS override']) !!}
                            <span class="help-block">{{ $errors->first('style') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('enabled', 'has-error') }}">
                            {!! Form::checkbox('enabled', 1, null, ['id' => 'enabled']) !!}
                            {!! Form::label('enabled', 'Enabled') !!}
                            <span class="help-block">{{ $errors->first('enabled') }}</span>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save phrase</button>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@stop