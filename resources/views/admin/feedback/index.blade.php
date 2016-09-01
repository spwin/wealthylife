@extends('admin/frame')
@section('content-header')
    <h1>
        Feedback
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Feedback</li>
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
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Feedback</th>
                                <th>User</th>
                                <th>IP</th>
                                <th class="w85px">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($feedback as $f)
                            <tr>
                                <td>{{ $f->content }}</td>
                                <td>{!! $f->user ? '<a href="'.action('AdminController@detailsUser', ['id' => $f->user_id]).'">'.$f->user->email.'</a>' : ' - ' !!}</td>
                                <td>{{ $f->ip }}</td>
                                <td>{{ date('Y-m-d', strtotime($f->created_at)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($type == 'all')
                        {{ $feedback->links() }}
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop