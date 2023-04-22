<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=E, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(count($avaliableTrips) > 0)
  <ul>
    @foreach($avaliableTrips as $trip)
      <li>{{ $trip->starting_point }} to {{ $trip->destination }} on {{ $trip->schedule_date }}</li>
    @endforeach
  </ul>
@else
  <p>No bus trips found.</p>
@endif

dy>
    @if(count($userBookings) > 0)
  <ul>
    @foreach( $userBookings as $userBooking)
      <li>{{ $userBooking->starting_point }} to {{ $userBooking->destination }} on {{ $userBooking->schedule_date }}</li>
    @endforeach
  </ul>
@else
  <p>No bus trips found.</p>
@endif
</body>
</html>
