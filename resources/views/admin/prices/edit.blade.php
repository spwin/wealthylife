@extends('admin/frame')
@section('content-header')
    <h1>
        Edit Price
        <small>SCHEME</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('AdminController@prices') }}">Prices</a></li>
        <li class="active">Edit</li>
    </ol>
    @stop
    @section('content')
    {!! Form::model($scheme, [
        'role' => 'form',
        'url' => action('AdminController@updatePrice', ['id' => $scheme->id]),
        'method' => 'POST'
    ]) !!}
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->first('order', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('order', 'Order') !!}
                            {!! Form::input('number','order', null, ['class' => 'form-control', 'placeholder' => 'Order']) !!}
                            <span class="help-block">{{ $errors->first('order') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('credits', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('credits', 'Credits') !!}
                            {!! Form::input('number','credits', null, ['class' => 'form-control', 'placeholder' => 'Credits']) !!}
                            <span class="help-block">{{ $errors->first('credits') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('price', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('price', 'Price(£)') !!}
                            {!! Form::input('number','price', null, ['class' => 'form-control', 'placeholder' => 'Price']) !!}
                            <span class="help-block">{{ $errors->first('price') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('questions', 'has-error') }}">
                            {!! Form::label('questions', 'Questions count') !!}
                            {!! Form::input('number','questions', null, ['class' => 'form-control', 'placeholder' => 'Questions']) !!}
                            <span class="help-block">{{ $errors->first('questions') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('type', 'has-error') }}">
                            {!! Form::label('type', 'Type') !!}
                            {!! Form::select('type', ['vouchers' => 'vouchers', 'credits' => 'credits'], null, ['class' => 'form-control']) !!}
                            <span class="help-block">{{ $errors->first('type') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('comment', 'has-error') }}">
                            {!! Form::label('comment', 'Comment') !!}
                            {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Your Comment']) !!}
                            <span class="help-block">{{ $errors->first('comment') }}</span>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Create Price Scheme</button>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@stop