<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['name'];

    public function inclusions()
    {
        return $this->belongsToMany(Inclusion::class);
    }
}
