<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class UserController extends Controller
{
  public function index()
  {
    $getData = User::latest()->get();
    return response()->json([
      'msg' => $getData
    ], 200);
  }

  public function store(Request $request)
  {
    try {
      $cleanData = $request->validate([
        'username' => ['required', 'max:255'],
        'email' => ['required', 'email'],
        'password' => ['required'],
        'role' => ['required'],
        'no_telp' => ['required']
      ]);

      $cleanData['password'] = bcrypt($cleanData['password']);

      $cleanTag = $this->cleanTag($cleanData);
      User::create($cleanTag);

      return response()->json([
        'msg' => 'insert successfully'
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'msg' => 'insert failed'
      ], 401);
    }
  }

  public function show($id)
  {
    $by = User::findOrFail($id);
    return response()->json([
      'data' => $by,
      'msg' => 'success'
    ], 200);
  }

  public function update(Request $request, $id)
  {
    try {
      $by = User::findOrFail($id);
      $cleanTag = $this->cleanTag($request->all());

      $by->update($cleanTag);

      return response()->json([
        'msg' => 'updated successfully'
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'msg' => 'updated failed'
      ], 401);
    }
  }

  public function destroy($id)
  {
    try {
      User::findOrFail($id)->delete();
      return response()->json([
        'msg' => 'deleted successfully'
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'msg' => 'deleted failed'
      ], 401);
    }
  }
}
