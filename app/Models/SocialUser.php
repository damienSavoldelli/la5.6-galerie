<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialUser extends Model
{
    protected $fillable = ['user_id', 'provider_user_id', 'provider', 'avatar', 'verified'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
