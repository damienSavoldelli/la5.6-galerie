<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  public function scopeLatestWithUser($query)
  {
      return $query->with('user')->latest();
  }
  
  /**
   * [category description]
   * @return [type] [description]
   */
  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  /**
   * [user description]
   * @return [type] [description]
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}