<?php

namespace App\Http\Controllers\Backend\Payable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservation;

class PayablesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Reservation $reservation)
    {
        return view('pages.backend.reservations.payable.create', compact('reservation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Reservation $reservation)
    {
        if($request->get('action') == 'create')
        {
            $request->validate([
                'transportation_charge' =>  'required|numeric',
                'payment'               =>  'required|numeric'
            ]);
            $reservation->payments($request);
        }elseif($request->get('action') == 'update')
        {
            $request->validate([
                'payment'               =>  'required|numeric'
            ]);
            $reservation->payments($request);
        }

        return redirect()->route('reservation.show', $reservation->id)->withSuccess('Payments added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
