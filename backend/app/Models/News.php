<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
      'category_id',
      'title',
      'content',
      'poster'
    ];

    public function newsCategory() {
      return $this->belongsTo(NewsCategory::class);
    }
}
