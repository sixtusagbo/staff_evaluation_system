@extends('layouts.auth')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="index.html" class="">
            <h3 class="text-primary"><i class="fa fa-school me-2"></i>SES</h3>
        </a>
        <h3>Sign Up</h3>
    </div>

    <form action="{{ route('register') }}" method="post">
        @csrf

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingText"
                placeholder="jhondoe" name="name" value="{{ old('name') }}" required autocomplete="name">

            <label for="floatingText">Name</label>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                placeholder="name@example.com" name="email" value="{{ old('email') }}" required autocomplete="email">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-4">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword"
                placeholder="Password" name="password" required autocomplete="new-password">
            <label for="floatingPassword">Password</label>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-floating mb-4">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword"
                placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">

            <label for="password-confirm">Confirm Password</label>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
        <p class="text-center mb-0">Already have an Account? <a href="{{ route('login') }}">Sign In</a></p>
    </form>
@endsection
