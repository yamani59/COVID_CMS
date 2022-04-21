<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
      'news_category_id',
      'title',
      'content',
      'poster'
    ];

    public function category_id() {
      return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }
}
