<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TravelsSchedule;

class TravelController extends Controller
{


    public function show($id)
    {
        /*
        -You can use Eloquent's with() method to eager load the bus relationship
        for the TravelsSchedule model.
        -This will retrieve the TravelsSchedule with the given ID,
         along with its related bus model.
        The bus_number attribute of the related bus model can then be
        accessed using $trip->bus->bus_number.

        */
        $tripDetails = TravelsSchedule::with('bus')->findOrFail($id);
        return view('confirmReservation',['tripDetails'=> $tripDetails]);
    }

    // search for trip
    public function search(Request $request)
    {
        //get the data from the request (from the search for tiket form)
       $from = $request->starting_point;
        $to = $request->destination;
        $date = $request->schedule_date;
        // if( $from && $to && $date){
        //     //get the available trips from the TravelsSchedule table
        //     $avaliableTrips = TravelsSchedule::where([
        //         ['starting_point','like','%' . $from. '%'],
        //         ['destination','like','%' . $to .'%'],
        //         ['schedule_date','like','%' . $date .'%'],
        //     ])->get();
        // }
        if ($from && $to && $date) {
            // Get the available trips from the TravelsSchedule table
            $formattedDate = Carbon::createFromFormat('Y-m-d', $date)->toDateString();
            $avaliableTrips = TravelsSchedule::where([
                ['starting_point', 'like', '%' . $from . '%'],
                ['destination', 'like', '%' . $to . '%'],
            ])->whereDate('schedule_date',  $formattedDate)->get();
        }

        //End of if

        // if the user did not inter a date

        elseif ($from && $to) {
            $currentDate = now()->format('Y-m-d'); // Get the current date in the format 'YYYY-MM-DD'

            $avaliableTrips = TravelsSchedule::whereDate('schedule_date', '>=', $currentDate)
                ->where([
                    ['starting_point', 'like', '%' . $from . '%'],
                    ['destination', 'like', '%' . $to . '%'],
                ])->get();
               // dd($avaliableTrips);
        }

        //End of elseif

        // if the user intered only the starting point
        elseif($from){
                $avaliableTrips = TravelsSchedule::where(
                    'starting_point','like','%' . $from. '%'
                )->get();

        }
        //End of elseif

        return view('trips',['avaliableTrips' => $avaliableTrips]);
 }
 // End of the search method
}
