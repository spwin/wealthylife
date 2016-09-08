@extends('admin/frame')
@section('content-header')
    <h1>
        Create Discount
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('AdminController@discounts') }}">Discounts</a></li>
        <li class="active">Create</li>
    </ol>
    @stop
    @section('content')
    {!! Form::open([
        'role' => 'form',
        'url' => action('AdminController@saveDiscount'),
        'method' => 'POST'
    ]) !!}
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->first('email', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('email', 'User email') !!}
                            {!! Form::input('email','email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('name', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('name', 'Discount Title') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('type', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('type', 'Type') !!}
                            {!! Form::select('type', ['percent' => 'Percent (%)', 'fixed' => 'Fixed (£)'], null, ['class' => 'form-control']) !!}
                            <span class="help-block">{{ $errors->first('type') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('value', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('value', 'Discount value') !!}
                            {!! Form::input('number','value', null, ['class' => 'form-control', 'placeholder' => 'Discount value']) !!}
                            <span class="help-block">{{ $errors->first('value') }}</span>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Add Discount</button>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@stop