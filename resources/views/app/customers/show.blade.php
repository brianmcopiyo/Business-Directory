<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

$settings = User::find(Auth::user()->id)->settings;
$layout = $settings->layout;

?>

@extends('layouts.app')

@section('title', "Businessess")

@section('content')
<div class="page-wrapper" style="margin-right: 0;">
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="px-5">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Customers
          </div>
          <h2 class="page-title">
            <a href="{{ route('customers') }}" class="btn btn-primary mr-3"> <i class="ti ti-chevron-left"></i></a> <span class="mx-2">{{ $customer->user->name }}</span>
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

  <div class="page-body">
    <div class="px-5">
      <div class="row gap-2">
        <div class="col-md-3">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Basic Info</h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col text-truncate">
                    <a href="#" class="text-reset d-block">Name:</a>
                    <div class="d-block text-secondary text-truncate mt-n1">{{ $customer->user->name }}</div>
                  </div>
                </div>
              </div>
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col text-truncate">
                    <a href="#" class="text-reset d-block">Phone Number:</a>
                    <div class="d-block text-secondary text-truncate mt-n1">{{ $customer->phone }}</div>
                  </div>
                </div>
              </div>
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col text-truncate">
                    <a href="#" class="text-reset d-block">Email:</a>
                    <div class="d-block text-secondary text-truncate mt-n1">{{ $customer->user->email }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-9 row gap-2">
          <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                <li class="nav-item">
                  <a href="#tab-1" class="nav-link active" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="ti ti-businessplan mx-2"></i>
                    Businesses</a>
                </li>
                <li class="nav-item">
                  <a href="#tab-2" class="nav-link" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="ti ti-credit-card-pay mx-2"></i>
                    Payments</a>
                </li>
                <li class="nav-item">
                  <a href="#tab-3" class="nav-link" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="ti ti-building-store mx-2"></i>
                    Products</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content p-0">
                <div class="tab-pane active show" id="tab-1">
                  <div class="d-flex justify-content-between">
                    <h4>Businesses</h4>
                  </div>
                  <div class="table" style="overflow-x: auto;">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th class="w-1">
                            <input class="form-check-input m-0 align-middle headerCheckbox" type="checkbox" aria-label="Select all items">
                          </th>
                          <th class="w-1"></th>
                          <th>Name</th>
                          <th>Subscription</th>
                          <th>Next Subscription In</th>
                          <th>Branches</th>
                          <th>Status</th>
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
                          <td>{{ $row->subscription->name }}</td>
                          <td>
                            @php
                            $days = ceil(\Carbon\Carbon::now()->diffInDays($row->duedate, false));
                            @endphp
                            {{ $days }} {{ $days == 1 ? "Day" : "Days" }}
                          </td>
                          <td>{{ $row->branches()->count() }}</td>
                          <td>{{ $row->status }}</td>
                          <td>{{ $row->created_at }}</td>
                          <td>
                            @include('app.businesses.edit')
                            <div class="d-flex justify-content-end gap-2">
                              <a href="{{ route('businesses.show', $row->id) }}" class="btn btn-primary p-1 px-2">View</a>
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
              <div class="tab-content p-0">
                <div class="tab-pane show" id="tab-2">
                  <div class="d-flex justify-content-between">
                    <h4>Payments</h4>
                  </div>
                  <div class="table" style="overflow-x: auto;">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th class="w-1">
                            <input class="form-check-input m-0 align-middle headerCheckbox" type="checkbox" aria-label="Select all items">
                          </th>
                          <th class="w-1"></th>
                          <th>Identifier</th>
                          <th>Business</th>
                          <th>Amount</th>
                          <th>Status</th>
                          <th>Created At</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($table2 as $count=>$row)
                        <tr>
                          <td>
                            <input class="form-check-input m-0 align-middle rowCheckbox" type="checkbox" aria-label="Select invoice">
                          </td>
                          <td><span class="text-secondary">{{ $count + 1 + (($table2->currentPage() - 1) * 15) }}</span></td>
                          <td>{{ $row->identifier }}</td>
                          <td>{{ $row->business->name }}</td>
                          <td>&euro; {{ $row->amount }}</td>
                          <td>
                            <span class="badge bg-{{ $row->status == 'Pending' ? 'warning' : '' }}{{ $row->status == 'Complete' ? 'success' : '' }}{{ $row->status == 'Canceled' ? 'danger' : '' }}-lt">{{ $row->status }}</span>
                          </td>
                          <td>{{ $row->created_at }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  @include("partial.pagination2")
                </div>
              </div>
              <div class="tab-content p-0">
                <div class="tab-pane show" id="tab-3">
                  <div class="d-flex justify-content-between">
                    <h4>Products</h4>
                  </div>
                  <div class="table" style="overflow-x: auto;">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th class="w-1">
                            <input class="form-check-input m-0 align-middle headerCheckbox" type="checkbox" aria-label="Select all items">
                          </th>
                          <th class="w-1"></th>
                          <th>SKU</th>
                          <th>Name</th>
                          <th>Stock</th>
                          <th>Amount</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th>Created At</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($table3 as $count=>$row)
                        <tr>
                          <td>
                            <input class="form-check-input m-0 align-middle rowCheckbox" type="checkbox" aria-label="Select invoice">
                          </td>
                          <td><span class="text-secondary">{{ $count + 1 + (($table3->currentPage() - 1) * 15) }}</span></td>
                          <td>{{ $row->sku }}</td>
                          <td>{{ $row->name }}</td>
                          <td>{{ $row->stock }}</td>
                          <td>&euro; {{ $row->price }}</td>
                          <td>{{ $row->description }}</td>
                          <td>
                            <span class="badge bg-{{ $row->status == 'Active' ? 'success' : 'warning' }}-lt">{{ $row->status }}</span>
                          </td>
                          <td>{{ $row->created_at }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  @include("partial.pagination3")
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
