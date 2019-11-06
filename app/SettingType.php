<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingType extends Model
{
    protected $table = 'setting_type';
    
    public function setting()
    {
        return $this->belongsTo(Setting::class, 'setting_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
