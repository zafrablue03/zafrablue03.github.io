<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Requests\ProfileRequest;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\User;
use App\Profile;
use App\Reservation;
use File;

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::get();
        $user = auth()->user();
        $reservations = Reservation::approved()->orderBy('date', 'ASC')->get();

        return view('pages.backend.profile.user-profile', compact('user', 'reservations', 'users'));
    }
    
    public function edit(User $user)
    {
        return view('pages.backend.profile.edit', compact('user'));
    }

    public function checkImage($image)
    {
        return Profile::exists(storage_path('app/public/'.$image));
    }

    protected $syncRelatedModels = [
        'user'      =>  'updateUserDetails',
        'profile'   =>  'updateUserProfile'
    ];

    public function update(ProfileRequest $request, User $user)
    {
        $request->validated();

        foreach($this->syncRelatedModels as $index => $syncRelatedModel)
        {
            if($request->get('action') == $index)
            {
                $user->$syncRelatedModel($request);
            }
        }

        return redirect()->route('profile.index')->withSuccess('Profile updated successfully');

    }
}
