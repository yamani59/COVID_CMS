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

    $token = app()->handle(
      Request::create(
        'http://127.0.0.1:8000/oauth/token',
        'post',
        [
          'grant_type' => 'password',
          'client_id' => '2',
          'client_secret' => 'lTRFypqLTTV5I4mKJyHD47dmmSFQr7sTMAdY1Uvj',
          'username' => $loginData['email'],
          'password' => $loginData['password']
        ]
      )
    )->content();
    
    return response()->json(json_decode($token, true), 200);
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
