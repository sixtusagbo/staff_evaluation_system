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
@endsection
