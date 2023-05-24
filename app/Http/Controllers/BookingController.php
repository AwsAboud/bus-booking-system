<?php

namespace App\Http\Controllers;

use DateTime;
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
        $is_completed = true;
        $user = Auth::user();
        //retrieve the User's bookings using the `bookings()` method in User model
        //$userBookingsDetails = $user->bookings()->paginate(10);
        if($status == 'finished'){
        // retrieve the User's bookings with a schedule date before today's date
        $is_completed = true;
        $userBookingsDetails = $user->bookings()->whereHas('travelsSchedule', function($query) {
            $query->where('schedule_date','<', Carbon::now()->toDateString());
        })->paginate(5);
    }

        elseif($status == 'not-finished'){
        // retrieve the User's bookings with a schedule date After today's date
        //Note: in Date the old date is bigger than the newer one ex : 1990 > 2000
        $is_completed = false;
        $userBookingsDetails = $user->bookings()->whereHas('travelsSchedule', function($query) {
            $query->where('schedule_date','>', Carbon::now()->toDateString());
        })->paginate(5);
    }
        return view('appointment',['userBookingsDetails' => $userBookingsDetails,'is_completed' => $is_completed]);
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
        $trip->vailable_seats -= $request->number_of_seats;
        $trip->save();

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
        Alert::success('Success Title', 'you can cancel your reservation without any cut
                                         after one hour we will cut 20% from total price
                                         after three houres we will cut 100%  from totlal price
                        ');


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

    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);

        //add the canceld seats to travelSchedule
        $trip = TravelsSchedule::findOrFail($booking->travels_schedule_id);
        $trip->available_seats += $booking->number_of_seats;
        $trip->save();

        $payment = Payment::where('booking_id',$id)->first();
        // check the time to cut the correct amount from the use
        /*
            To get the difference in minutes between $PaymentTime and $currentTime,
            you can use the diff() method of the DateTime class which returns
            a DateInterval object representing the difference between two dates or times.
        */
        $PaymentTime = new DateTime($payment->created_at);
        $currentTime = new DateTime(now());
        $interval = $PaymentTime->diff($currentTime);
        $minutes_diff = $interval->i;
        //retrieve the current authenticated user's object
        $user = auth()->user();
        //less than one hour cut nothing
        if($minutes_diff < 60){
            //add the payment amount for the booking to user balance
            $user->balance += $payment->amount;
            $user->save();
            $payment->amount = 0;
            $payment->save();

        }

        //between one hour and two hours  cut 30% (return 70% to user)
        elseif($minutes_diff < 60 * 2 ){
            $cttingAmount = ($payment->amount * 30 /100);
            $user->balance +=  ($payment->amount - $cttingAmount);
            $user->save();
            $payment->amount = $cttingAmount;
            $payment->save();
        }
        //more than two hours  cut 100%
        else {

        }

    }

}
// End of the class
