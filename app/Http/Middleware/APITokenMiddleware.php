<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\AccessToken;

class APITokenMiddleware
{
  public function handle($request, Closure $next)
  {
    $token = $request->bearerToken();

    if ($token && ($userId = $this->getUserIdFromToken($token))) {
      Auth::onceUsingId($userId);
      return $next($request);
    } else {
      return response()->json(['msg' => 'Unauthorized'], 401);
    }
  }

  private function getUserIdFromToken($token)
  {
    $accessToken = AccessToken::where('token', $token)->where('status', "Active")->first();

    if ($accessToken) {
      return $accessToken->user_id;
    }

    return null;
  }
}