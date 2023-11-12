@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css"
        integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">All Tasks ({{ $tasks->count() }})</h6>
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Create</button>
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{!! Str::limit($task->description, 35, '...') !!}</td>
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
                                <td class="d-flex flex-wrap" style="gap: 1rem">
                                    <a class="btn btn-sm btn-primary" href="">Detail</a>
                                    <a class="btn btn-sm btn-warning" href="">Edit</a>
                                    <a class="btn btn-sm btn-danger" href="">Remove</a>
                                </td>
                            </tr>
                            @empty
                                <h4 class="text-warning">No task found</h4>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Create Task Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content border-0">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title fs-6" id="staticBackdropLabel">Create Task</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <div class="modal-body bg-light">
                            <div class="rounded h-100">

                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" />
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="starts_on" class="form-label">Starts On</label>
                                    <input type="datetime-local" name="starts_on" class="form-control" id="starts_on" />
                                </div>
                                <div class="mb-3">
                                    <label for="deadline" class="form-label">Deadline</label>
                                    <input type="datetime-local" name="deadline" class="form-control" id="deadline" />
                                </div>
                                <div class="mb-3">
                                    <label for="points" class="form-label">Points</label>
                                    <input type="number" name="points" class="form-control" min="1" id="points"
                                        value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"
            integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $('#description').trumbowyg();
        </script>
    @endsection
