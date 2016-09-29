@extends('admin/frame')
@section('content-header')
    <h1>
        Voucher
        <small>details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('AdminController@vouchers') }}">Vouchers</a></li>
        <li class="active">Details</li>
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
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="inline mr-15px">
                        <i class="fa fa-user"></i> From: <a href="{{ action('AdminController@detailsUser', ['id' => $voucher->user->id]) }}">{{ $voucher->user->email }}</a>
                    </div>
                    <div class="inline">
                        <i class="fa fa-envelope"></i> To: {{ $voucher->receiver_email }}
                    </div>
                </div>
                <div class="box-body">
                    <h4>Voucher code: <strong>{{ $voucher->code }}</strong></h4>
                    <p>Price: <strong>£{{ $voucher->price }}</strong></p>
                    <p>Credits: <strong>{{ $voucher->credits }}</strong></p>
                    <p>Anonymous: <strong>{{ $voucher->anonymous ? 'YES' : 'NO' }}</strong></p>
                    @if($voucher->message)
                        <p><strong>Message:</strong><br/>{{ $voucher->message }}</p>
                    @endif
                </div>
                <div class="box-footer">
                    <h5>Status:
                        @if($voucher->status == 1)
                            <strong class="text-warning">PAID</strong>, not used yet
                        @elseif($voucher->status == 2)
                            <strong class="text-success">USED</strong> on {{ date('Y-m-d', strtotime($voucher->updated_at)) }}
                        @endif
                    </h5>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop