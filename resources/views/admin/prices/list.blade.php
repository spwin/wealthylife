@extends('admin/frame')
@section('content-header')
    <h1>
        Price Schemes
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Prices</li>
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
        <div class="col-xs-12">
            <div class="form-group">
                <a href="{{ action('AdminController@createPrice') }}" type="button" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Add price scheme</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="pending-questions" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order</th>
                            <th>Credits</th>
                            <th>Price</th>
                            <th>Questions</th>
                            <th>Type</th>
                            <th>Comment</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($prices as $price)
                                <tr>
                                    <td class="w40px">#{{ $price->id }}</td>
                                    <td>{{ $price->order }}</td>
                                    <td>{{ $price->credits }}</td>
                                    <td>£{{ $price->price }}</td>
                                    <td>{{ $price->questions }}</td>
                                    <td>{{ $price->type }}</td>
                                    <td>{{ $price->comment }}</td>
                                    <td class="w110px">
                                        {!! Form::open([
                                            'method' => 'POST',
                                            'action' => ['AdminController@deletePrice', $price->id],
                                            'onclick'=> 'return confirm("Are you sure?")',
                                            'class' => 'inline'
                                            ]) !!}
                                        <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                        {!! Form::close() !!}
                                        <a href="#" class="btn btn-success btn-xs">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $prices->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop