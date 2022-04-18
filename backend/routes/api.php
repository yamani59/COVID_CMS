<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\UserController;
use App\Models\NewsCategory;

Route::prefix('v1')->group(function() {
  Route::controller(AuthController::class)->group(function() {
      Route::post('/login', 'login');
      Route::post('/logout', 'logout');
  });
  
  Route::middleware('auth:api')->group(function() {
    Route::controller(UserController::class)->group(function() {
      Route::get('/admin', 'index');
      Route::get('/admin/{id}', 'show');
      Route::post('/admin/new', 'store');
      Route::post('/admin/{id}', 'edit');
      Route::delete('/admin/{id}', 'destroy');
    });
    Route::controller(NewsController::class)->group(function() {
      Route::get('/news', 'index');
      Route::get('/news/{id}', 'show');
      Route::post('/news/new', 'store');
      Route::post('/news/{id}', 'edit');
      Route::delete('/news/{id}', 'destroy');
    });
    Route::controller(NewsCategoryController::class)->group(function() {
      Route::get('/category', 'index');
      Route::get('/category/{id}', 'show');
      Route::post('/category/new', 'store');
      Route::post('/category/{id}', 'edit');
      Route::delete('/category/{id}', 'destroy');
    });
    Route::controller(SlideController::class)->group(function() {
      Route::get('/slide', 'index');
      Route::get('/slide/{id}', 'show');
      Route::post('/slide/new', 'store');
      Route::post('/slide/{id}', 'edit');
      Route::delete('/slide/{id}', 'destroy');
    });    
  });
});