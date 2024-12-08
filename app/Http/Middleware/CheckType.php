<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckType
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string  $type
   * @return mixed
   */

  public function handle(Request $request, Closure $next, $type, $secondary = null)
  {
    $user = Auth::user();

    if ($user && $user->type === $type) {
      return $next($request);
    }

    return redirect()->route('landing');
  }
}
