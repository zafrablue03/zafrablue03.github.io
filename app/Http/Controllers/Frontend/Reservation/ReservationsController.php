<?php

namespace App\Http\Controllers\Frontend\Reservation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewReservation;
use App\User;
use App\Reservation;
use App\Spam;
use Carbon\Carbon;
use Notification;

class ReservationsController extends Controller
{

    public function index()
    {
        return view('pages.frontend.reservation.index');
    }

    public function checkIfSpamming($email, $date)
    {
        $approved_reservation = Reservation::whereEmail($email)
        ->whereDay('created_at', Carbon::now()->day)
        ->where('date',$date)
        ->exists();

        
    }

    public function checkMaxReservation($date)
    {
        $pending = Reservation::whereIsApproved(false)->where('date',$date)->count();
        $approved = Reservation::whereIsApproved(true)->where('date',$date)->count();

        $total = $pending + $approved;

        return $total < 3 ? true : false;
        // if($approved AND $pending)
        // {
        //     return true;
        // }else{
        //     return false;
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $users = User::whereIsAdmin(true)->get();
        if($this->checkIfSpamming($request->email, $request->date))
        {
            Spam::create($request->all());
            return redirect()->back()->withError('Sorry! You already have a pending reservation with the same booking date. We will contact you as soon as possible!');
        }
        $request->validate([
            'date'          =>  'date_format:Y-m-d|required',
            'name'          =>  'required|min:2|max:50',
            'venue'         =>  'required|min:2',
            'pax'           =>  'required|numeric|digits_between:1,3',
            'email'         =>  'required|email|min:3|max:80',
            'contact'       =>  'required|numeric|digits_between:11,15',
            'service_id'    =>  'required',
            'message'       =>  ''
        ]);
        if($this->checkMaxReservation($request->date)){

            $reservation = Reservation::create($request->except('_token'));
            
            // Notification::send($users, new NewReservation($reservation));


            return redirect()->back()->withSuccess('Thank you! Please wait for us to reach on you!');
        }else{

            return redirect()->back()->withError('Date being reserved is fully occupied!');
        }

        
    }
}
