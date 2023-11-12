@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">All Tasks ({{ $tasks->count() }})</h6>
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createTask">Create</button>
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
                                <td>
                                    <button class="btn btn-sm btn-primary me-2 mb-2 position-relative"
                                        style="background-color: rebeccapurple; border-color: rebeccapurple;"
                                        data-bs-toggle="modal" data-bs-target="#taskUsers{{ $task->id }}">
                                        <i class="fa fa-users"></i>

                                        @if ($task->users->count() > 0)
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                                                style="background-color: aquamarine">
                                                @if ($task->users->count() >= 100)
                                                    99+
                                                @else
                                                    {{ $task->users->count() }}
                                                @endif
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                        @endif
                                    </button>
                                    <button class="btn btn-sm btn-warning me-2 mb-2" data-bs-toggle="modal"
                                        data-bs-target="#editTask{{ $task->id }}">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteTask{{ $task->id }}">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Task Modal -->
                            <div class="modal fade" id="editTask{{ $task->id }}" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="editTask{{ $task->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-0">
                                        <div class="modal-header bg-light">
                                            <h4 class="modal-title fs-6" id="editTask{{ $task->id }}Label">Edit Task
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('tasks.update', $task) }}" method="POST">
                                            @csrf

                                            <div class="modal-body bg-light">
                                                <div class="rounded h-100">

                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input type="text" name="title" class="form-control"
                                                            value="{{ $task->title }}" />
                                                    </div>
                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" rows="4" class="form-control description">
                                                            {!! $task->description !!}
                                                        </textarea>
                                                    </div>
                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label for="starts_on" class="form-label">Starts On</label>
                                                        <input type="datetime-local" name="starts_on" class="form-control"
                                                            value="{{ $task->started_on }}" />
                                                    </div>
                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label for="deadline" class="form-label">Deadline</label>
                                                        <input type="datetime-local" name="deadline" class="form-control"
                                                            value="{{ $task->deadline }}" />
                                                    </div>
                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label for="points" class="form-label">Points</label>
                                                        <input type="number" name="points" class="form-control"
                                                            min="1" value="{{ $task->points }}" />
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
                            <div class="modal fade" id="deleteTask{{ $task->id }}" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="deleteTask{{ $task->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-0">
                                        <div class="modal-header bg-light">
                                            <h4 class="modal-title fs-6" id="deleteTask{{ $task->id }}Label">Delete
                                                Task
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
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

                            <!-- Task Users Modal -->
                            <div class="modal fade" id="taskUsers{{ $task->id }}" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="taskUsers{{ $task->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-0">
                                        <div class="modal-header bg-light">
                                            <h4 class="modal-title fs-6" id="taskUsers{{ $task->id }}Label">Staff
                                                that have completed this task
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body bg-light">
                                            @forelse ($task->users as $user)
                                                <div class="card mb-3 border-0">
                                                    <div
                                                        class="card-body d-flex flex-column align-items-start justify-content-start">
                                                        <h6 class="mb-1">{{ $user->name }}</h6>
                                                        <p class="card-text">{{ $user->email }}</p>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>No staff has completed this task</p>
                                            @endforelse
                                        </div>

                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Back</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No task found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Task Modal -->
    <div class="modal fade" id="createTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createTaskLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header bg-light">
                    <h4 class="modal-title fs-6" id="createTaskLabel">Create Task</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="modal-body bg-light">
                        <div class="rounded h-100">

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" rows="4" class="form-control description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="starts_on" class="form-label">Starts On</label>
                                <input type="datetime-local" name="starts_on" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="deadline" class="form-label">Deadline</label>
                                <input type="datetime-local" name="deadline" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="points" class="form-label">Points</label>
                                <input type="number" name="points" class="form-control" min="1"
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
