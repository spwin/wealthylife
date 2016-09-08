@extends('admin/frame')
@section('content-header')
    <h1>
        Phrases
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Phrases</li>
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
                    {!! Form::open([
                        'method' => 'POST',
                        'action' => ['AdminController@processPhrases'],
                        'class' => 'inline'
                        ]) !!}
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->first('author', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('author', 'Author') !!}
                            {!! Form::text('author', null, ['class' => 'form-control', 'placeholder' => 'author']) !!}
                            <span class="help-block">{{ $errors->first('author') }}</span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group {{ $errors->first('text', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('text', 'Phrase') !!}
                            {!! Form::textarea('text', null, ['class' => 'form-control', 'placeholder' => 'Phrase', 'size' => '30x1']) !!}
                            <span class="help-block">{{ $errors->first('text') }}</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group {{ $errors->first('style', 'has-error') }}">
                            {!! Form::label('style', 'CSS override') !!}
                            {!! Form::textarea('style', null, ['class' => 'form-control', 'placeholder' => 'CSS override', 'size' => '30x1']) !!}
                            <span class="help-block">{{ $errors->first('style') }}</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group {{ $errors->first('enabled', 'has-error') }}">
                            {!! Form::label('enabled', 'Enabled') !!}
                            <div class="bigger-checkbox">
                                {!! Form::checkbox('enabled', 1, true, ['id' => 'enabled']) !!}
                            </div>
                            <span class="help-block">{{ $errors->first('enabled') }}</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success btn-xl pull-right phrase-add">Add phrase</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="pending-questions" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Phrase</th>
                            <th>Author</th>
                            <th>CSS override</th>
                            <th>Status</th>
                            <th>On/Off</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($phrases as $phrase)
                                <tr>
                                    <td class="w40px">#{{ $phrase->id }}</td>
                                    <td>{{ $phrase->text }}</td>
                                    <td>{{ $phrase->author }}</td>
                                    <td>{{ $phrase->style }}</td>
                                    <td>
                                        @if($phrase->enabled)
                                            <i class="fa fa-circle text-success"></i> Enabled
                                        @else
                                            <i class="fa fa-circle text-danger"></i> Disabled
                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::open([
                                            'method' => 'POST',
                                            'action' => ['AdminController@changePhrase', $phrase->id, ($phrase->enabled ? 'disable' : 'enable')],
                                            'class' => 'inline'
                                            ]) !!}
                                        <button type="submit" class="btn btn-{{ $phrase->enabled ? 'danger' : 'success' }} btn-xs">{{ $phrase->enabled ? 'Disable' : 'Enable' }}</button>
                                        {!! Form::close() !!}
                                    </td>
                                    <td class="w110px">
                                        <a href="{{ action('AdminController@editPhrase', ['id' => $phrase->id]) }}" class="btn btn-success btn-xs">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $phrases->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop