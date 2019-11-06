<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    protected $fillable = ['date','time', 'name', 'email', 'contact', 'message', 'venue', 'pax', 'service_id', 'set_id', 'inclusion_id', 'is_approved'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function scopeApproved($query)
    {
        return $query->whereIsApproved(true)->orderBy('date', 'desc');
    }

    public function scopePending($query)
    {
        return $query->whereIsApproved(false)->orderBy('date', 'desc');
    }
    
    public function setting()
    {
        return $this->belongsTo(Setting::class, 'set_id');
    }

    public function payment()
    {
        return $this->hasOne(Payable::class, 'reservation_id');
    }

    public function getCourseArray($course)
    {
        $val_arr = [];
        foreach($course as $array)
        {
            foreach($array as $key => $val)
            {
                $value = $val;
                array_push($val_arr, $value);
            }
        }
        return $val_arr;
    }

    public function payable()
    {
        return $this->setting->price * $this->pax;
    }

    public function eventDate()
    {
        return Carbon::parse($this->date);
    }

    public function payments($request){

        if($request->action == 'update')
        {
            $payment = $this->payment->payment + $request->payment;
            $balance = $this->payment->balance - $payment;
            $payable = $this->payment->payable;
            //payment should not overlapse total payable;
            $max_payable = $payable > $payment ? $payment : $payable;
            $paid = max($balance,0) == 0 ? true : false;
            $this->payment()->update([
                'payment'   =>  $max_payable,
                'balance'   =>  max($balance,0),
                'is_paid'   =>  $paid
            ]);
        }else{
            $transpo = $request->transportation_charge;
            $downPayment = $request->payment;
            $totalPrice = $this->setting->price * $this->pax;
            $payable = $totalPrice + $transpo;
            //same goes here for payment
            $max_payable = $payable > $downPayment ? $downPayment : $payable;
            $balance = $payable - $downPayment;
            $paid = max($balance,0) == 0 ? true : false;

            $this->payment()->create([
                'transportation_charge' =>  $transpo,
                'payment'               =>  $max_payable,
                'payable'               =>  $payable,
                'balance'               =>  max($balance,0),
                'is_paid'               =>  $paid
            ]);
        }
    }
}
