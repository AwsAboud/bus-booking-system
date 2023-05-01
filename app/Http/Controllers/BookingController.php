<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\TravelsSchedule;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;



class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //show all trips that the user has booked
    public function index($status = 'finished')
    {
       // dd($request);
        //retrieve the User instance from the database.
        $user = Auth::user();
        //retrieve the User's bookings using the `bookings()` method in User model
        //$userBookingsDetails = $user->bookings()->paginate(10);
        if($status == 'finished')
        // retrieve the User's bookings with a schedule date before today's date
        $userBookingsDetails = $user->bookings()->whereHas('travelsSchedule', function($query) {
            $query->where('schedule_date','<', Carbon::now()->toDateString());
        })->paginate(5);

        elseif($status == 'not-finished')
        // retrieve the User's bookings with a schedule date After today's date
        //Note: in Date the old date is bigger than the newer one ex : 1990 > 2000
        $userBookingsDetails = $user->bookings()->whereHas('travelsSchedule', function($query) {
            $query->where('schedule_date','>', Carbon::now()->toDateString());
        })->paginate(5);
        return view('appointment',['userBookingsDetails'=> $userBookingsDetails]);
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
    public function store(Request $request,$scheduleId)
    {
        //return view('index');
        //validate request
        $request->validate([
            'number_of_seats' => 'required',
        ]);

        //get the TravelsSchedule details for the trip that user whant to book
        $trip = TravelsSchedule::findOrFail($scheduleId);
        $user = auth()->user();
        $totalPrice = ($trip->price * $request->number_of_seats);
        //make sure that the user have enought money (balance) to book the trip
        if($user->balance >= $totalPrice ){
        //fill the booking object with the travel data
        $newBooking = new Booking;
        $newBooking->user_id = auth()->id();
        $newBooking->travels_schedule_id = $trip->id;
        $newBooking->number_of_seats = $request->number_of_seats;
        $newBooking->price_per_seat = $trip->price;
        $newBooking->total_price = $totalPrice;
        //store the booking that user has made in the database
        $newBooking->save();
        //decrese available_seats
        //$trip->vailable_seats -= $request->number_of_seats;
        // $trip->save();

        /*
        [important] you can acsess to all $newBooking propirties
        (such as these that have default value or autoincrement such id )
        after saving the obkect
        */
           // Get the booking_id
           $bookingId = $newBooking->id;

        // cut the total price from the user balance
        $user->balance -= $totalPrice;
        $user->save();

        $newPayment = new Payment;
        $newPayment->booking_id = $bookingId;
        $newPayment->payment_amount = $totalPrice;
        $newPayment->save();
        Alert::success('Success Title', 'your reservation has made');


        }
        else {
            //tell user that there is no enough balance in his account to book the trip
            Alert::error('Oops...', 'you do not have enought balance');
        }
        //Alert::success('Success!', 'Your request has been processed.');
        return redirect()->route('bookings.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // /*
        // -You can use Eloquent's with() method to eager load the bus relationship
        // for the TravelsSchedule model.
        // -This will retrieve the TravelsSchedule with the given ID,
        //  along with its related bus model.
        // The bus_number attribute of the related bus model can then be
        // accessed using $trip->bus->bus_number.

        // */
        // $tripDetails = TravelsSchedule::with('bus')->findOrFail($id);
        // return view('confirmReservation',['tripDetails'=> $tripDetails]);
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


}
// End of the class
