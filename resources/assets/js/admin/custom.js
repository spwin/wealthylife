var singleLineGraph = function(){
    var canvas;
    var chartCanvas;
    var objectChart;
    var labels;
    var values;
    var chartData;
    var period;
    var chartOptions;
    var color;
    return {
        init: function(title, col, c, l, v, p){
            canvas = $(c);
            labels = l;
            values = v;
            period = p;
            color = col;
            this.extendGraph();
            chartCanvas = canvas.get(0).getContext("2d");
            objectChart = new Chart(chartCanvas);
            this.bindData(title);
            this.setOptions();
            this.drawGraph();
        },
        extendGraph: function(){
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

                        // write PERIOD
                        this.chart.ctx.textAlign = 'center';
                        this.chart.ctx.fillText("PERIOD", point.x, scale.startPoint + 12);
                    }
                }
            });
        },
        bindData: function(name){
            chartData = {
                labels: labels,
                datasets: [
                    {
                        label: name,
                        fillColor: "rgba("+color+",0.9)",
                        strokeColor: "rgba("+color+",0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: values
                    }
                ]
            };
        },
        setOptions: function(){
            chartOptions = {
                lineAtIndex: period,
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
        },
        drawGraph: function(){
            objectChart.LineWithLine(chartData, chartOptions);
        }
    }
};

var pieGraph = function(){
    var canvas;
    var data;
    var pieCanvas;
    var pieChart;
    var pieOptions;
    return {
        init: function(c, d){
            canvas = $(c);
            data = d;
            pieCanvas = canvas.get(0).getContext("2d");
            pieChart = new Chart(pieCanvas);
            this.setOptions();
            this.drawGraph();
        },
        setOptions: function(){
            pieOptions = {
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
        },
        drawGraph: function(){
            pieChart.Doughnut(data, pieOptions);
        }
    }
};

var multipleLinesGraph = function(){
    var canvas;
    var chartCanvas;
    var objectChart;
    var labels;
    var values;
    var totals;
    var dataSet = [];
    var chartData;
    var period;
    var chartOptions;
    return {
        init: function(c, l, v, t, p){
            canvas = $(c);
            labels = l;
            values = v;
            totals = t;
            period = p;
            this.extendGraph();
            chartCanvas = canvas.get(0).getContext("2d");
            objectChart = new Chart(chartCanvas);
            this.createDataSet();
            this.setOptions();
            this.drawGraph();
        },
        createDataSet: function(){
            for (var i = 0, len = Object.keys(values).length; i < len; i++) {
                dataSet.push(
                    {
                        label: totals[Object.keys(totals)[i]].name,
                        fillColor: totals[Object.keys(totals)[i]].color+",0.6)",
                        strokeColor: totals[Object.keys(totals)[i]].color+",0.3)",
                        pointColor: totals[Object.keys(totals)[i]].color.replace('a','')+")",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: values[Object.keys(values)[i]]
                    }
                );
            }
            chartData = {
                labels: labels,
                datasets: dataSet
            };
        },
        extendGraph: function(){
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

                        // write PERIOD
                        this.chart.ctx.textAlign = 'center';
                        this.chart.ctx.fillText("PERIOD", point.x, scale.startPoint + 12);
                    }
                }
            });
        },
        setOptions: function(){
            chartOptions = {
                lineAtIndex: period,
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
                datasetFill: true,
                multiTooltipTemplate: "<%= datasetLabel %>: <%= value %>"
            };
        },
        drawGraph: function(){
            objectChart.LineWithLine(chartData, chartOptions);
        }
    }
};