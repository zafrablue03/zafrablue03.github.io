<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadTrait;

class Course extends Model
{
    use UploadTrait;
    protected $fillable = ['name', 'description', 'image', 'type_id', 'slug'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function upload($request)
    {
        $image = $request->file('image');
        $name = str_random(25).'_'.time();
        $folder = '/uploads/courses/';
        $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
        $this->uploadImage($this,$image,$folder,'public', $name);

        $this->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'type_id' => $request->type_id,
            'image' => $filePath
        ]);
    }
}
