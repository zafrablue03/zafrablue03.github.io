<?php

namespace App\Http\Controllers\Backend\Reservation;

use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservation;
use App\Setting;
use App\Datetime;
use App\Inclusion;
use Carbon\Carbon;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pending_reservations =  Reservation::pending()->get();
        $approved_reservations =  Reservation::approved()->get();
        $now = Carbon::now();

        return view('pages.backend.reservations.index', compact('approved_reservations', 'pending_reservations', 'now'));
    }

    public function create(Reservation $reservation)
    {
        $datetimes = Datetime::pluck('name', 'time');
        return view('pages.backend.reservations.create', compact('datetimes'));
    }


    public function store(ReservationRequest $request)
    {
        $reservation = new Reservation();
        $course = $reservation->getCourseArray($request->course);

        $data = $request->validated();
        
        $reservation = new Reservation();

        $reservation->create(array_merge(
            $request->except('_token', 'finish'),
            ['is_approved' => 1]
        ))->courses()->attach($course);

        return redirect()->route('reservation.index')->withSuccess('Reservation approved!');
    }

    public function show(Reservation $reservation)
    {
        return view('pages.backend.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $datetimes = Datetime::pluck('name', 'time');
        return view('pages.backend.reservations.edit', compact('reservation','datetimes'));
    }

    public function update(ReservationRequest $request, Reservation $reservation)
    {       
        $course = $reservation->getCourseArray($request->course);

        $request->validated();
        
        $reservation->update(array_merge(
            $request->except('_token', 'finish'),
            ['is_approved' => 1]
        ));
        $reservation->courses()->sync($course);

        return redirect()->route('reservation.show', $reservation->id)->withSuccess('Reservation approved!');
    }


    
    public function destroy(Request $request, Reservation $reservation)
    {
        if($request->get('approved') === 'cancel')
        {
            $reservation->update([
                'is_approved' => false,
                'pax'   => 0,
                'service_id' => 0,
                'set_id' => 0
            ]);
            // $reservation->is_approved = false;
            $reservation->courses()->detach();
            // $reservation->save();
            if($reservation->payment)
            {
                $reservation->payment()->delete();
            }
            return redirect()->route('reservation.index')->withSuccess('Reservation cancelled!');
        }elseif($request->get('action') === 'delete')
        {
            $reservation->delete();
            return redirect()->route('reservation.index')->withSuccess('Reservation deleted!');
        }
    }

    public function streamPDF(Reservation $reservation)
    {
        $total = $reservation->payable();
        $inclusion = Inclusion::whereIsActive(true)->first();
        $date = Carbon::parse($reservation->date)->toFormattedDateString();
        $pdf = \PDF::loadView('pages.backend.reservations.partials.contract-pdf', compact('reservation', 'date', 'total', 'inclusion'))->setPaper('a4', 'portrait');
        return $pdf->stream('test.pdf');
    }

    public function notify_pending()
    {
        $pending_reservations = Reservation::whereIsApproved(false)->get(['name', 'id', 'date']);
        // dd($pending_reservation->id);
        $total = $pending_reservations->count();

        $datas = array(
            $pending_reservations,
            'total' => $total
        );

        // return json_decode($pending_reservation);
        return $datas;
    }
}
