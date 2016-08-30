@extends('admin/frame')
@section('content-header')
    <h1>
        Payroll
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payroll</li>
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
                    <h3 class="box-title">Current</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Started at</th>
                                <th>Lasts</th>
                                <th>Answers</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ date('d M, Y H:i', strtotime($current->starts_at )) }}</td>
                                <td>{{ $lasts }}</td>
                                <td>{{ $current->answers()->count() }}</td>
                                <td class="w100px">
                                    {!! Form::open([
                                            'method' => 'POST',
                                            'action' => ['AdminController@endPayroll', $current->id],
                                            'onclick'=> 'return confirm("Are you sure?")',
                                            'class' => 'inline'
                                            ]) !!}
                                    <button type="submit" class="btn btn-success">End period</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    @if(count($payroll) > 0)
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Periods</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Starts</th>
                                <th>Ends</th>
                                <th>Lasts</th>
                                <th>Answers</th>
                                <th>Paid</th>
                                <th class="w100px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payroll as $period)
                                <?php
                                    $created = new \Carbon\Carbon($period->starts_at);
                                    $now = \Carbon\Carbon::now();
                                    $lasts = str_replace('before', '', $created->diffForHumans($now));
                                ?>
                                <tr class="periods">
                                    <td onclick="window.location.href = '{{ action('AdminController@viewPayroll', ['id' => $period->id]) }}';">#{{ $period->id }}</td>
                                    <td onclick="window.location.href = '{{ action('AdminController@viewPayroll', ['id' => $period->id]) }}';">{{ date('d M, Y H:i', strtotime($period->starts_at )) }}</td>
                                    <td onclick="window.location.href = '{{ action('AdminController@viewPayroll', ['id' => $period->id]) }}';">{{ date('d M, Y H:i', strtotime($period->ends_at )) }}</td>
                                    <td onclick="window.location.href = '{{ action('AdminController@viewPayroll', ['id' => $period->id]) }}';">{{ $lasts }}</td>
                                    <td onclick="window.location.href = '{{ action('AdminController@viewPayroll', ['id' => $period->id]) }}';">{{ $period->answers()->count() }}</td>
                                    <td onclick="window.location.href = '{{ action('AdminController@viewPayroll', ['id' => $period->id]) }}';">{{ $period->paid_at == null ? '-' : date('d M, Y H:i', strtotime($period->paid_at )) }}</td>
                                    <td>
                                        @if($period->paid_at == null)
                                            {!! Form::open([
                                            'method' => 'POST',
                                            'action' => ['AdminController@payPayroll', $period->id],
                                            'onclick'=> 'return confirm("Are you sure?")',
                                            'class' => 'inline'
                                            ]) !!}
                                            <button type="submit" class="btn btn-success">Mark as paid</button>
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    @endif
    <!-- /.row -->
@stop