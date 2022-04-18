<?php

namespace App\Http\Controllers;
use App\Models\News;
use Exception;
use Illuminate\Http\Request;

class NewsController extends Controller
{
  public function index()
  {
    $getData = News::latest()->get();
    return response()->json([
      'data' => $getData,
      'msg' => 'successfully'
    ], 200);
  }

  public function store(Request $request)
  {
    try {
      $cleanData = $request->validate([
        'category_id' => ['required'],
        'title' => ['required'],
        'content' => ['required'],
        'poster' => ['required']
      ]);

      $cleanTag = array_map(function($sigleData) {
        return strip_tags($sigleData);
      }, $cleanData);

      News::create($cleanTag);
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
    $getBy = News::findOrFail($id);
    return response()->json([
      'data' => $getBy,
      'msg' => 'succesfully'
    ], 200);
  }

  public function update(Request $request, $id)
  {
    try {
      $by = News::findOrFail($id);
      $cleanData = $request->validate([
        'category_id' => ['required'],
        'title' => ['required'],
        'content' => ['required'],
        'poster' => ['required']
      ]);

      $cleanTag = array_map(function($sigleData) {
        return strip_tags($sigleData);
      }, $cleanData);

      $by->update($cleanData);
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
      News::findOrFail($id)->delete();
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
