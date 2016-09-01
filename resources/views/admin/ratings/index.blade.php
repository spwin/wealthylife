@extends('admin/frame')
@section('content-header')
    <h1>
        Ratings
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ratings</li>
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
                                <th class="w85px"></th>
                                <th class="w85px">Created</th>
                                <th class="w100px">Rated</th>
                                <th>Feedback</th>
                                <th class="w85px"></th>
                                <th class="w85px"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($ratings as $rating)
                            <tr>
                                <td>#{{ $rating->id }}</td>
                                <td>{{ date('Y-m-d', strtotime($rating->created_at)) }}</td>
                                <td class="rating-stars">
                                    @if($rating->rating)
                                        @for ($i = 0; $i < $rating->rating; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                        @for ($i = 5; $i > $rating->rating; $i--)
                                            <i class="fa fa-star-o"></i>
                                        @endfor
                                    @endif
                                </td>
                                <td>{{ $rating->feedback }}</td>
                                <td><a href="{{ action('AdminController@detailsConsultant', ['id' => $rating->consultant_id]) }}">{{ $rating->consultant->email }}</a></td>
                                <td><a href="{{ action('AdminController@showAnswer', ['id' => $rating->id]) }}" class="btn btn-xs btn-default">Show answer</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $ratings->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop