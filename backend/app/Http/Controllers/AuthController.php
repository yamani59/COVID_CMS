<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function login(Request $req) 
  {
    $loginData = $req->validate([
      'email' => ['required', 'email'],
      'password' => ['required']
    ]);

    if (!auth()->attempt($loginData))
      return response()->json([
        'msg' => 'invalid authentication'
      ], 401);

    $accessToken = auth()->user();
    $accessToken = $accessToken->createToken('authToken')->accessToken;
    return response()->json($accessToken);
  }

  public function logout(Request $req)
  {
    try {
      $req->user('api')->token()->revoke();
      return response()->json([
        'msg' => 'deleted successfully'
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'msg' => 'deleted failed',
      ], 401);
    }
  }
}
