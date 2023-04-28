<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=E, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- @if( isset($avaliableTrips))
  <ul>
    @foreach($avaliableTrips as $trip)
      <li>{{ $trip->starting_point }} to {{ $trip->destination }} on {{ $trip->schedule_date }}</li>
    @endforeach
  </ul>
@else
  <p>No bus trips found.</p>
@endif --}}
@if( ! empty($userBookingsDetails))
    @foreach( $userBookingsDetails as $bookDetils )
        total :{{$bookDetils->total_price}}
        {{--
            / Retrieve the travel details associated with this booking.
             $travel_details = $booking->travelsSchedule;

        // You can now use the `$travel_details` variable to access the booking's travel details.
        // For example:
        echo $travel_details->starting_point . '<br>';
     echo $travel_details->destination . '<br>';
            --}}
    @endforeach
@else
  <p> You do not made any booking </p>
@endif

</body>
</html>
