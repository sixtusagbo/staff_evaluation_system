@extends('layouts.auth')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="index.html" class="">
            <h3 class="text-primary"><i class="fa fa-school me-2"></i>SES</h3>
        </a>
        <h3>Reset Password</h3>
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                placeholder="name@example.com" name="email" value="{{ old('email') }}" required autocomplete="email">

            <label for="floatingInput">Email address</label>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Send Password Reset Link</button>
    </form>
@endsection
