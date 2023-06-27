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
                    <!-- BAR CHART -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">5 categorías más reportadas en el último mes</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barOutChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- LINE CHART -->
                    <div class="card">
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
                    <!-- DONUT CHART -->
                    <div class="card">
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
                    <!-- BAR CHART -->
                    <div class="card">
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
            // Función para generar un color aleatorio en formato hexadecimal
            function getRandomColor() {
                return "#" + Math.floor(Math.random() * 16777215).toString(16);
            }

            // Función para obtener el valor de un campo específico de cada elemento en un array
            function getFieldValues(array, field) {
                return array.map(element => element[field]);
            }

            // LINE CHART
            var lineData = @json($lineData);
            var months = Array(12).fill(0); // Array inicializado con ceros
            lineData.forEach(data => {
                months[data['month'] - 1] = data['count'];
            });
            var lineChartLabels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ];
            var lineChartData = {
                labels: lineChartLabels,
                datasets: [{
                    label: 'Cantidad de tickets',
                    tension: 0.1,
                    backgroundColor: 'rgba(60,141,188,0.1)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: months
                }]
            };
            var lineChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                }
            };
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
            new Chart(lineChartCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            });

            // DONUT CHART
            var donutData = @json($donutData);
            var users = @json($users);
            var names = ['Sin asignar'];
            var colors = [getRandomColor()];
            var count = [
                [0, 0]
            ];
            users.forEach(element => {
                names.push(element['name']);
                colors.push(getRandomColor());
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
            var showCount = getFieldValues(count, 1);
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
            var donutData = {
                labels: names,
                datasets: [{
                    data: showCount,
                    backgroundColor: colors,
                }]
            };
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            });

            // BAR CHART
            var barData = @json($barData);
            var states = {
                1: Array(12).fill(0),
                2: Array(12).fill(0),
                3: Array(12).fill(0)
            };
            barData.forEach(data => {
                states[data['state_id']][data['month'] - 1] = data['count'];
            });
            var colorD1 = getRandomColor();
            var colorD2 = getRandomColor();
            var colorD3 = getRandomColor();
            var barChartLabels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ];
            var barChartData = {
                labels: barChartLabels,
                datasets: [{
                        label: 'Abierto',
                        backgroundColor: colorD1,
                        borderColor: colorD1,
                        pointRadius: false,
                        pointColor: colorD1,
                        pointStrokeColor: colorD1,
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: colorD1,
                        data: states[1]
                    },
                    {
                        label: 'Asignado a especialista',
                        backgroundColor: colorD2,
                        borderColor: colorD2,
                        pointRadius: false,
                        pointColor: colorD2,
                        pointStrokeColor: colorD2,
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: colorD2,
                        data: states[2]
                    },
                    {
                        label: 'Cerrado',
                        backgroundColor: colorD3,
                        borderColor: colorD3,
                        pointRadius: false,
                        pointColor: colorD3,
                        pointStrokeColor: colorD3,
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: colorD3,
                        data: states[3]
                    }
                ]
            };
            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            };
            var barChartCanvas = $('#barChart').get(0).getContext('2d');
            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            });

            // BAR HORIZONTAL CHART

            var barHorizontalData = @json($barHorizontalData);
            console.log(barHorizontalData);
            var barNames = barHorizontalData.map(item => item.name);
            var barCounts = barHorizontalData.map(item => item.count);
            var colorD1 = getRandomColor();
            var colorD2 = getRandomColor();
            var colorD3 = getRandomColor();
            var colorD4 = getRandomColor();
            var colorD5 = getRandomColor();
            var barChartLabels = barNames;
            var barChartData = {
                labels: barChartLabels,
                datasets: [{
                        label: 'Cantidad reportada',
                        backgroundColor: colorD1,
                        pointRadius: false,
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: colorD1,
                        data: barCounts
                    },
                ]
            };
            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                legend: {
                    display: false
                }
            };
            var barChartCanvas = $('#barOutChart').get(0).getContext('2d');
            new Chart(barChartCanvas, {
                type: 'horizontalBar',
                data: barChartData,
                options: barChartOptions
            });
        });
    </script>
@stop
