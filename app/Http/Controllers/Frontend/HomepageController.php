<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Service;
use App\Setting;

class HomepageController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('created_at')->get();
        $settings = Setting::orderBy('name', 'asc')->pluck('name','id');
        $users = User::whereIsAdmin(true)->whereIsFeaturedToTeam(true)->get();
        $admins = User::whereIsAdmin(true)->whereIsOwner(true)->get();
        $teams = User::whereIsAdmin(true)->whereIsFeaturedToTeam(true)->get();

        return view('pages.frontend.index', compact('services', 'settings', 'users'));
    }
}
