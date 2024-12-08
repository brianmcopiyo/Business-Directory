<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\UserDetail;
use App\Models\FacilityUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function login()
  {
    return view("auth.login");
  }

  public function reset()
  {
    return view("auth.reset");
  }

  public function resetpwd(Request $request)
  {
    if ($request->password == $request->confirm) {
      $user = User::find(Auth::user()->id);

      $user->update([
        'password' => Hash::make($request->password)
      ]);

      return redirect()->route('home')->with('success', "Your password was successfully reset");
    }

    return back()->with('error', "Your password doesn't match");
  }
  public function signin(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required|string',
    ]);
    $credentials = $request->only('email', 'password');
    if (Auth::guard('web')->attempt($credentials)) {
      $request->session()->regenerate(); // Prevent session fixation attacks
      return redirect()->route('home');
    }
    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ]);
  }

  public function signin1(Request $request)
  {
    $admin = Admin::where("email", $request->email)->first();

    if ($admin) {
      $credentials = ['id' => $admin->user_id, 'password' => $request->password];

      if (Auth::attempt($credentials)) {
        return redirect()->route('home');
      }
    }

    return back()->with('error', 'Incorrect email/phone or password.');
  }

  public function register()
  {
    return view("auth.register");
  }

  public function signup(Request $request) {}

  public function logout(Request $request)
  {
    Auth::logout();
    return redirect()->route("login");
  }

  public function customer_signup(Request $request)
  {
    $user = User::where("email", $request->email)->first();

    if (!$user) {
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'type' => "Customer",
        'password' => Hash::make($request->password)
      ]);

      UserDetail::create([
        'user_id' => $user->id,
      ]);

      $customer = Customer::where('phone', $request->phone)->exists();

      if (!$customer) {
        Customer::create([
          'user_id' => $user->id,
          'phone' => $request->phone
        ]);

        return response()->json(["msg" => "success"], 200);
      }

      $user->delete();
    }

    return response()->json(["msg" => "This account already exist"], 409);
  }

  public function customer_login(Request $request)
  {
    $user = User::where("email", $request->email)->first();
    $user->makeVisible(['password']);

    if (!$user || !Customer::where('user_id', $user->id)->first()) {
      return response()->json(['msg' => "Wrong credentials."], 404);
    }

    if (!Hash::check($request->password, $user->password)) {
      return response()->json(['msg' => "Wrong credentials."], 404);
    }

    $user->makeHidden(['password', 'created_at', 'updated_at', 'remember_token', 'type', 'token']);

    return response()->json(['msg' => "success", 'token' => $user->createToken()->token, 'data' => $user], 200);
  }
}
