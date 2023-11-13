@extends('layouts.app')

@section('styles')
    <style>
        .attendance-banner {
            max-width: 400px !important;
        }

        /* Timeline holder */
        ul.timeline {
            list-style-type: none;
            position: relative;
            padding-left: 1.5rem;
        }

        /* Timeline vertical line */
        ul.timeline:before {
            content: ' ';
            background: lightgreen;
            display: inline-block;
            position: absolute;
            left: 16px;
            width: 4px;
            height: 100%;
            z-index: 400;
            border-radius: 1rem;
        }

        li.timeline-item {
            margin: 20px 0;
        }

        /* Timeline item circle marker */
        li.timeline-item::before {
            content: ' ';
            background: #2bff00;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #fff;
            left: 11px;
            width: 14px;
            height: 14px;
            z-index: 400;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
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
                        <h6 class="mb-0">
                            @if ($user->attendances->count() == 0)
                                {{ __('0') }}
                            @else
                                {{ $user->attendances->count() }} {{ $user->attendances->count() == 1 ? 'day' : 'days' }}
                            @endif
                        </h6>
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

    <!-- Widgets Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Recent Tasks</h6>
                        <a href="{{ route('tasks.index') }}">Show All</a>
                    </div>

                    @forelse ($tasks as $task)
                        <div class="d-flex align-items-center border-bottom py-3">
                            <div class="w-100">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">{{ $task->title }}</h6>
                                    <small class="text-dark">Ends {{ $task->deadline->diffForHumans() }}</small>
                                </div>
                                <span>{{ Str::limit($task->description, 20, '...') }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="lead">No tasks for now. Enjoy the silence.</p>
                    @endforelse
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Attendances (Last 10)</h6>
                    </div>
                    <!-- Attendance Timeline -->
                    <ul class="timeline">
                        @forelse ($attendances as $attendance)
                            <li class="timeline-item rounded p-2">
                                <h6 class="h6 mb-0">{{ $attendance->checked_in_at->format('D, jS M Y b\y h:i A') }}</h6>
                            </li>
                        @empty
                            <div class="text-dark">
                                There are currently no attendance records for you.
                            </div>
                        @endforelse
                    </ul><!-- Attendance End -->
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Recent Leaves</h6>
                        <a href="">Show All</a>
                    </div>

                    @forelse ($leaves as $leave)
                        <div class="d-flex align-items-center border-bottom py-3">
                            <div class="w-100">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0"><span class="badge rounded-pill bg-warning">Pending Review</span>
                                        SICK LEAVE</h6>
                                </div>
                                <span>From <span class="fw-bold">Foo Date</span> to <span class="fw-bold">Bar
                                        Date</span></span>
                            </div>
                        </div>
                    @empty
                        <p class="text-dark">No leaves yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- Widgets End -->
@endsection
