<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spam extends Model
{
    protected $fillable = ['email', 'name', 'contact', 'date'];
}
