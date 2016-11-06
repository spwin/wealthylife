@extends('admin/frame')
@section('content-header')
    <h1>
        Vouchers
        <small>creator</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Created Vouchers</li>
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
                        'action' => ['AdminController@createVoucher'],
                        'class' => 'inline'
                    ]) !!}
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->first('credits', 'has-error') }}"><span class="text-danger">*</span>
                            {!! Form::label('credits', 'Credits') !!}
                            {!! Form::input('number', 'credits', null, ['class' => 'form-control', 'placeholder' => 'credits']) !!}
                            <span class="help-block">{{ $errors->first('credits') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-xl pull-right phrase-add">Generate Voucher Code</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="box-body table-responsive no-padding">
                    <table id="pending-questions" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Credits</th>
                            <th>Code</th>
                            <th>Used by</th>
                            <th>Used on</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($vouchers as $voucher)
                                <tr>
                                    <td class="w40px">#{{ $voucher->id }}</td>
                                    <td><span class="badge bg-{{ $voucher->status == 1 ? 'green' : 'red' }}">{{ $voucher->status == 1 ? 'available' : 'used' }}</span></td>
                                    <td>{{ $voucher->credits }}</td>
                                    <td>{{ $voucher->code }}</td>
                                    <td>
                                        @if($voucher->usedBy)
                                            <a href="{{ action('AdminController@detailsUser', ['id' => $voucher->usedBy->id]) }}">{{ $voucher->usedBy->email }}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($voucher->status == 2)
                                            {{ date('Y-m-d', strtotime($voucher->updated_at)) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td><a class="btn btn-xs btn-success" href="{{ action('AdminController@createdVoucherDetails', ['id' => $voucher->id]) }}">Details</a></td>
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