<?php

namespace App\Http\Controllers\Backend\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function addStaff(Request $request)
    {
        $request->validate([
            'name'  =>  'required|min:2|max:50',
            'email' =>  'required|min:2|max:90|unique:users,email'
        ]);
        $password = bcrypt('tripleestaff2019');

        User::create([
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'password'  =>  $password,
            'is_admin'  =>  true
        ]);

        return redirect()->route('profile.index')->withSuccess('Staff added successfully!');
    }

    public function featureStaff(Request $request, User $user)
    {

        if($request->get('action') === 'feature')
        {
            $user->update([
                'is_featured_to_team' => !$user->is_featured_to_team
            ]);
    
            $message = $user->is_featured_to_team ? 'User is featured to team' : 'User is unfeatured to team';
    
            return redirect()->route('profile.index')->withSuccess($message);
        }elseif($request->get('action') === 'admin')
        {
            $user->update([
                'is_admin' => !$user->is_admin,
                'is_featured_to_team' => !$user->is_admin ? false : false
            ]);
    
            $message = $user->is_admin ? ' is now ADMINISTRATOR' : ' is demoted to staff';
    
            return redirect()->route('profile.index')->withSuccess($user->name . $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('profile.index')->withSuccess('Staff deleted successfully!');
    }
}
