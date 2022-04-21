<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdmin
{
  public function handle(Request $request, Closure $next)
  {
    if($request->user('api')->role != 'super admin')
      return response()->json([
        'msg' => 'you not super admin'
      ]);
    return $next($request);
  }
}
