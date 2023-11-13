@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">All Leaves ({{ $leaves->count() }})</h6>
                <a class="btn btn-dark" href="{{ route('leaves.create') }}">Apply</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Title</th>
                            <th scope="col">Starts On</th>
                            <th scope="col">Ends By</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->title }}</td>
                                <td>{{ $leave->start_date->format('M d, Y') }}</td>
                                <td>{{ $leave->end_date->format('M d, Y') }}</td>
                                <td>{!! Str::limit($leave->reason, 50, '...') !!}</td>
                                <td>
                                    {{-- ? 0: Pending, 1: Approved, 2: Declined --}}
                                    @switch($leave->status)
                                        @case(0)
                                            <span class="badge rounded-pill bg-warning">Pending</span>
                                        @break

                                        @case(1)
                                            <span class="badge rounded-pill bg-success">Approved</span>
                                        @break

                                        @case(2)
                                            <span class="badge rounded-pill bg-dark">Declined</span>
                                        @break
                                    @endswitch
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No leave found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
