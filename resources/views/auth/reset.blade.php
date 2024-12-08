@extends('layouts.guest')

@section('title', "Reset")

@section('content')
<div class="card card-md">
  <div class="card-body">
    <h2 class="h2 text-center mb-4">Reset your password</h2>
    @if (Session::has('error'))
    <div class="alert alert-danger" role="alert">
      {{ Session::get('error') }}
    </div>
    @endif
    <form method="POST" action="{{ route('reset') }}">
      @csrf
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
      <div class="mb-2">
        <label class="form-label">
          Confirm
        </label>
        <div class="input-group input-group-flat">
          <input type="password" name="confirm" class="form-control" placeholder="Confirm" autocomplete="off">
          <span class="input-group-text">
            <i class="ti ti-eye" style="font-size: 18px;"></i>
          </span>
        </div>
      </div>
      <div class="form-footer">
        <button type="submit" class="btn btn-primary w-100">Reset</button>
      </div>
    </form>
  </div>
</div>
@endsection