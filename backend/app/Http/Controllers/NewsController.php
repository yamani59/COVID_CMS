<?php

namespace App\Http\Controllers;

use App\Models\News;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
  public function index()
  {
    $getData = News::with('category_id')->get();
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
        'poster' => ['image', 'file']
      ]);


      if ($request->file('poster'))
        $cleanData['poster'] = $request->file('poster')
          ->store('news-image');

      $cleanTag = $this->cleanTag($cleanData);

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
        'poster' => ['image', 'file']
      ]);

      if ($request->file('poster')) {
        Storage::delete($by->poster);
        $cleanData['poster'] = $request->file('poster')
          ->store('news-image');
      }

      $cleanTag = $this->cleanTag($cleanData);
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
      $current = News::findOrFail($id);
      Storage::delete($current->poster);
      $current->delete();

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
