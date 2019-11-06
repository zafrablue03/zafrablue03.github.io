<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['title', 'user_id', 'about', 'facebook', 'twitter', 'instagram', 'image', 'avatar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
