@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fa fa-user fa-3x text-primary"></i>
                        <p class="mb-2 ms-3">Staff</p>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ $users->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fa fa-list-ul fa-3x text-primary"></i>
                        <p class="mb-2 ms-3">Leaves</p>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ $leaves->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fa fa-tasks fa-3x text-primary"></i>
                        <p class="mb-2 ms-3">Tasks</p>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ $tasks->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-snowboarding fa-3x text-primary"></i>
                        <p class="mb-2 ms-3">Leaves (Pending Approval)</p>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ $pending_leaves->count() }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graph of user against tasks -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Staff Performance</h6>
                <a href="{{ route('tasks.index') }}">All Tasks</a>
            </div>

            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.js"
        integrity="sha512-6HrPqAvK+lZElIZ4mZ64fyxIBTsaX5zAFZg2V/2WT+iKPrFzTzvx6QAsLW2OaLwobhMYBog/+bvmIEEGXi0p1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chart_labels),
                datasets: [{
                    label: 'Number of tasks done',
                    data: @json($chart_data),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
