@extends('adminlte::page')
@section('title', 'Estadísticas')
@section('css')

@stop

@section('content_header')
    <!-- <h1>Página de inicio</h1> -->
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <!-- DONUT CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Total de tickets asignados por cada usuario</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="donutChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- LINE CHART -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Total de tickets por mes</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="lineChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col">
                    <!-- BAR CHART -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Total de tickets por cada mes según estado</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col (RIGHT) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
@section('js')
    @parent
    <script>
        $(document).ready(function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */
            //-------------
            //- LINE CHART -
            //--------------
            var lineData = @json($lineData);
            var months = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            for (let i = 0; i < lineData.length; i++) {
                months[lineData[i]['month'] - 1] = lineData[i]['count'];
            }
            var lineChartData = {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                    'Octubre', 'Noviembre', 'Diciembre'
                ],
                datasets: [{
                    label: 'Cantidad de tickets',
                    tension: 0.1,
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: months
                }]
            }
            var lineChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                }
            }


            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, lineChartOptions)
            var lineChartData = $.extend(true, {}, lineChartData)
            lineChartData.datasets[0].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            })

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutData = @json($donutData);
            var users = @json($users);
            var names = ['Sin asignar'];
            var colors = ["#" + Math.floor(Math.random() * 16777215).toString(16)];
            var count = [
                [0, 0]
            ];
            users.forEach(element => {
                names.push(element['name']);
                colors.push("#" + Math.floor(Math.random() * 16777215).toString(16));
                count.push([element['id'], 0]);
            });
            donutData.forEach(data => {
                var userId = data['user_id'];
                var dataCount = data['count'];

                if (userId == null) {
                    count[0][1] = dataCount;
                } else {
                    count.forEach(element => {
                        if (element[0] == userId) {
                            element[1] = dataCount;
                        }
                    });
                }
            });
            var showCount = count.map(element => element[1]);

            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: names,
                datasets: [{
                    data: showCount,
                    backgroundColor: colors,
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })
            //-------------
            //- BAR CHART -
            //-------------
            var barData = @json($barData);
            var states = {
                1: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                2: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                3: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            };
            for (let i = 0; i < barData.length; i++) {
                states[barData[i]['state_id']][barData[i]['month'] - 1] = barData[i]['count'];
            }
            var barChartData = {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                    'Octubre', 'Noviembre', 'Diciembre'
                ],
                datasets: [{
                        label: 'Abierto',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: states[1]
                    },
                    {
                        label: 'Asignado a especialista',
                        backgroundColor: 'rgba(216, 128, 222, 1)',
                        borderColor: 'rgba(216, 128, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(216, 128, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: states[2]
                    },
                    {
                        label: 'Cerrado',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: states[3]
                    },
                ]
            }
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, barChartData)

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

        });
    </script>
@stop
