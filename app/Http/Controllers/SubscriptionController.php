<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

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
}
