<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Traits\UploadTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, UploadTrait;

    const ADMIN_TYPE = 1;
    const DEFAULT_TYPE = 0;
    const OWNER = 1;
    const STAFF = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'is_featured_to_team'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isOwner()
    {
        return $this->is_owner === self::OWNER;
    }

    public function isAdmin()
    {
        return $this->is_admin === self::ADMIN_TYPE;
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user){
            $user->profile()->create([
                'about' =>  '<small> Edit your bio </small>',
                'title' =>  'Member',
                'image' =>  'default.png',
                'avatar' =>  'default.png'
            ]);
        });

    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function updateUserDetails($request)
    {
        $is_featured_to_team = $request->featured ? true : false;
        $this->update(array_merge(
            $request->except('_token'),
            ['is_featured_to_team' => $is_featured_to_team]
        ));
    }

    public function updateUserProfile($request)
    {
        $img_arr = [];

        if($request->image){
            $image = $request->file('image');
            $name = $this->name.'_'.time();
            $folder = '/uploads/images/';
            $avatar = $folder.'avatar/';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $avatarFilePath = $avatar . $name . '.' . $image->getClientOriginalExtension();

            $this->uploadUserProfile($this,$image,$folder,'public', $name);
            array_push($img_arr, ['image' => $filePath]);
            array_push($img_arr, ['avatar' => $avatarFilePath]);
        }

        $this->profile()->update(array_merge(
            $request->except(['_token', 'image', '_method','action']),
            $img_arr[0] ?? [],
            $img_arr[1] ?? []
        ));
    }

    public function getInitials()
    {
        $name = explode(" ", $this->name);
        $initial = "";
        foreach($name as $init)
        {
            $initial .= $init[0];
        }

        return $initial;
    }
}
