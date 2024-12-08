@extends('layouts.guest')

@section('title', "Error")

@section('content')
<div class="card card-md">
    <div class="card-body">
        <h1 class="h1 mb-6 text-center" style="font-size: 50px;">404</h1>
        <div class="d-flex justify-content-center">
            <a href="{{ route('home') }}" class="btn btn-primary">Back Home</a>
        </div>
    </div>
</div>
@endsection