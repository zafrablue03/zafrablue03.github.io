<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inclusion extends Model
{
    protected $fillable = ['name', 'slug'];

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
