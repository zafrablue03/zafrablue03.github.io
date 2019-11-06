<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;
use App\Profile;
use File;

trait UploadTrait
{
    public function checkImage($image, $model)
    {
        $exists = $model->exists(public_path($image));
        if($exists)
        {
            File::delete(public_path($image));
        }
    }

    public function fitImage($image, $height, $width)
    {
        Image::make(public_path($image))->fit($height,$width)->save();
    }

    public function uploadUserProfile(User $user, UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $this->checkImage($user->profile->image, $user);
        $this->checkImage($user->profile->avatar, $user);

        $name = !is_null($filename) ? $filename : str_random(25);
        $avatarFolder = $folder.'/avatar';

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);
        $avatar = $uploadedFile->storeAs($avatarFolder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        $this->fitImage($avatar, 200,200);
        
        return $file;
    }

    public function uploadEventImages($model, UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $this->checkImage($model->url, $model);

        $name = !is_null($filename) ? $filename : str_random(25);

        $thumbnailFolder = $folder.'/thumbnail';

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);
        $thumbnail = $uploadedFile->storeAs($thumbnailFolder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        $this->fitImage($thumbnail, 200,200);

        return $file;
    }

    public function uploadImage($model, UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $this->checkImage($model->image, $model);
        $name = !is_null($filename) ? $filename : str_random(25);
        
        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);
        return $file;
    }

    public function uploadServiceImage($model, UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $this->checkImage($model->image, $model);
        $this->checkImage($model->thumbnail, $model);

        $name = !is_null($filename) ? $filename : str_random(25);

        $thumbnailFolder = $folder.'/thumbnail';

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);
        $thumbnail = $uploadedFile->storeAs($thumbnailFolder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        $this->fitImage($thumbnail, 400,400);

        return $file;
    }
}