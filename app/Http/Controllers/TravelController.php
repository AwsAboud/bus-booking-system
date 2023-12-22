<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TravelsSchedule;

class TravelController extends Controller
{
    public function show(TravelsSchedule $trip)
    {
        return view('confirmReservation',['tripDetails'=> $trip]);
    }

    // search for trip
    public function search(Request $request)
    {
        //get the data from the request (from the search for tiket form)
        $from = $request->starting_point;
        $to = $request->destination;
        $date = $request->schedule_date;

        if ($from && $to && $date) {
            // Get the available trips from the TravelsSchedule table
            $formattedDate = Carbon::createFromFormat('Y-m-d', $date)->toDateString();
            $avaliableTrips = TravelsSchedule::latest()->where([
                ['starting_point', 'like', '%' . $from . '%'],
                ['destination', 'like', '%' . $to . '%'],
            ])->whereDate('schedule_date',  $formattedDate)
            ->latest('schedule_date')
            ->get();
        }

        // if the user did not inter a date we will retreive all trips started from the current date
        elseif ($from && $to) {
            // Get the current date in the format 'YYYY-MM-DD'
            $currentDate = now()->format('Y-m-d');
            $avaliableTrips = TravelsSchedule::latest()
                ->whereDate('schedule_date', '>=', $currentDate)
                ->where([
                    ['starting_point', 'like', '%' . $from . '%'],
                    ['destination', 'like', '%' . $to . '%'],
                ])->get();
        }
        // if the user intered only the starting point
        elseif($from){
            $avaliableTrips = TravelsSchedule::latest()
                ->where('starting_point','like','%' . $from. '%')
                ->get();

        }
        return view('trips',['avaliableTrips' => $avaliableTrips]);
 }

}
