<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
  use HasFactory;

  protected $fillable = [
    'title', 'description'
  ];

  public function news() {
    return $this->hasMany(News::class, 'id');
  }

  public function delete()
  {
  }
}
