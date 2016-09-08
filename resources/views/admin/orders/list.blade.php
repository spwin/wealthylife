@extends('admin/frame')
@section('content-header')
    <h1>
        Orders
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Orders</li>
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

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="pending-questions" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Question ID</th>
                            <th>Voucher ID</th>
                            <th>Braintree ID</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Issued at</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="w40px">#{{ $order->id }}</td>
                                    <td><a href="{{ action('AdminController@detailsUser', ['id' => $order->user->id]) }}">{{ $order->user->email }}</a></td>
                                    <td>{{ $order->type }}</td>
                                    <td>{{ $order->question_id }}</td>
                                    <td>{{ $order->voucher_id }}</td>
                                    <td>{{ $order->braintree_id }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->priceScheme ? '£ '.$order->priceScheme->price : '£ '.$price->value }}</td>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $orders->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop