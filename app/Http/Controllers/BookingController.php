<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelsSchedule;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //show all trips that the user has booked
    public function index()
    {
        $user = Auth::user();
        $userBookings = $user->bookings ;
        return view('test',['userBookings'=> $userBookings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // search for trip
    public function search(Request $request)
    {
        //get the data from the request (from the search for tiket form)
       $from = $request->starting_point;
        $to = $request->destination;
        $date = $request->schedule_date;

        if( $from && $to && $date){
            //get the available trips from the TravelsSchedule table
            $avaliableTrips = TravelsSchedule::where([
                ['starting_point','like','%' . $from. '%'],
                ['destination','like','%' . $to .'%'],
                ['schedule_date','like','%' . $date .'%'],
            ])->get();
        }
        //End of if

        // if the user did not inter a date
        elseif( $from && $to){
            $avaliableTrips = TravelsSchedule::where([
                ['starting_point','like','%' . $from. '%'],
                ['destination','like','%' . $to .'%'],
            ])->get();
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
// End of the class
