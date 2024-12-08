<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
  public function index()
  {
    $search = "";
    $table = Subscription::get();
    return view('app.subscriptions', compact('table', "search"));
  }

  public function update(Request $request, $id)
  {
    $sub = Subscription::find($id);

    if ($sub) {
      $sub->name = $request->name;
      $sub->price = $request->price;
      $sub->products = $request->products;

      $sub->save();

      return back()->with('success', "Success");
    }

    return back()->with('error', "This subscription wasn't found.");
  }

  public function renew(Request $request)
  {
    $user = User::find(Auth::user()->id);

    if ($user) {
      $customer = Customer::where('user_id', $user->id)->first();

      $business = $customer->businesses()->where('id', $request->business)->first();

      if ($business) {
        $amount = 0;
        $sub = $business->subscription;

        $amount = $sub->price;

        $branches = $business->branches;

        foreach ($branches as $branch) {
          $sub = $branch->subscription;
          $amount = $amount + $sub->price;
        }


        do {
          $code = Str::random(12);
        } while (Payment::where('identifier', $code)->first());

        $payment = Payment::create(['identifier' => $code, 'amount' => $amount, 'status' => "Complete", 'business_id' => $business->id]);

        if ($payment) {
          $days = ceil(Carbon::now()->diffInDays($business->duedate, false));
          $days = $days < 0 ? 0 : $days;
          $days = $days + 30;

          $business->update(['duedate' => Carbon::now()->addDays($days)]);
        }

        return response()->json(['msg' => "success"], 200);
      }

      return response()->json(['msg' => "Unauthorized request"], 401);
    }

    return response()->json(['msg' => "Error"], 404);
  }
}
