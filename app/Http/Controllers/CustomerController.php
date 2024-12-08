<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $search = $request->search ?? "";
    $users = Customer::with(['user:id,name,email,type,status'])->withCount(['businesses'])
      ->orderByDesc('id');

    if (!empty($search)) {
      $users = $users->where(function ($query) use ($search) {
        $query->where('user.name', 'like', "%$search%")
          ->orWhere('user.email', 'like', "%$search%")
          ->orWhere('phone', 'like', "%$search%")
          ->orWhere('status', 'like', "%$search%");
      });
    }

    $table = $users->paginate(25);

    return view('app.customers', compact('table', 'search'));
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
  public function show($id)
  {
    $search = $request->search ?? "";

    $customer = Customer::find($id);

    if ($customer) {

      $table = Business::orderByDesc('id')->paginate(25);

      return view('app.customers.show', compact('table', 'customer', 'search'));
    }

    return back()->with('error', "This customer wasn't found.");
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
}
