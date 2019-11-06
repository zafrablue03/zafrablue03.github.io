<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\Reservation;
use Carbon\Carbon;

class AjaxDataController extends Controller
{
    public function services()
    {
        $services = Service::pluck('name');

        return $services;
    }

    public function get_services_data_sales_per_month($month)
    {
        $services = Service::with('reservations')->get();
        $total_arr = [];

        foreach($services as $service)
        {
            $total = 0;
            foreach($service->reservations as $reservation)
            {
                if($reservation->payment)
                {
                    if($reservation->eventDate()->month == $month)
                    {
                        $data = $reservation->payment->payment;
                        $total += $data;
                    }
                }
            }
            array_push($total_arr, $total);
        }
        $data = [
            $this->services(),
            $total_arr,
            $this->totalServicesPaxPerMonth($month),
            'total_sales' => $this->totalServicesSalesByMonth($month),
            'total_pax' => $this->totalPaxPerMonth($month)
        ];
        return $data;
    }

    public function totalServicesPaxPerMonth($month)
    {
        $services = Service::with('reservations')->get();
        $pax_arr = [];

        foreach($services as $service)
        {
            $total_pax = 0;
            foreach($service->reservations as $reservation)
            {
                if($reservation->payment)
                {
                    if($reservation->eventDate()->month == $month)
                    {
                        $total_pax += $reservation->pax;
                    }
                }
            }
            array_push($pax_arr, $total_pax);
        }

        return $pax_arr;

        
    }

    public function totalServicesSalesByMonth($month)
    {
        $reservations = Reservation::whereMonth('date',$month)->get();

        $total_sales = 0;
        foreach($reservations as $reservation)
        {
            if($reservation->payment)
            {
                $data = $reservation->payment->payment;
                $total_sales += $data;
            }
        }

        return number_format($total_sales);
    }
    public function totalPaxPerMonth($month)
    {
        $reservations = Reservation::whereMonth('date',$month)->get();

        $total_pax = 0;
        foreach($reservations as $reservation)
        {
            if($reservation->payment)
            {
                $total_pax += $reservation->pax;
            }
        }
        return $total_pax;
    }
}
