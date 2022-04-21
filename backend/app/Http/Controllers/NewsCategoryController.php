<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;
use Exception;

class NewsCategoryController extends Controller
{
  public function index()
  {
    $getData = NewsCategory::latest()->get();
    return response()->json([
      'data' => $getData,
      'msg' => 'successfully'
    ], 200);
  }

  public function store(Request $request)
  {
    try {
      $cleanData = $request->validate([
        'title' => ['required'],
        'description' => ['required']
      ]);

      $cleanTag = $this->cleanTag($cleanData);

      NewsCategory::create($cleanTag);
      return response()->json([
        'msg' => 'insert data successfully'
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'msg' => $e->getMessage()
      ], 401);
    }
  }

  public function show($id)
  {
    $getBy = NewsCategory::findOrFail($id);
    return response()->json([
      'data' => $getBy,
      'msg' => 'successfully'
    ], 200);
  }

  public function update(Request $request, $id)
  {
    try {
      $cleanData = $request->validate([
        'title' => ['required'],
        'description' => ['required']
      ]);

      $cleanTag = $this->cleanTag($cleanData);

      $current = NewsCategory::findOrFail($id);
      $current->update($cleanTag);

      return response()->json([
        'msg' => 'updated successfully'
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'msg' => $e->getMessage()
      ], 401);
    }
  }

  public function destroy($id)
  {
    try {
      NewsCategory::findOrFail($id)->delete();
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
