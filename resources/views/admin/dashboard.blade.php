@extends('admin.layouts.dashboard')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Quốc gia</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$countries->count()}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-planet"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Khách sạn</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$hotels->count()}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="ni ni-shop"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Người dùng</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$guests->count()}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-single-02"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Đơn đặt phòng</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$bookings->count()}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="ni ni-collection"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-8">
                <div class="card bg-default">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="h3 text-white mb-0">Tổng doanh thu</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart_total_price" class="chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="h3 mb-0">Tổng đơn đặt phòng</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart_booking_total" class="chart">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(dawChartBookingTotal);
        google.charts.setOnLoadCallback(dawChartTotalPrice);

        function dawChartBookingTotal() {
            var booking_total = <?php echo $booking_total ?>;
            var data = google.visualization.arrayToDataTable(booking_total);
            var options = {
                    chart: {
                        is3D: false,
                    },
                    'hAxis': {
                        'title': 'Tháng',
                    },
                    'vAxis': {
                        'title': 'Đơn đặt phòng'
                    },
                    'bars': 'horizontal',
                }
            ;

            var chart = new google.visualization.LineChart(document.getElementById('chart_booking_total'));

            chart.draw(data, options);
        }

        function dawChartTotalPrice() {
            var total_price = <?php echo $total_price ?>;
            var data = google.visualization.arrayToDataTable(total_price);
            var options = {
                    chart: {
                        is3D: false,
                    },
                    'hAxis': {
                        'title': 'Tháng',
                    },
                    'vAxis': {
                        'title': 'Doanh thu'
                    },
                    'bars': 'horizontal',
                }
            ;

            var chart = new google.visualization.LineChart(document.getElementById('chart_total_price'));

            chart.draw(data, options);
        }
    </script>
@endsection