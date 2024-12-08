<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\BusinessUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $search = $request->search ?? "";
    $users = User::whereNotIn('type', ['Customer'])
      ->orderByDesc('id');

    if (!empty($search)) {
      $users = $users->where(function ($query) use ($search) {
        $query->where('name', 'like', "%$search%")
          ->orWhere('email', 'like', "%$search%")
          ->orWhere('phone', 'like', "%$search%")
          ->orWhere('type', 'like', "%$search%")
          ->orWhere('status', 'like', "%$search%");
      });
    }
    $table = $users->paginate(25);
    return view('app.users', compact('table', 'search'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }

  public function activate($id)
  {
    $customer = Customer::find($id);

    if ($customer) {
      $customer->status = "Active";
      $customer->save();

      return back()->with('success', "Success.");
    }

    return back()->with('error', "This customer wasn't found.");
  }

  public function suspend($id)
  {
    $customer = Customer::find($id);

    if ($customer) {
      $customer->status = "Suspended";
      $customer->save();

      return back()->with('success', "Success.");
    }

    return back()->with('error', "This customer wasn't found.");
  }
}
