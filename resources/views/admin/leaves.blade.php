@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">All Leaves ({{ $leaves->count() }})</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Staff</th>
                            <th scope="col">Title</th>
                            <th scope="col">Starts On</th>
                            <th scope="col">Ends By</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->user->name }}</td>
                                <td>{{ $leave->title }}</td>
                                <td>{{ $leave->start_date->format('M d, Y') }}</td>
                                <td>{{ $leave->end_date->format('M d, Y') }}</td>
                                <td>{!! Str::limit($leave->reason, 50, '...') !!}</td>
                                <td>
                                    {{-- ? 0: Pending, 1: Approved, 2: Rejected --}}
                                    @switch($leave->status)
                                        @case(0)
                                            <span class="badge rounded-pill bg-warning">Pending</span>
                                        @break

                                        @case(1)
                                            <span class="badge rounded-pill bg-success">Approved</span>
                                        @break

                                        @case(2)
                                            <span class="badge rounded-pill bg-dark">Rejected</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-2 mb-2" data-bs-toggle="modal"
                                        data-bs-target="#editLeave{{ $leave->id }}" title="View">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteTask{{ $leave->id }}" title="Remove">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Leave Modal -->
                            <div class="modal fade" id="editTask{{ $leave->id }}" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="editTask{{ $leave->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-0">
                                        <div class="modal-header bg-light">
                                            <h4 class="modal-title fs-6" id="editTask{{ $leave->id }}Label">Edit Leave
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('tasks.update', $leave) }}" method="POST">
                                            @csrf

                                            <div class="modal-body bg-light">
                                                <div class="rounded h-100">

                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input type="text" name="title" class="form-control"
                                                            value="{{ $leave->title }}" />
                                                    </div>
                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" rows="4" class="form-control description">
                                                            {!! $leave->description !!}
                                                        </textarea>
                                                    </div>
                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label for="starts_on" class="form-label">Starts On</label>
                                                        <input type="datetime-local" name="starts_on" class="form-control"
                                                            value="{{ $leave->started_on }}" />
                                                    </div>
                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label for="deadline" class="form-label">Deadline</label>
                                                        <input type="datetime-local" name="deadline" class="form-control"
                                                            value="{{ $leave->deadline }}" />
                                                    </div>
                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label for="points" class="form-label">Points</label>
                                                        <input type="number" name="points" class="form-control"
                                                            min="1" value="{{ $leave->points }}" />
                                                    </div>
                                                </div>
                                                @method('PUT')
                                            </div>

                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Task Modal -->
                            <div class="modal fade" id="deleteTask{{ $leave->id }}" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="deleteTask{{ $leave->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-0">
                                        <div class="modal-header bg-light">
                                            <h4 class="modal-title fs-6" id="deleteTask{{ $leave->id }}Label">Delete
                                                Task
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('tasks.destroy', $leave) }}" method="POST">
                                            @csrf

                                            <div class="modal-body bg-light">
                                                <div class="rounded h-100">
                                                    Attention! You are about to delete this task. This action cannot be
                                                    undone.
                                                </div>
                                                @method('DELETE')
                                            </div>

                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Continue</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No leave found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('lib/tinymce/tinymce.min.js') }}"></script>
        <script>
            tinymce.init({
                selector: '.description',
                menubar: 'edit view insert format', // remove 'file' from this list
                toolbar_mode: 'floating',
                width: '100%',
            });
        </script>
    @endsection
