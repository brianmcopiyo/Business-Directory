<?php

use App\Http\Middleware\APITokenMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post("login", [AuthController::class, "customer_login"]);
Route::post("signup", [AuthController::class, "customer_signup"]);

Route::middleware([APITokenMiddleware::class])->group(function () {
  Route::post('newbs', [BusinessController::class, "store"]);
  Route::post('newbr', [BusinessController::class, "new_brnach"]);
});

// Fallback
Route::get('{any}', function () {
  return response()->json(['msg' => "Unauthorised"], 401);
})->where('any', '.*');
