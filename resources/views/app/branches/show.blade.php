<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

$settings = User::find(Auth::user()->id)->settings;
$layout = $settings->layout;

?>

@extends('layouts.app')

@section('title', "Branches")

@section('content')
<div class="page-wrapper" style="margin-right: 0;">
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="px-5">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Cusotmers / Businesses
          </div>
          <h2 class="page-title">
            <a href="{{ route('customers.show', $business->customer) }}" class="btn btn-primary mr-3"> <i class="ti ti-chevron-left"></i></a> <span class="mx-2">{{ $business->name }}</span>
          </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list">
            @if ($layout == "vertical")
            <div class="d-none d-sm-inline">
              <form action="./" method="get" autocomplete="off" novalidate="">
                <div class="input-icon">
                  <span class="input-icon-addon">
                    <i class="ti ti-search"></i>
                  </span>
                  <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search in website">
                </div>
              </form>
            </div>
            @endif
          </div>
        </div>
      </div>


      <div class="my-2 pt-3 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
        <form action="{{ route('customers') }}" autocomplete="off" novalidate="">
          <div class="input-icon">
            <span class="input-icon-addon">
              <!-- Download SVG icon from http://tabler-icons.io/i/search -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                <path d="M21 21l-6 -6"></path>
              </svg>
            </span>
            <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search…" aria-label="Search in website">
          </div>
        </form>
      </div>

      @if (Session::has('success'))
      <div class="mt-3">
        <div class="alert alert-success bg-white">
          {{ Session::get('success') }}
        </div>
      </div>
      @endif

      @if (Session::has('error'))
      <div class="mt-3">
        <div class="alert alert-danger bg-white">
          {{ Session::get('error') }}
        </div>
      </div>
      @endif
    </div>
  </div>
  <!-- Page body -->
  <div class="page-body">
    <div class="px-5">
      <div class="row row-deck row-cards">
        <div class="col-12">
          <div class="card">
            <div class="table-responsive" style="overflow-y:visible;">
              <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                  <tr>
                    <th class="w-1">
                      <input class="form-check-input m-0 align-middle headerCheckbox" type="checkbox" aria-label="Select all items">
                    </th>
                    <th class="w-1"></th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($table as $count=>$row)
                  <tr>
                    <td>
                      <input class="form-check-input m-0 align-middle rowCheckbox" type="checkbox" aria-label="Select invoice">
                    </td>
                    <td><span class="text-secondary">{{ $count + 1 + (($table->currentPage() - 1) * 15) }}</span></td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>
                      @include('app.branches.edit')
                      <div class="d-flex justify-content-end gap-2">
                        <a href="javascript:void(0);" class="btn btn-warning p-1 px-2" data-bs-toggle="modal" data-bs-target="#update{{ $row->id }}">Edit</a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @include("partial.pagination")
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection