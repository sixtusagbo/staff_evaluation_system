@extends('layouts.auth')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="index.html" class="">
            <h3 class="text-primary"><i class="fa fa-school me-2"></i>SES</h3>
        </a>
        <h3>Sign In</h3>
    </div>

    <form action="{{ route('login') }}" method="post">
        @csrf

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
        <div class="form-floating mb-4">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword"
                placeholder="Password" name="password" required autocomplete="current-password">
            <label for="floatingPassword">Password</label>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-flex
                                align-items-center justify-content-between mb-4">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">Remember Me</label>
            </div>

            <a href="{{ route('password.request') }}">Forgot Password</a>
        </div>
        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
        <p class="text-center mb-0">Don't have an Account? <a href="{{ route('register') }}">Sign Up</a></p>
    </form>
@endsection
