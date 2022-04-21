<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
  public function index()
  {
    $getData = Slide::latest()->get();
    return response()->json([
      'data' => $getData,
      'msg' => 'success'
    ], 200);
  }

  public function store(Request $request)
  {
    try {
      $cleanData = $request->validate([
        'title' => ['required'],
        'description' => ['required'],
        'link' => ['required'],
        'image' => ['image', 'file']
      ]);

      if ($request->file('image'))
        $cleanData['image'] = $request->file('image')
          ->store('slide-image');

      $cleanTag = $this->cleanTag($cleanData);
      Slide::create($cleanTag);

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
    $getBy = Slide::findOrFail($id);

    return response()->json([
      'data' => $getBy,
      'msg' => 'success'
    ], 200);
  }

  public function update(Request $request, $id)
  {
    try {
      $getBy = Slide::findOrFail($id);

      $cleanData = $request->validate([
        'title' => ['required'],
        'description' => ['required'],
        'link' => ['required'],
        'image' => ['image', 'file']
      ]);


      if ($request->file('image'))
        $cleanData['image'] = $request->file('image')
          ->store('slide-image');

      $cleanTag = $this->cleanTag($cleanData);
      $getBy->update($cleanTag);

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
      $by = Slide::findOrFail($id);
      Storage::delete('slide-image/' . $by->image);
      $by->delete();

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
