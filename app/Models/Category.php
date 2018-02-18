<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\CategorySaving;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug',
    ];

    protected $dispatchesEvents = [
        'saving' => CategorySaving::class,
    ];

    /**
     * [images description]
     * @return [type] [description]
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
