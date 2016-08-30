@extends('admin/frame')
@section('content-header')
    <h1>
        Payroll
        <small>view</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ action('AdminController@payroll') }}"><i class="fa fa-dashboard"></i> Payroll</a></li>
        <li class="active">View</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h4>{{ date('Y-m-d H:i', strtotime($current->starts_at)) }} - {{ date('Y-m-d H:i', strtotime($current->ends_at)) }}</h4>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Consultants</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Answered</th>
                            <th>To pay</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <a href="{{ action('AdminController@detailsConsultant', $user->id) }}">
                                        {{ $user->userData->first_name }} {{ $user->userData->last_name }}
                                    </a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->answers()->where(['payroll_id' => $current->id])->count() }}</td>
                                @php($total += ($price->value * $user->answers()->where(['payroll_id' => $current->id])->count()))
                                <td>{{ $price->value * $user->answers()->where(['payroll_id' => $current->id])->count() }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right">
                                TOTAL:
                            </td>
                            <td colspan="1">£ {{ $total }}</td>
                        </tr>
                        </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop