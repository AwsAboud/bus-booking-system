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
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    {{-- sweet alert for confirm cancel popup --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>

    <title>Appointment</title>
</head>

<body>
    <div class="appointmentMain page">
        <div class="header-area">
            <div class="logo"><img src="{{ asset('imgs/logo.png') }}" alt="logo">
            </div>
            <ul class="links">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="#trips">Trips</a></li>
                <li><a href="{{url('about')}}">About</a></li>
                <li><a href="{{url('/contact')}}">Contact</a></li>
            </ul>

            <div class="info-enter">
                @auth
                <div class="dropdown">
                    <button class="dropbtn">{{auth()->user()->name}}</button>
                    <div class="dropdown-content">
                        <a href="#" class="profile">Profile</a>
                        <a href="#" class="appointment">Appointment</a>
                        <a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                @else
                <a href="{{route('login')}}" class="log in">Sign In</a>
                <a href="{{route('register')}}" class="register">Register</a>
                @endauth
            </div>


        </div>
        <div class="container">
            <div class="your-appointment">
                <!-- <h1 class="title-appointment">Your Appointment List :</h1> -->
                <div class="options" id="myDIV">


                    @if($is_completed)
                    <a href="{{url('/bookings/finished')}}" class="btn activenow">Completed</a>
                    <a href="{{url('/bookings/not-finished')}}" class="btn">Not Completed</a>
                    @else
                    <a href="{{url('/bookings/finished')}}" class="btn">Completed</a>
                    <a href="{{url('/bookings/not-finished')}}" class="btn activenow">Not Completed</a>
                    @endif
                </div>
                <div class="list">
                    <h4 class="title-list">List Of Appointment</h4>
                    <div class="list-content">
                        {{-- <h3>Bus Number</h3> --}}
                        <h3>Starting Point</h3>
                        <h3>Destination</h3>
                        <h3>Date</h3>
                        <h3>Start</h3>
                        <h3>End</h3>
                        <h3>Price Per Seat</h3>
                        <h3>Number of Seats</h3>
                        <h3>Booked At </h3>
                        <h3>Totla Price</h3>
                        <h3></h3>

                    </div>
                    @if( ! empty($userBookingsDetails))
                    @foreach($userBookingsDetails as $booking)
                    <div class="info">
                        {{-- حتى جبنا رقم الباص Eloquent لاحظ كيف استخدمنا علاقات ال  --}}
                        {{-- <p>{{$booking->travelsSchedule->bus->bus_number}}</p> --}}
                        {{-- Retrieve the travel details associated with this booking. --}}
                        <p>{{$booking->travelsSchedule->starting_point}}</p>
                        <p>{{$booking->travelsSchedule->destination}}</p>
                        <p>{{$booking->travelsSchedule->schedule_date}}</p>
                        <p>{{$booking->travelsSchedule->departure_time}}</p>
                        <p>{{$booking->travelsSchedule->estimate_arrival_time}}</p>
                        <p>{{$booking->price_per_seat}}</p>
                        <p>{{$booking->number_of_seats}}</p>
                        <p>{{$booking->booking_date}}</p>
                        <p>{{$booking->total_price}}</p>
                        @if(! $is_completed)
                        {{-- /*
                        <form action="{{ route('booking.cancel',$booking->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cancel">Cancel</button>
                        </form>
                        */ --}}
                        {{-- cancel booking --}}
                        {{-- code here --}}
                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" id="cancel-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="cancel">Cancel</button>
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const cancelButtons = document.querySelectorAll('.cancel');

                                function confirmCancellation(event) {
                                    event.preventDefault();

                                    const button = event.target;

                                    Swal.fire({
                                        title: 'Confirmation',
                                        text: 'Are you sure you want to cancel this booking?',
                                        icon: 'question',
                                        showCancelButton: true,
                                        confirmButtonText: 'Yes',
                                        cancelButtonText: 'No'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            const form = button.closest('form');
                                            if (form) {
                                                form.submit();
                                            }
                                        }
                                    });
                                }

                                cancelButtons.forEach(function(button) {
                                    button.addEventListener('click', confirmCancellation);
                                });
                            });
                        </script>




                        @endif
                    </div>
                    @endforeach
                    @endif
                </div>

                <div>
                    {{$userBookingsDetails->links('pagination::custom2')}}
                </div>
            </div>
        </div>
    </div>
    <script>
        let header = document.getElementById("myDIV");
        let btns = header.getElementsByClassName("btn");
        for (let i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                let current = document.getElementsByClassName("activenow");
                current[0].className = current[0].className.replace(" activenow", "");
                this.className += " activenow";
            });
        }
    </script>
    {{-- real rashid sweet alert --}}
    @include('sweetalert::alert')

</body>

</html>
