<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserSettingController;

Route::prefix('auth')->group(function () {
  // authentication
  Route::get('login', [AuthController::class, 'login'])->name('login');
  Route::post('login', [AuthController::class, 'signin'])->name('login');
});

Route::middleware('auth')->group(function () {
  //Settings
  Route::get('theme', [UserSettingController::class, "theme"])->name("theme");

  //admin
  Route::group(['middleware' => ['type:Admin']], function () {
    //Dashboard
    Route::get('/', [DashboardController::class, "index"])->name('home');
  });

  Route::prefix('auth')->group(function () {
    Route::get('reset', [AuthController::class, 'reset'])->name('reset');
    Route::post('reset', [AuthController::class, 'resetpwd'])->name('reset');
  });

  //Users
  Route::get('users', [UserController::class, 'index'])->name('users');
  Route::post('users/store', [UserController::class, 'store'])->name('users.store');
  Route::put('users/{id}/update', [UserController::class, "update"])->name('users.update');
  Route::get('users/{id}/activate', [UserController::class, "activate"])->name('users.activate');
  Route::get('users/{id}/suspend', [UserController::class, "suspend"])->name('users.suspend');

  //Customers
  Route::get('customers', [CustomerController::class, 'index'])->name('customers');
  Route::post('customers/store', [CustomerController::class, 'store'])->name('customers.store');
  Route::put('customers/{id}/update', [CustomerController::class, "update"])->name('customers.update');
  Route::get('customers/{id}/activate', [CustomerController::class, "activate"])->name('customers.activate');
  Route::get('customers/{id}/suspend', [CustomerController::class, "suspend"])->name('customers.suspend');
  Route::get('customers/{id}/show', [CustomerController::class, 'show'])->name('customers.show');

  //Businesses
  Route::put('businesses/{id}/update', [BusinessController::class, "update_business"])->name('businesses.update');
  Route::get('branches/{id}/show', [BusinessController::class, "branches_show"])->name('businesses.show');
  Route::put('branches/{id}/update', [BusinessController::class, "branches_update"])->name('branches.update');

  Route::get('/roles-permissions', [RolePermissionController::class, 'index'])->name('roles-permissions');
  Route::post('/roles', [RolePermissionController::class, 'storeRole'])->name('roles.store');
  Route::post('/permissions', [RolePermissionController::class, 'storePermission'])->name('permissions.store');
  Route::post('/assign-permissions', [RolePermissionController::class, 'assignPermission'])->name('roles.assign-permissions');

  Route::get('/roles/{id}/edit', [RolePermissionController::class, 'editRole'])->name('roles.edit');
  Route::put('/roles/{id}', [RolePermissionController::class, 'updateRole'])->name('roles.update');

  Route::get('/permissions/{id}/edit', [RolePermissionController::class, 'editPermission'])->name('permissions.edit');
  Route::put('/permissions/{id}', [RolePermissionController::class, 'updatePermission'])->name('permissions.update');

  //Logout
  Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// Fallback
Route::get('{any}', function () {
  return view('error');
})->where('any', '.*');
