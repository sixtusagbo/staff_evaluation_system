@extends('layouts.app')

@section('styles')
    <style>
        .attendance-banner {
            max-width: 400px !important;
        }
    </style>
@endsection

@section('content')
    @if (!$user->checked_in_today)
        <div class="container-fluid pt-4 px-4 attendance-banner">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Attendance</h6>
                </div>

                <form action="{{ route('attendances.store') }}" method="post">
                    @csrf

                    <button class="btn btn-success">Check in for today</button>
                </form>
            </div>
        </div>
    @endif

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fa fa-signature fa-3x text-primary"></i>
                        <p class="mb-2 ms-3">Checked In</p>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ $user->attendances->count() }} days</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fa fa-list-ul fa-3x text-primary"></i>
                        <p class="mb-2 ms-3">Pending Tasks</p>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">34</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fa fa-tasks fa-3x text-primary"></i>
                        <p class="mb-2 ms-3">Completed Tasks</p>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">12</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-snowboarding fa-3x text-primary"></i>
                        <p class="mb-2 ms-3">Leave</p>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">2</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
