<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index(Request $request)
  {
    $users = User::query()->whereNot('type', 'Customer')->count();

    return view('app.dashboard.dashboard', compact('users'));
  }
}
