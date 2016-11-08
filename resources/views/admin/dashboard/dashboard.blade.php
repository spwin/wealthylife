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
                        <h3 class="box-pie-title"></h3>
                    </div>
                    <div class="box-body">

                    </div>
                    <div class="box-footer">

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
        Chart.types.Line.extend({
            name: "LineWithLine",
            draw: function () {
                Chart.types.Line.prototype.draw.apply(this, arguments);
                if(this.options.lineAtIndex) {
                    var point = this.datasets[0].points[this.options.lineAtIndex];
                    var scale = this.scale;

                    // draw line
                    this.chart.ctx.beginPath();
                    this.chart.ctx.moveTo(point.x, scale.startPoint + 24);
                    this.chart.ctx.strokeStyle = '#ff0000';
                    this.chart.ctx.lineTo(point.x, scale.endPoint);
                    this.chart.ctx.stroke();

                    // write TODAY
                    this.chart.ctx.textAlign = 'center';
                    this.chart.ctx.fillText("PERIOD", point.x, scale.startPoint + 12);
                }
            }
        });


        /******************
         ORDERS LINE CHART
         *****************/


        // Get context with jQuery - using jQuery's .get() method.
        var ordersChartCanvas = $("#ordersChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var ordersChart = new Chart(ordersChartCanvas);

        var labels = [<?php echo '"'.implode('","', $orders['labels']).'"' ?>];
        var values = [<?php echo '"'.implode('","', $orders['values']).'"' ?>];

        var ordersChartData = {
            labels: labels,
            datasets: [
                {
                    label: "Orders",
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

        var ordersChartOptions = {
            lineAtIndex: '{{ $orders['period'] }}',
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
        ordersChart.LineWithLine(ordersChartData, ordersChartOptions);

        /******************
         PIE ORDERS GRAPH
         *****************/

        var ordersTotalsCanvas = $("#orderTotalsChart").get(0).getContext("2d");
        var ordersTotalsChart = new Chart(ordersTotalsCanvas);
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
        var ordersTotalsOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: "#fff",
            //Number - The width of each segment stroke
            segmentStrokeWidth: 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 40, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 100,
            //String - Animation easing effect
            animationEasing: "easeOutBounce",
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: false
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        ordersTotalsChart.Doughnut(ordersTotalsData, ordersTotalsOptions);
    });


    /******************
     ANSWERS LINE CHART
     *****************/

    Chart.types.Line.extend({
        name: "LineWithLine",
        draw: function () {
            Chart.types.Line.prototype.draw.apply(this, arguments);
            if(this.options.lineAtIndex) {
                var point = this.datasets[0].points[this.options.lineAtIndex];
                var scale = this.scale;

                // draw line
                this.chart.ctx.beginPath();
                this.chart.ctx.moveTo(point.x, scale.startPoint + 24);
                this.chart.ctx.strokeStyle = '#ff0000';
                this.chart.ctx.lineTo(point.x, scale.endPoint);
                this.chart.ctx.stroke();

                // write TODAY
                this.chart.ctx.textAlign = 'center';
                this.chart.ctx.fillText("PERIOD", point.x, scale.startPoint + 12);
            }
        }
    });

    // Get context with jQuery - using jQuery's .get() method.
    var answersChartCanvas = $("#answersChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var answersChart = new Chart(answersChartCanvas);

    var labels = [<?php echo '"'.implode('","', $answers['labels']).'"' ?>];
    var values = <?php echo json_encode($answers['values']); ?>;
    var totals = <?php echo json_encode($answers['totals']); ?>;

    var dataSet = [];
    for (var i = 0, len = Object.keys(values).length; i < len; i++) {
        dataSet.push(
            {
                label: totals[Object.keys(totals)[i]].email,
                fillColor: totals[Object.keys(totals)[i]].color+",0.6)",
                strokeColor: totals[Object.keys(totals)[i]].color+",0.3)",
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: values[Object.keys(values)[i]]
            }
        );
    }
    var answersChartData = {
        labels: labels,
        datasets: dataSet
    };

    var answersChartOptions = {
        lineAtIndex: '{{ $orders['period'] }}',
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
    answersChart.LineWithLine(answersChartData, answersChartOptions);
</script>
@endpush