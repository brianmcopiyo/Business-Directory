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
                    <div class="col-12">
                        <div class="row row-deck row-cards">
                            <div class="col-sm-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body"
                                         style="
                background: linear-gradient(to right, #4d5d6e 20%, #254560);
                color: white;
                border-radius: 8px;
                display: flex;
                flex-direction: column;
                /*align-items: center;*/
                /*justify-content: center;*/
                height: 150px;
             ">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader" style="font-weight: bold; margin-bottom: 10px; color: white;">Transactions</div>
                                            <div class="ms-auto lh-1">
                                                <div class="dropdown" style="font-weight: bold; margin-bottom: 10px; color: white;">
                                                    <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                       >
                                                        {{ match($range) {
                                                            '30_days' => 'Last 30 days',
                                                            '3_months' => 'Last 3 months',
                                                            default => 'Last 7 days',
                                                        } }}
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item {{ $range === '7_days' ? 'active' : '' }}" href="?range=7_days">Last 7 days</a>
                                                        <a class="dropdown-item {{ $range === '30_days' ? 'active' : '' }}" href="?range=30_days">Last 30 days</a>
                                                        <a class="dropdown-item {{ $range === '3_months' ? 'active' : '' }}" href="?range=3_months">Last 3 months</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="h1 mb-3">KSH. {{ number_format($currentTransactions, 2) }}</div>
                                        <div class="d-flex mb-2">
                                            <div>Conversion rate</div>
                                            <div class="ms-auto">
                            <span class="text-green d-inline-flex align-items-center lh-1">
                                {{ number_format($trendPercentage, 2) }}%
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24V24H0z" fill="none" />
                                    <path d="M3 17l6 -6l4 4l8 -8" />
                                    <path d="M14 7l7 0l0 7" />
                                </svg>
                            </span>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-primary" style="width: {{ min($conversionRate, 100) }}%" role="progressbar" aria-valuenow="{{ $conversionRate }}" aria-valuemin="0" aria-valuemax="100" aria-label="{{ $conversionRate }}% Complete">
                                                <span class="visually-hidden">{{ number_format($conversionRate, 2) }}% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="card">
                                    <div class="card-body text-center"
                                         style="
                background: linear-gradient(to right, #96c689 20%, #49a531);
                color: white;
                border-radius: 8px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 150px;
             ">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader" style="font-weight: bold; margin-bottom: 10px; color: white;">Total Customers</div>
                                        </div>
                                        <div class="h1 mb-3 justify-content-center"> {{ $totalCustomers ?? 0 }}</div>
                                        <div class="d-flex mb-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="card">
                                    <div class="card-body text-center"
                                         style="
                                    background: linear-gradient(to right, #72ace8 20%, #1987f4);
                                    color: white;
                                    border-radius: 8px;
                                    display: flex;
                                    flex-direction: column;
                                    align-items: center;
                                    justify-content: center;
                                    height: 150px;
                                 ">
                                      <div class="d-flex align-items-center">
                                            <div class="subheader" style="font-weight: bold; margin-bottom: 10px; color: white;">Total System Users</div>
                                        </div>
                                        <div class="h1 mb-3 justify-content-center"> {{ $users ?? 0 }}</div>
                                        <div class="d-flex mb-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <div class="col-sm-6 col-lg-2">
                            <div class="card">
                              <div class="card-body text-center" style="
                                background: linear-gradient(to right, #5e789e 20%, #234477);
                                color: white;
                                border-radius: 8px;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: center;
                                height: 150px;
                                ">
                                <div class="subheader" style="font-weight: bold; margin-bottom: 10px; color: white;">Total Accounts</div>
                                <div class="h1 mb-0"> {{ $totalAccounts ?? 0 }}</div>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-2">
                            <div class="card">
                              <div class="card-body text-center" style="
                                background: linear-gradient(to right, rgba(104,104,104,0.2) 20%, #2b2d30);
                                color: white;
                                border-radius: 8px;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: center;
                                height: 150px;
                                ">
                                <div class="subheader" style="font-weight: bold; margin-bottom: 10px; color: white;">Savings Available</div>
                                <div class="h1 mb-0"> {{ $savings ?? 0 }}</div>
                              </div>
                            </div>
                          </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row row-cards">
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                            <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                    <path d="M12 3v3m0 12v3" />
                                                </svg>
                                            </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$transactions}}
                                                </div>
                                                <div class="text-muted">Transactions</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                            <span class="bg-green text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                          <circle cx="9" cy="7" r="3" />
                                                          <path d="M6 21v-2a4 4 0 0 1 8 0v2" />
                                                          <circle cx="16" cy="10" r="3" />
                                                           <path d="M14 21v-2a4 4 0 0 1 4 -4h2" />
                                                           <circle cx="4" cy="10" r="3" />
                                                          <path d="M2 21v-2a4 4 0 0 1 4 -4h2" />
                                                    </svg>
                                            </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$customersThisMonth ?? 0}}
                                                </div>
                                                <div class="text-secondary">
                                                   New Customers This Month
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                            <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <circle cx="12" cy="7" r="3" />
                                                  <path d="M10 21v-2a4 4 0 0 1 4 0v2" />
                                                <circle cx="5" cy="10" r="2" />
                                                  <path d="M3 20v-1a3 3 0 0 1 3 -3h1" />
                                                <circle cx="19" cy="10" r="2" />
                                                  <path d="M18 20v-1a3 3 0 0 1 3 -3h1" />
                                                 <circle cx="12" cy="17" r="2" />
                                                  <path d="M12 14.5v1m0 5v1m2.598 -4.5h-1.5m-5 0h-1.5m4.33 -2.33l-.7 .7m-3.6 3.6l-.7 .7m0 -4.3l.7 .7m3.6 -3.6l.7 .7" />
                                                </svg>
                                            </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$admin_users}}
                                                </div>
                                                <div class="text-secondary">
                                                    system admins
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                            <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <circle cx="12" cy="12" r="10" />
                                                    <path d="M9 14c-1.5 -1.5 -1.5 -4 0 -5.5c1.5 -1.5 4 -1.5 5.5 0c1.5 1.5 1.5 4 0 5.5c-1.5 1.5 -4 1.5 -5.5 0z" />
                                                    <path d="M14 10l-2 2l-2 -2" />
                                                    <path d="M10 14l2 -2l2 2" />
                                                </svg>

                                            </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$totalGroups}}
                                                </div>
                                                <div class="text-secondary">
                                                    Total Groups
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <div class="col-sm-6 col-lg-2">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                            <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                <div style="width: 50px; height: 50px; background: #d3d3d3; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M3 7h14a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2z" /> <!-- Wallet body -->
                                                        <path d="M16 11l4 0" /> <!-- Wallet opening -->
                                                        <path d="M8 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /> <!-- Wallet button -->
                                                    </svg>
                                                </div>


                                            </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$savingSums->last_month}}
                                                </div>
                                                <div class="text-secondary">
                                                    Total Savings Last Month
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Most recent Customers Registrations</h3>
                            </div>
                            <div class="table-responsive" style="overflow-y:visible;">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                    <tr>
                                        <th class="w-1">
                                            <input class="form-check-input m-0 align-middle headerCheckbox" type="checkbox" aria-label="Select all items">
                                        </th>
                                        <th class="w-1">
                                        </th>
                                        <th>Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($table as $count=>$row)
                                        <tr>
                                            <td>
                                                <input class="form-check-input m-0 align-middle rowCheckbox" type="checkbox" aria-label="Select invoice">
                                            </td>
                                            <td><span class="text-secondary">{{ $count + 1 + (($table->currentPage() - 1) * 15) }}</span></td>
                                            <td>{{ $row->created_at }}</td>
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
