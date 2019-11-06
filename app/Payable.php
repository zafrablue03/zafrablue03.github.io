<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{
    protected $fillable = ['transportation_charge', 'reservation_id', 'is_paid', 'payable', 'payment', 'balance', 'discount_id', 'charge_fee'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    
}
