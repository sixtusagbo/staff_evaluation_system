@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">All Staff ({{ $users->count() }})</h6>
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createUser">Create</button>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Joined On</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->toDayDateTimeString() }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-2 mb-2 position-relative"
                                        style="background-color: rebeccapurple; border-color: rebeccapurple;"
                                        data-bs-toggle="modal" data-bs-target="#userTasks{{ $user->id }}">
                                        <i class="fa fa-tasks"></i>

                                        @if ($user->tasks->count() > 0)
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                                                style="background-color: #d07fff">
                                                @if ($user->tasks->count() >= 100)
                                                    99+
                                                @else
                                                    {{ $user->tasks->count() }}
                                                @endif
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                        @endif
                                    </button>
                                    <button class="btn btn-sm btn-primary me-2 mb-2 position-relative"
                                        style="background-color: #5fd873; border-color: #5fd873;" data-bs-toggle="modal"
                                        data-bs-target="#userAttendances{{ $user->id }}">
                                        <i class="fa fa-signature"></i>

                                        @if ($user->attendances->count() > 0)
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                                                style="background-color: #d07fff">
                                                @if ($user->attendances->count() >= 100)
                                                    99+
                                                @else
                                                    {{ $user->attendances->count() }}
                                                @endif
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                        @endif
                                    </button>
                                    <button class="btn btn-sm btn-warning me-2 mb-2" data-bs-toggle="modal"
                                        data-bs-target="#editUser{{ $user->id }}">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteUser{{ $user->id }}">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit User Modal -->
                            <div class="modal fade" id="editUser{{ $user->id }}" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="editUser{{ $user->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-0">
                                        <div class="modal-header bg-light">
                                            <h4 class="modal-title fs-6" id="editUser{{ $user->id }}Label">Edit User
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('staff.update', $user) }}" method="POST">
                                            @csrf

                                            <div class="modal-body bg-light">
                                                <div class="rounded h-100">
                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $user->name }}" />
                                                    </div>
                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label for="email" class="form-label">Email Address</label>
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{ $user->email }}" />
                                                    </div>
                                                    <div class="mb-3 d-flex flex-column align-items-start">
                                                        <label for="type" class="form-label">Type</label>
                                                        <select name="type" class="form-select">
                                                            <option value="0"
                                                                {{ $user->type == 0 ? 'selected' : '' }}>
                                                                Staff</option>
                                                            <option value="1"
                                                                {{ $user->type == 1 ? 'selected' : '' }}>
                                                                Admin</option>
                                                        </select>
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

                            <!-- Delete User Modal -->
                            <div class="modal fade" id="deleteUser{{ $user->id }}" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="deleteUser{{ $user->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-0">
                                        <div class="modal-header bg-light">
                                            <h4 class="modal-title fs-6" id="deleteUser{{ $user->id }}Label">Delete
                                                {{ $user->name }} </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('staff.destroy', $user) }}" method="POST">
                                            @csrf

                                            <div class="modal-body bg-light">
                                                <div class="rounded h-100">
                                                    Attention! You are about to delete this user. This action cannot be
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

                            <!-- User Tasks Modal -->
                            <div class="modal fade" id="userTasks{{ $user->id }}" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="userTasks{{ $user->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-0">
                                        <div class="modal-header bg-light">
                                            <h4 class="modal-title fs-6" id="userTasks{{ $user->id }}Label">Tasks
                                                that {{ $user->name }} has completed
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body bg-light">
                                            @forelse ($user->tasks as $task)
                                                <div class="card mb-3 border-0">
                                                    <div
                                                        class="card-body d-flex flex-column align-items-start justify-content-start">
                                                        <h6 class="mb-1">{{ $task->title }}</h6>
                                                        <p class="card-text">{{ $task->description }}</p>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>This staff has completed no task</p>
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
                                <td colspan="4" class="text-center">No user found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="createUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header bg-light">
                    <h4 class="modal-title fs-6" id="createUserLabel">Create Staff</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('staff.store') }}" method="POST">
                    @csrf

                    <div class="modal-body bg-light">
                        <div class="rounded h-100">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" />
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
