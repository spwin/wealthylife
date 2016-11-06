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
                        Generated on <strong>{{ date('Y-m-d', strtotime($voucher->created_at)) }}</strong>
                    </div>
                </div>
                <div class="box-body">
                    <h4>Voucher code: <strong>{{ $voucher->code }}</strong></h4>
                    @if($voucher->status == 2)
                        <p>Used by: <strong><a href="{{ action('AdminController@detailsUser', ['id' => $voucher->usedBy->id]) }}">{{ $voucher->usedBy->email }}</a></strong></p>
                    @endif
                    <p>Credits: <strong>{{ $voucher->credits }}</strong></p>
                </div>
                <div class="box-footer">
                    <h5>Status:
                        @if($voucher->status == 2)
                            <strong class="text-warning">USED COUPON</strong>, used on {{ date('Y-m-d', strtotime($voucher->updated_at)) }}
                        @elseif($voucher->status == 1)
                            <strong class="text-success">AVAILABLE</strong>
                        @endif
                    </h5>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop