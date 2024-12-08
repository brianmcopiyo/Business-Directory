<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use App\Models\Business;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
  public function store(Request $request)
  {
    $user = User::find(Auth::user()->id);

    if ($user) {
      $customer = Customer::where('user_id', $user->id)->first();

      if ($customer) {
        Business::create([
          'name' => $request->name,
          'customer_id' => $customer->id,
          'subscription_id' => $request->subscription
        ]);

        return response()->json(['msg' => "Success"], 200);
      }
    }
    return response()->json(['msg' => "Unknown error."], 404);
  }

  public function new_brnach(Request $request)
  {
    $user = User::find(Auth::user()->id);

    if ($user) {
      $customer = Customer::where('user_id', $user->id)->first();

      if ($customer) {
        $business = Business::find($request->business);

        if ($business) {
          Branch::create([
            'name' => $request->name,
            'business_id' => $business->id,
            'subscription_id' => $request->subscription
          ]);

          return response()->json(['msg' => "Success"], 200);
        }

        return response()->json(['msg' => "This business wasn't found."], 404);
      }
    }
    return response()->json(['msg' => "Unknown error."], 404);
  }

  public function update_business(Request $request, $id)
  {
    $business = Business::find($id);

    if ($business) {
      $business->name = $request->name;
      $business->save();

      return back()->with('success', "Success");
    }

    return back()->with('error', "This business wasn't found.");
  }

  public function branches_show($id)
  {
    $search = "";

    $business = Business::where('id', $id)->with('customer')->first();

    if ($business) {
      $table = $business->branches()->paginate(25);
      return view('app.branches.show', compact('table', 'business', 'search'));
    }

    return back()->response(['error', "This business wasn't found."]);
  }

  public function branches_update(Request $request, $id)
  {
    $branch = Branch::find($id);

    if ($branch) {
      $branch->name = $request->name;
      $branch->save();

      return back()->with('success', "Success");
    }

    return back()->with('error', "This branch wasn't found");
  }
}
