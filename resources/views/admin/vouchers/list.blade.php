@extends('admin/frame')
@section('content-header')
    <h1>
        Vouchers
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vouchers</li>
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
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="pending-questions" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Receiver</th>
                            <th>Code</th>
                            <th>Price</th>
                            <th>Credits</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($vouchers as $voucher)
                                <tr>
                                    <td class="w40px">#{{ $voucher->id }}</td>
                                    <td><a href="{{ action('AdminController@detailsUser', ['id' => $voucher->user->id]) }}">{{ $voucher->user->email }}</a></td>
                                    <td>{{ $voucher->receiver_email }}</td>
                                    <td>{{ $voucher->code }}</td>
                                    <td>£{{ $voucher->price }}</td>
                                    <td>{{ $voucher->credits }}</td>
                                    <td>{{ $voucher->status == 1 ? 'PAID' : 'USED' }}</td>
                                    <td>{{ date('Y-m-d', strtotime($voucher->created_at)) }}</td>
                                    <td><a class="btn btn-xs btn-success" href="{{ action('AdminController@voucherDetails', ['id' => $voucher->id]) }}">Details</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $vouchers->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop