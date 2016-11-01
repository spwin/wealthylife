@extends('consultant/frame')
@section('content-header')
    <h1>
        Timetable
        <small>Check your working time</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Timetable</li>
    </ol>
    @stop
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Total per week: {{ $timetable['total'] }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="time-table">
                        <tr>
                            @foreach($matcher as $short_name => $day)
                                <th>{{ $day }} - {{ $timetable['totals'][$short_name] }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @php($counter = 0)
                            @foreach($matcher as $day => $name)
                                <td>
                                    @php($counter++)
                                    <div class="zero-hour">0:00</div>
                                    @foreach($timetable['slots'][$day] as $slot)
                                        <div class="{{ $slot['type'] }}" style="width: {{ $slot['amount'] }}%;">
                                            @if($slot['type'] == 'busy')
                                                <div class="slot-tooltip">{{ $slot['tooltip'] }}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                    @if($counter == 7)
                                        <div class="right-stick">0:00</div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
@stop
@push('scripts')
<script>
    ($)(function() {
        var busy = $('.busy');
        busy.on('mouseover', function () {
            $(this).find('.slot-tooltip').show();
        });
        busy.on('mouseout', function () {
            $(this).find('.slot-tooltip').hide();
        });
    });
</script>
@endpush