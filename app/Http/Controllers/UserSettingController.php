<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettingController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
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
  public function show(UserSetting $userSetting)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(UserSetting $userSetting)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, UserSetting $userSetting)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(UserSetting $userSetting)
  {
    //
  }

  public function theme(Request $request)
  {
    $settings = User::find(Auth::user()->id)->settings;

    $settings->theme = $request->theme;
    $settings->save();

    return back();
  }
}
