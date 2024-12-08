<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
  public function store(Request $request)
  {
    $user = User::find(Auth::user()->id);

    if ($user) {
      $customer = Customer::where('user_id', $user->id)->first();

      $business = $customer->businesses()->where('id', $request->business)->first();

      if ($business) {
        $product = $business->products()->where('sku', $request->sku)->first();

        if (!$product) {
          Product::create([
            'sku' => $request->sku,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'business_id' => $request->business,
          ]);

          return response()->json(['msg' => "success"], 200);
        }

        return response()->json(['msg' => "This product already exists"]);
      }
    }

    return response()->json(['msg' => "Unauthorized request"], 401);
  }
}
