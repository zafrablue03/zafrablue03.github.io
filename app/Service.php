<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadTrait;

class Service extends Model
{
    use UploadTrait;
    protected $fillable = ['name', 'slug', 'description', 'image', 'thumbnail'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function images()
    {
        return $this->morphMany(ImageUpload::class, 'imageable');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function addService($request)
    {

        $image = $request->file('image');
        $name = str_random(25).'_'.time();
        $folder = '/uploads/services/';
        $thumbnail = $folder . 'thumbnail/';
        $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
        $thumbnailPath = $thumbnail . $name . '.' . $image->getClientOriginalExtension();
        $this->uploadServiceImage($this,$image,$folder,'public', $name);

        $this->create(array_merge(
            $request->except(['_token', 'image']),
            ['image'        => $filePath],
            ['thumbnail'    => $thumbnailPath]
        ));
    }
}
