@extends('consultant/frame')
@section('content-header')
    <h1>
        Current Payroll
        <small>Started on {{ date('j M', strtotime($payroll->starts_at)) }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@stop
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-gbp"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Earned</span>
                        <span class="info-box-number">£ {{ $gross_consultant * count($answers) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-newspaper-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Articles published</span>
                        <span class="info-box-number">{{ count($articles) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-clock-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Average answer time</span>
                        <span class="info-box-number">{{ $summary->average_answer_time }} min</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-star-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Average rating</span>
                        <span class="info-box-number">{{ $rating }}/5</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Questions - Last 30 days</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="questionsChart" style="height: 213px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box pending-questions">
                    <div class="box-header">
                        <h3 class="box-title">Pending questions</h3>
                    </div>
                    <div class="box-body">
                        <div class="pending-questions-count">
                            {{ count($pending) }}
                        </div>
                        <div class="answer-pending">
                            <a href="{{ action('ConsultantController@interactiveAnswer') }}" class="btn btn-success">ANSWER NOW</a>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="progress-group">
                            <span class="progress-text">Answered questions</span>
                            <span class="progress-number"><b>{{ count($answers) }}</b>/{{ count($pending) + count($answers) }}</span>

                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width: {{ (count($pending) + count($answers)) > 0 ? round(100*(count($answers)/(count($pending) + count($answers)))) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Latest 5 members</h3>
                    </div>
                    <div class="box-body no-padding new-users">
                        <ul class="users-list clearfix">
                            @foreach($latest_users as $user)
                                <li>
                                    <img src="{{ $user->userData->image ? URL::to('/').$user->userData->image->path.$user->userData->image->filename : URL::to('/').'/images/avatars/no_image.png'}}" alt="User Image">
                                    <a class="users-list-name" href="{{ action('ConsultantController@detailsUser', ['id' => $user->id]) }}">{{ $user->userData->first_name.' '.$user->userData->last_name }}</a>
                                    <span class="users-list-date">
                                        @if(date('l M', time()) == date('l M', strtotime($user->created_at)))
                                            Today
                                        @elseif(date('l M', time()-86400) == date('l M', strtotime($user->created_at)))
                                            Yesterday
                                        @else
                                            {{ date('d M', strtotime($user->created_at)) }}
                                        @endif
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="box-footer">
                        <a href="{{ action('ConsultantController@listUsers') }}" class="btn btn-primary"><i class="fa fa-arrow-right"></i> All Users List</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Today working time</h3>
                    </div>
                    <div class="box-body dashboard-timetable">
                        <table class="time-table">
                            @php($day = strtolower(date('D')))
                            <tr>
                                <th>{{ date('l') }} - {{ $timetable['totals'][$day] }}</th>
                            </tr>
                            <tr class="time-slots">
                                <td>
                                    <div class="zero-hour">0:00</div>
                                    @foreach($timetable['slots'][$day] as $slot)
                                        <div class="{{ $slot['type'] }}" style="width: {{ $slot['amount'] }}%;">
                                            @if($slot['type'] == 'busy')
                                                <div class="slot-tooltip">{{ $slot['tooltip'] }}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                    <div class="right-stick">0:00</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="box-footer">
                        <a href="{{ action('ConsultantController@timetable') }}" class="btn btn-primary"><i class="fa fa-arrow-right"></i> View whole week timetable</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">5 Latest Answers</div>
                    </div>
                    <div class="box-body">
                        <table class="summary-answers">
                            @foreach($latest_answered as $question)
                            <tr>
                                <td>#{{ $question->answer->id }}</td>
                                <td class="w150px">{{ date('l M, H:i', strtotime($question->answered_at)) }}</td>
                                <td>{{ substr($question->question, 0, 50).'...' }}</td>
                                <td class="w90px"><a href="{{ action('ConsultantController@answerPreview', $question->answer->id) }}">View answer</a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">5 Latest Reviews</div>
                    </div>
                    <div class="box-body">
                        <table class="summary-answers">
                            @foreach($latest_rated as $rating)
                                <tr>
                                    <td class="w100px">
                                        <div class="rating-stars">
                                            @if($rating->rating)
                                                @for ($i = 0; $i < $rating->rating; $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                                @for ($i = 5; $i > $rating->rating; $i--)
                                                    <i class="fa fa-star-o"></i>
                                                @endfor
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ substr($rating->feedback, 0, 50).'...' }}</td>
                                    <td class="w90px"><a href="{{ action('ConsultantController@answerPreview', $rating->id) }}">View more</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@push('scripts')
<script src="../js/admin/Chart.min.js"></script>
<script>
    $(function(){
        // Get context with jQuery - using jQuery's .get() method.
        var questionsChartCanvas = $("#questionsChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var questionsChart = new Chart(questionsChartCanvas);

        var labels = [<?php echo '"'.implode('","', $daily_questions['labels']).'"' ?>];
        var values = [<?php echo '"'.implode('","', $daily_questions['values']).'"' ?>];

        var questionsChartData = {
            labels: labels,
            datasets: [
                {
                    label: "Questions",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: values
                }
            ]
        };

        var questionsChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: false,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 10,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true
        };

        //Create the line chart
        questionsChart.Line(questionsChartData, questionsChartOptions);

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