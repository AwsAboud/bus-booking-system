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
use Illuminate\Database\Eloquent\SoftDeletes;


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
        $is_completed = true;
        //Retrieve the Current Authenticated User
        $user = Auth::user();
        // retrieve the User's bookings with a schedule date before today's date
        if($status == 'finished'){
        $is_completed = true;
        $userBookingsDetails = $user->bookings()->whereHas('travelsSchedule', function($query) {
            $query->where('schedule_date','<', Carbon::now()->toDateString());
        })
        ->latest()
        ->paginate(5);
    }

        elseif($status == 'not-finished'){
        // retrieve the User's bookings with a schedule date After today's date
        //Note: in Date the old date is bigger than the newer one ex : 1990 > 2000
        $is_completed = false;
        $userBookingsDetails = $user
        ->bookings()
        ->whereHas('travelsSchedule', function($query) {
            $query->where('schedule_date','>', Carbon::now()->toDateString());
        })
        ->latest()
        ->paginate(5);
    }
        return view('appointment',['userBookingsDetails' => $userBookingsDetails,'is_completed' => $is_completed]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBooking($id){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,TravelsSchedule $trip)
    {
        //This function need to update it is so massy and violate SRP

        //validate request
        $request->validate([
            'number_of_seats' => 'required',
        ]);

        //get the TravelsSchedule details for the trip that user whant to book
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
        $trip->available_seats -= $request->number_of_seats;
        $trip->save();
        $bookingId = $newBooking->id;

        // cut the total price from the user balance
        $user->balance -= $totalPrice;
        $user->save();

        $newPayment = new Payment;
        $newPayment->booking_id = $bookingId;
        $newPayment->payment_amount = $totalPrice;
        $newPayment->save();
        Alert::success('Success Title', 'your reservation has made');
        Alert::success('your reservation has made', 'you can cancel your reservation without be any cut within one houre,
                                         after one hour and within 24 we will cut 20% from total price,
                                         after 24 houres we will cut 100%  from totlal price
                ');
        }
        else {
            //tell user that there is no enough balance in his account to book the trip
            Alert::error('Oops...', 'you do not have enought balance');
        }
        return redirect()->route('bookings.index');
    }

    public function cancelBooking(Booking $booking ){
        //This function need to update it is so massy and violate SRP

        //add the canceld seats to travelSchedule
        $trip = TravelsSchedule::findOrFail($booking->travels_schedule_id);
        $trip->available_seats += $booking->number_of_seats;
        $trip->save();

        $payment = Payment::where('booking_id',$booking->id)->first();
        $PaymentTime = new DateTime($payment->created_at);
        //get the difference in minutes
        $currentTime = new DateTime(now());
        $interval = $PaymentTime->diff($currentTime);
        $hours_diff = $interval->h;
        //retrieve the current authenticated user's object
        $user = auth()->user();
        //within one hour cut nothing
        if($hours_diff < 1){
            //add the payment amount for the booking to user balance
            $user->balance += $payment->payment_amount;
            $user->save();
            $payment->payment_amount = 0;
            $payment->save();
            Alert::success('Canceld Successfully', 'We return  all the payment amount money to your balance ');
        }

        //within 24 hours  cut 30% (return 70% to user)
        else if($hours_diff < 24 ){
            $cttingAmount = ($payment->payment_amount * 30 /100);
            $user->balance +=  ($payment->payment_amount - $cttingAmount);
            $user->save();
            $payment->payment_amount = $cttingAmount;
            $payment->save();
            Alert::success('Canceld Successfully', 'We cut 30% from total payment amount ');
        }
        //more than 24 hours  cut 100%
        else if($hours_diff > 24 ) {
            Alert::success('Canceld Successfully', 'We cut 100% from total payment amount');


        }
        //SOFT DELETE THE BOOKING RECORD
        $booking->delete();
        return redirect('/bookings');

    }


}
// End of the class
