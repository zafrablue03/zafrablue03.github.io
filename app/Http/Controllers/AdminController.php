<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Payable;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function now()
    {
        return Carbon::now();
    }

    public function admin()
    {
        $now = $this->now();
        
        // $revenue = $this->total_payment_payable_reservation_by_month('payment');
        // $expected_monthly_revenue = $this->total_payment_payable_reservation_by_month('payable');

        $months_array =  $this->get_months_of_reservation();
        return view('pages.backend.index', compact('now', 'months_array'));
    }

    public function get_dynamic_revenue_using_ajax($month)
    {
        $approved = Reservation::whereIsApproved(true)->whereMonth('date',$month)->count();
        $pending = Reservation::whereIsApproved(false)->whereMonth('date',$month)->count();
        $customersCount = Reservation::whereIsApproved(true)->whereMonth('date',$month)->sum('pax');
        $revenue_arr = [
            'revenue' => number_format($this->total_payment_payable_reservation_by_month('payment', $month)),
            'expected_monthly_revenue' => number_format($this->total_payment_payable_reservation_by_month('payable', $month)),
            'approved' => $approved,
            'pending' => $pending,
            'total_pax' => $customersCount
        ];

        return $revenue_arr;
    }

    public function total_payment_payable_reservation_by_month($params, $month)
    {
        // $month = $this->now()->month;
        $reservations = Reservation::whereMonth('date', $month)->whereIsApproved(true)->get();

        $total_for_this_month = 0;

        foreach($reservations as $reservation)
        {
            if($reservation->payment)
            {
                $data = $reservation->payment->is_paid ? $reservation->payment->$params : $params === 'payment' ? 
                        $reservation->payment->$params + $reservation->payment->transaction_charge : $reservation->payment->$params;
                $total_for_this_month +=  $data;
            }
        }

        return $total_for_this_month;
    }

    public function get_months_of_reservation()
    {

        $months_arr = [];
        $reservations = Reservation::whereIsApproved(true)->orderBy('date', 'asc')->get();

        if(!empty($reservations))
        {
            foreach($reservations as $reservation)
            {
                if($reservation->payment)
                {
                    $date = $reservation->eventDate();
                    $month_full = $date->format('F');
                    $month_num = $date->format('m');
                    $months_arr[$month_num] = $month_full;
                }
            }
        }
        return $months_arr;
    }
}
