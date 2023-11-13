@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Current Tasks ({{ $ongoing_tasks->count() }})</h6>
                    </div>

                    @forelse ($ongoing_tasks as $task)
                        <div class="d-flex flex-column align-items-start justify-content-start border-bottom py-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">{{ $task->title }}</h6>

                                <form action="{{ route('tasks.done', $task) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-secondary" type="submit">Done</button>

                                    @method('PUT')
                                </form>
                            </div>
                            <div style="text-align: left">
                                {!! $task->description !!}
                            </div>
                        </div>
                    @empty
                        <p class="text-dark">No tasks for now. Enjoy the silence.</p>
                    @endforelse
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Upcoming Tasks ({{ $upcoming_tasks->count() }})</h6>
                    </div>

                    @forelse ($upcoming_tasks as $task)
                        <div class="d-flex align-items-center border-bottom py-3">
                            <div class="w-100">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">{{ $task->title }}</h6>
                                    <small>Starts {{ $task->started_on->diffForHumans() }}</small>
                                </div>
                                <span>{{ $task->description }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-dark">No tasks for now. Enjoy the silence.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>



    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Tasks You Have Completed ({{ $user->tasks->count() }})</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Started On</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Status</th>
                            <th scope="col">Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($your_tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{!! Str::limit($task->description, 50, '...') !!}</td>
                                <td>{{ $task->started_on->toDayDateTimeString() }}</td>
                                <td>{{ $task->deadline->toDayDateTimeString() }}</td>
                                <td>
                                    {{-- ? 0 - Upcoming, 1- Ongoing, 2 - Elapsed --}}
                                    @switch($task->status)
                                        @case(0)
                                            <span class="badge rounded-pill bg-info">Upcoming</span>
                                        @break

                                        @case(1)
                                            <span class="badge rounded-pill bg-dark">Ongoing</span>
                                        @break

                                        @case(2)
                                            <span class="badge rounded-pill bg-secondary">Elapsed</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>{{ $task->points }}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No tasks completed yet.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
