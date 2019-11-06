<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadTrait;

class ImageUpload extends Model
{
    use UploadTrait;
    protected $fillable = ['url', 'thumbnail', 'imageable_id', 'imageable_type'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function upload($request, $service)
    {

        $image = $request->file('image');
        // Make a image name based on user name and current timestamp
        $name = str_random(25).'_'.time();
        // Define folder path
        $folder = '/uploads/events/';
        $thumbnail = $folder.'thumbnail/';
        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
        $thumbnailPath = $thumbnail . $name. '.' . $image->getClientOriginalExtension();
        // Upload image
        $this->uploadEventImages($this, $image, $folder, 'public', $name);

        $service->images()->create([
            'url'       =>  $filePath,
            'thumbnail' =>  $thumbnailPath
        ]);
    }
}
