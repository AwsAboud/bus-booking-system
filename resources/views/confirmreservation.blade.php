<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main File Css -->
    <link rel="stylesheet" href="{{asset('assets/css/master.css')}}">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Georama:wght@300;400&display=swap" rel="stylesheet">
    <!-- Sweet Alert CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">

    <!-- Sweet Alert JS -->
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>

    <title>ConfirmReservation</title>
</head>

<body>
    <!-- Start Page Confirm -->
    <div class="confirm">
        <div class="container">
            <div class="form-left">
                <h1>Confirm Reservation</h1>
                <div class="packge">
                    <h3 class="name">Name :</h3>
                    <span class="">{{auth()->user()->name}}</span>
                </div>
                <div class="packge">
                    <h3 class="name">Phone :</h3>
                    <span class="">{{auth()->user()->phone_number}}</span>
                </div>
                <div class="packge">
                    <h3 class="name">Pickup Point :</h3>
                    <span class="">{{$tripDetails->starting_point}}</span>
                </div>
                <div class="packge">
                    <h3 class="name">Dropping Point :</h3>
                    <span class="">{{$tripDetails->destination}}</span>
                </div>
                <div class="packge">
                    <h3 class="name">Date :</h3>
                    <span class="">{{$tripDetails->schedule_date}}</span>
                </div>
                <div class="packge">
                    <h3 class="name">Start :</h3>
                    <span class="">{{date('g:ia',strtotime($tripDetails->departure_time))}}</span>
                </div>
                <div class="packge">
                    <h3 class="name">End :</h3>
                    <span class="">{{date('g:ia',strtotime($tripDetails->estimate_arrival_time))}}</span>
                </div>
                <div class="packge">
                    <h3 class="name">Bus Number :</h3>
                    <span class="">{{$tripDetails->bus->bus_number}}</span>
                </div>
                <div class="packge">
                    <h3 class="name">Price Per Seat :</h3>
                    <span class="">{{$tripDetails->price . ' S.P'}} </span>
                </div>
                <div class="packge">
                    <h3>Number Of Seats</h3>
                    <form action="{{route('booking.store',['trip' => $tripDetails->id])}}" method="post">
                        @csrf
                        <input class="number" type="number" name="number_of_seats" id="" min="1" max="5" value="1">

                </div>
                <input type="submit" class="continue" value="confirm">
                {{-- <button class="continue">Continue</button> --}}
                </form>
            </div>
        </div>
    </div>
    <!-- End Page Confirm -->
    @include('sweetalert::alert')

</body>

</html>
