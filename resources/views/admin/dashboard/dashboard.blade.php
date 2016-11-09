@extends('admin/frame')
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
                    <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Revenue</span>
                        <span class="info-box-number">£904</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-ticket"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Questions</span>
                        <span class="info-box-number">4213</span>
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
                    <span class="info-box-icon bg-green"><i class="fa fa-comment-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">New Feedbacks</span>
                        <span class="info-box-number">15</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-newspaper-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Articles New/Edited</span>
                        <span class="info-box-number">30/2</span>
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
                        <h3 class="box-title">Orders - Last 30 days</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="ordersChart" style="height: 213px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header text-center">
                        <h3 class="box-pie-title">TOTAL: <strong>£{{ $orders['totals']['total'] }}</strong></h3>
                    </div>
                    <div class="box-body text-center no-padding">
                        <canvas id="orderTotalsChart" style="height:160px"></canvas>
                    </div>
                    <div class="box-footer text-center">
                        <h3 class="box-pie-title">Credits discounts: <strong>£{{ $orders['totals']['discounts'] }}</strong></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Answers - Last 30 days</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="answersChart" style="height: 213px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">This period summary</h3>
                    </div>
                    <div class="box-body consultants-summary">
                        <table class="summary-consultants">
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Consultant</th>
                                <th>Answers</th>
                            </tr>
                            @foreach($answers['totals'] as $id => $data)
                                <tr>
                                    <td>#{{ $id }}</td>
                                    <td><div class="consultant-color-preview" style="background-color: {{ $data['color'].',1)' }};"></div></td>
                                    <td><a href="{{ action('AdminController@detailsConsultant', ['id' => $id]) }}">{{ $data['name'] }}</a></td>
                                    <td>{{ $data['answers'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer">
                        <a href="{{ action('AdminController@listConsultants') }}" class="btn btn-default pull-right">Consultants details</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Questions - Last 30 days</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="questionsChart" style="height: 213px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">This period summary</h3>
                    </div>
                    <div class="box-body questions-summary">
                        <ul>
                            <li><h4>Questions: {{ $questions['totals']['questions'] }}</h4></li>
                            <li>Pending: <strong>{{ $questions['totals']['pending'] }} {{ $questions['totals']['questions'] > 0 && $questions['totals']['pending'] > 0 ? '('.round(100*$questions['totals']['pending']/$questions['totals']['questions'], 2).'%)' : '' }}</strong></li>
                            <li>Answered: <strong>{{ $questions['totals']['answered'] }} {{ $questions['totals']['questions'] > 0 && $questions['totals']['answered'] > 0 ? '('.round(100*$questions['totals']['answered']/$questions['totals']['questions'], 2).'%)' : '' }}</strong></li>
                            <li>Rejected: <strong>{{ $questions['totals']['rejected'] }} {{ $questions['totals']['questions'] > 0 && $questions['totals']['rejected'] > 0 ? '('.round(100*$questions['totals']['rejected']/$questions['totals']['questions'], 2).'%)' : '' }}</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Users - Last 30 days</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="usersChart" style="height: 213px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header text-center">
                        <h3 class="box-pie-title">Period NEW: <strong>{{ $users['totals']['users'] }}</strong></h3>
                    </div>
                    <div class="box-body text-center no-padding">
                        <canvas id="usersPieChart" style="height:160px"></canvas>
                    </div>
                    <div class="box-footer text-center">
                        <a href="{{ action('AdminController@listUsers') }}" class="btn btn-primary">All users</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Articles - Last 30 days</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="articlesChart" style="height: 213px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">This period summary</h3>
                    </div>
                    <div class="box-body questions-summary">
                        <ul>
                            <li><h4>New articles: <strong>{{ $articles['totals']['articles'] }}</strong></h4></li>
                            <li>Published: <strong>{{ $articles['totals']['published'] }} {{ $articles['totals']['articles'] > 0 && $articles['totals']['published'] > 0 ? '('.(100*$articles['totals']['published']/$articles['totals']['articles']).'%)' : '' }}</strong></li>
                            <li>Archived: <strong>{{ $articles['totals']['archived'] }} {{ $articles['totals']['articles'] > 0 && $articles['totals']['archived'] > 0 ? '('.(100*$articles['totals']['archived']/$articles['totals']['articles']).'%)' : '' }}</strong></li>
                            <li>Pending: <strong>{{ $articles['totals']['pending'] }} {{ $articles['totals']['articles'] > 0 && $articles['totals']['pending'] > 0 ? '('.(100*$articles['totals']['pending']/$articles['totals']['articles']).'%)' : '' }}</strong></li>
                        </ul>
                    </div>
                    <div class="box-footer">
                        <a href="{{ action('AdminController@articles', ['type' => 'pending']) }}" class="btn btn-primary pull-right">Show pending</a>
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
        var ordersGraph = new singleLineGraph();
        ordersGraph.init("Orders",
                "60,141,188",
                "#ordersChart",
                [<?php echo '"'.implode('","', $orders['labels']).'"' ?>],
                [<?php echo '"'.implode('","', $orders['values']).'"' ?>],
                '{{ $orders['period'] }}'
        );

        var questionsGraph = new singleLineGraph();
        questionsGraph.init("Questions",
                "220,130,98",
                "#questionsChart",
                [<?php echo '"'.implode('","', $questions['labels']).'"' ?>],
                [<?php echo '"'.implode('","', $questions['values']).'"' ?>],
                '{{ $questions['period'] }}'
        );

        var ordersTotalsData = [
            {
                value: '{{ $orders['totals']['questions'] }}',
                color: "#f56954",
                highlight: "#f56954",
                label: "Questions"
            },
            {
                value: '{{ $orders['totals']['vouchers'] }}',
                color: "#00a65a",
                highlight: "#00a65a",
                label: "Vouchers"
            },
            {
                value: '{{ $orders['totals']['credits'] }}',
                color: "#f39c12",
                highlight: "#f39c12",
                label: "Credits"
            }
        ];
        var ordersTotalsGraph = new pieGraph();
        ordersTotalsGraph.init(
                "#orderTotalsChart",
                ordersTotalsData
        );

        var answersGraph = new multipleLinesGraph();
        answersGraph.init(
                "#answersChart",
                [<?php echo '"'.implode('","', $answers['labels']).'"' ?>],
                <?php echo json_encode($answers['values']); ?>,
                <?php echo json_encode($answers['totals']); ?>,
                '{{ $answers['period'] }}'
        );

        var usersGraph = new singleLineGraph();
        usersGraph.init("Users",
                "30,200,108",
                "#usersChart",
                [<?php echo '"'.implode('","', $users['labels']).'"' ?>],
                [<?php echo '"'.implode('","', $users['values']).'"' ?>],
                '{{ $users['period'] }}'
        );

        var usersPieData = [
            {
                value: '{{ $users['totals']['facebook'] }}',
                color: "#3B5998",
                highlight: "#3B5998",
                label: "Facebook"
            },
            {
                value: '{{ $users['totals']['google'] }}',
                color: "#DB4437",
                highlight: "#DB4437",
                label: "Google"
            },
            {
                value: '{{ $users['totals']['twitter'] }}',
                color: "#1DA1F2",
                highlight: "#1DA1F2",
                label: "Twitter"
            },
            {
                value: '{{ $users['totals']['local'] }}',
                color: "#D3E312",
                highlight: "#D3E312",
                label: "Local"
            }
        ];
        var usersPieGraph = new pieGraph();
        usersPieGraph.init(
                "#usersPieChart",
                usersPieData
        );

        var articlesGraph = new singleLineGraph();
        articlesGraph.init("Articles",
                "30,200,208",
                "#articlesChart",
                [<?php echo '"'.implode('","', $articles['labels']).'"' ?>],
                [<?php echo '"'.implode('","', $articles['values']).'"' ?>],
                '{{ $articles['period'] }}'
        );
    });
</script>
@endpush