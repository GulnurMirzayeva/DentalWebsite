@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Content Row -->
        <div class="row">

            <!-- Total Reservations Card -->
            <div class="col-xl-3 col-md-6 mb-4">
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
            <div class="col-xl-3 col-md-6 mb-4">
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
            <div class="col-xl-3 col-md-6 mb-4">
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
            <div class="col-xl-3 col-md-6 mb-4">
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

        @include('admin.pages.reservation_table')
@endsection
