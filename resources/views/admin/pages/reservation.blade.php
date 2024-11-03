@extends('admin.layouts.admin')

@section('title', 'Reservation Data')

@section('content')

    <div class="container-fluid">
        <div class="row">

            <!-- Right Side - Donut Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="reservationPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Left Side - 2*2 Grid Cards -->
            <div class="col-xl-8 col-lg-7">
                <div class="card-header shadow py-3 mb-3 mt-2" style="background-color: white; height: 50px; text-align: center; border-radius: 10px">
                    <h6 class="m-0 font-weight-bold text-primary">Rezervasiya statusu</h6>
                </div>

                <div class="row">
                    <!-- Total Reservations Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Ümumi rezervasiyalar</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ App\Models\Reservation::count() }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Reservations Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Gözləmədə olan rezervasiyalar</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ App\Models\Reservation::where('status', 'pending')->count() }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-hourglass-start fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Accepted Reservations Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Qəbul edilən rezervasiyalar</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ App\Models\Reservation::where('status', 'accepted')->count() }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rejected Reservations Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Qəbul edilməyən rezervasiyalar</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ App\Models\Reservation::where('status', 'rejected')->count() }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-times fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Include Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            var pendingCount = {{ App\Models\Reservation::where('status', 'pending')->count() }};
            var acceptedCount = {{ App\Models\Reservation::where('status', 'accepted')->count() }};
            var rejectedCount = {{ App\Models\Reservation::where('status', 'rejected')->count() }};

            var ctx = document.getElementById('reservationPieChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Gözləmədə', 'Qəbul edilmiş', 'Qəbul edilməmiş'],
                    datasets: [{
                        data: [pendingCount, acceptedCount, rejectedCount],
                        backgroundColor: ['#f6c23e', '#1cc88a', '#e74a3b'],
                        hoverBackgroundColor: ['#f4b619', '#17a673', '#d92e2e'],
                        borderWidth: 1,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: true,
                    },
                    cutoutPercentage: 80,
                },
            });
        </script>

        @include('admin.pages.reservation_table')

        <div class="container-fluid">

        <!-- Content Row -->
            <div class="row">
                <div class="col-12">

                    <!-- Annual Reservation Count Area Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">İllik Rezervasiya Sayı</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="annualReservationChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Reservation Bar Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Aylıq Rezervasiya Sayı</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-bar">
                                <canvas id="monthlyReservationBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                var monthlyReservations = [
                    {{ App\Models\Reservation::whereYear('created_at', now()->year)->whereMonth('created_at', 1)->count() }},
                    {{ App\Models\Reservation::whereYear('created_at', now()->year)->whereMonth('created_at', 2)->count() }},
                    {{ App\Models\Reservation::whereYear('created_at', now()->year)->whereMonth('created_at', 3)->count() }},
                    {{ App\Models\Reservation::whereYear('created_at', now()->year)->whereMonth('created_at', 4)->count() }},
                    {{ App\Models\Reservation::whereYear('created_at', now()->year)->whereMonth('created_at', 5)->count() }},
                    {{ App\Models\Reservation::whereYear('created_at', now()->year)->whereMonth('created_at', 6)->count() }},
                    {{ App\Models\Reservation::whereYear('created_at', now()->year)->whereMonth('created_at', 7)->count() }},
                    {{ App\Models\Reservation::whereYear('created_at', now()->year)->whereMonth('created_at', 8)->count() }},
                    {{ App\Models\Reservation::whereYear('created_at', now()->year)->whereMonth('created_at', 9)->count() }},
                    {{ App\Models\Reservation::whereYear('created_at', now()->year)->whereMonth('created_at', 10)->count() }},
                    {{ App\Models\Reservation::whereYear('created_at', now()->year)->whereMonth('created_at', 11)->count() }},
                    {{ App\Models\Reservation::whereYear('created_at', now()->year)->whereMonth('created_at', 12)->count() }}
                ];

                var ctx = document.getElementById("annualReservationChart").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["Yanvar", "Fevral", "Mart", "Aprel", "May", "İyun", "İyul", "Avqust", "Sentyabr", "Oktyabr", "Noyabr", "Dekabr"],
                        datasets: [{
                            label: "Rezervasiyalar",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: monthlyReservations,
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'month'
                                },
                                gridLines: {
                                    display: false
                                },
                                ticks: {
                                    maxTicksLimit: 12
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    maxTicksLimit: 5,
                                    padding: 10,
                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        }
                    }
                });

                var ctxBar = document.getElementById("monthlyReservationBarChart").getContext('2d');
                var myBarChart = new Chart(ctxBar, {
                    type: 'bar',
                    data: {
                        labels: ["Yanvar", "Fevral", "Mart", "Aprel", "May", "İyun", "İyul", "Avqust", "Sentyabr", "Oktyabr", "Noyabr", "Dekabr"],
                        datasets: [{
                            label: "Rezervasiyalar",
                            backgroundColor: "#4e73df",
                            hoverBackgroundColor: "#2e59d9",
                            borderColor: "#4e73df",
                            data: monthlyReservations,
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'month'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 12
                                },
                                maxBarThickness: 25,
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: 1,
                                    callback: function(value) { if (Number.isInteger(value)) { return value; } },
                                    padding: 10,
                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                    }
                });
            </script>
@endsection
