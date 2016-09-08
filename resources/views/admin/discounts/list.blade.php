@extends('admin/frame')
@section('content-header')
    <h1>
        Discounts
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Discounts</li>
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
                    <a href="{{ action('AdminController@createDiscount') }}" type="button" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Add discount</a>
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
                            <th>Title</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Used</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($discounts as $discount)
                                <tr>
                                    <td class="w40px">#{{ $discount->id }}</td>
                                    <td>{{ $discount->name }}</td>
                                    <td><a href="{{ action('AdminController@detailsUser', ['id' => $discount->user->id]) }}">{{ $discount->user->email }}</a></td>
                                    <td>{{ $discount->type == 'percent' ? $discount->percent.'%' : '£'.$discount->fixed }}</td>
                                    <td>{{ $discount->used ? date('Y-m-d H:i', strtotime($discount->used_at)) : '-' }}</td>
                                    <td>{{ date('Y-m-d', strtotime($discount->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $discounts->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop