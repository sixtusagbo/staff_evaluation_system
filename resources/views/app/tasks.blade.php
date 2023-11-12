@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Current Tasks (5)</h6>
                    </div>
                    <div class="d-flex flex-column align-items-start justify-content-start border-bottom py-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">Task Title</h6>
                            <button class="btn btn-secondary">Done</button>
                        </div>
                        <div>Short description goes here...</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Upcoming Tasks (4)</h6>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Task Title</h6>
                                <small>Ends in 15 minutes</small>
                            </div>
                            <span>Short description goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Task Title</h6>
                                <small>Ends in 15 minutes</small>
                            </div>
                            <span>Short description goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Task Title</h6>
                                <small>Ends in 15 minutes</small>
                            </div>
                            <span>Short description goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Task Title</h6>
                                <small>Ends in 15 minutes</small>
                            </div>
                            <span>Short description goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Task Title</h6>
                                <small>Ends in 15 minutes</small>
                            </div>
                            <span>Short description goes here...</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



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
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                                <a class="btn btn-sm btn-warning" href="">Edit</a>
                                <a class="btn btn-sm btn-danger" href="">Remove</a>
                            </td>
                        </tr>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                                <a class="btn btn-sm btn-warning" href="">Edit</a>
                                <a class="btn btn-sm btn-danger" href="">Remove</a>
                            </td>
                        </tr>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                                <a class="btn btn-sm btn-warning" href="">Edit</a>
                                <a class="btn btn-sm btn-danger" href="">Remove</a>
                            </td>
                        </tr>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                                <a class="btn btn-sm btn-warning" href="">Edit</a>
                                <a class="btn btn-sm btn-danger" href="">Remove</a>
                            </td>
                        </tr>
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
