<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

$settings = User::find(Auth::user()->id)->settings;
$layout = $settings->layout;

?>

@extends('layouts.app')

@section('title', "Dashboard")

@section('search')
<div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
  <form action="./" method="get" autocomplete="off" novalidate="">
    <div class="input-icon">
      <span class="input-icon-addon">
        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
          <path d="M21 21l-6 -6"></path>
        </svg>
      </span>
      <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search in website">
    </div>
  </form>
</div>
@endsection

@section('content')
<div class="page-wrapper" style="margin-right: 0;">
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="px-5">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Overview
          </div>
          <h2 class="page-title">
            Dashboard
          </h2>
        </div>
      </div>
    </div>
  </div>
  <!-- Page body -->
  <div class="page-body">
    <div class="px-5">
      <div class="row row-deck row-cards">
      </div>
    </div>
  </div>
</div>
@endsection