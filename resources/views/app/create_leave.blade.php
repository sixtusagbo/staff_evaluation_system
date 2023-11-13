@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0">Apply for leave</h5>
            </div>

            <form action="{{ route('leaves.store') }}" method="POST">
                @csrf

                <div class="rounded h-100">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" />
                    </div>
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <textarea name="reason" rows="6" class="form-control reason">
                          {{ old('reason') }}
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Starts On</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" />
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Ends By</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" />
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success py-2"
                        style="max-width: 300px;width: 100%">Continue</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('lib/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '.reason',
            menubar: 'edit view insert format', // remove 'file' from this list
            toolbar_mode: 'floating',
            width: '100%',
        });
    </script>
@endsection
