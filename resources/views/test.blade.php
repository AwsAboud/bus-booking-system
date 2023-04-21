<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=E, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(count($avaliable_trips) > 0)
  <ul>
    @foreach($avaliable_trips as $trip)
      <li>{{ $trip->starting_point }} to {{ $trip->destination }} on {{ $trip->schedule_date }}</li>
    @endforeach
  </ul>
@else
  <p>No bus trips found.</p>
@endif
</body>
</html>
