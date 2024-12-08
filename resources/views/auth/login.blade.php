@extends('layouts.guest')

@section('title', "Login")

@section('content')
<div class="card card-md">
    <div class="card-body">
        <h2 class="h2 text-center mb-4">Login to your account</h2>
        @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label"> Email </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="username" required autofocus>
            </div>

            <div class="mb-2">
                <label class="form-label">
                    Password
                </label>
                <div class="input-group input-group-flat">
                    <input type="password" name="password" class="form-control" placeholder="Your password" autocomplete="off">
                    <span class="input-group-text">
                        <i class="ti ti-eye" style="font-size: 18px;"></i>
                    </span>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="mb-2">
                <label class="form-check">
                    <input type="checkbox" class="form-check-input" name="remember" />
                    <span class="form-check-label">Remember me on this device</span>
                </label>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Sign in</button>
            </div>
        </form>
    </div>
</div>
@endsection