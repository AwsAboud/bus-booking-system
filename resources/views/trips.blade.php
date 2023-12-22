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
    <title>trips</title>
</head>

<body>
    <div class="trips page">
        <div class="header-area">
            <div class="logo"><img src="{{ asset('imgs/logo.png') }}" alt="logo">
            </div>
            <ul class="links">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="#trips">Trips</a></li>
                <li><a href="{{url('about')}}">About</a></li>
                <li><a href="{{url('contact')}}">Contact</a></li>
            </ul>
            <div class="info-enter">
                @auth
                <form action="{{route('logout')}}" method="POST">
                    <a href="{{ route('logout') }}" class="log out">logout</a>
                </form>
                @endauth
                @guest
                <a href="{{ route('login') }}" class="log in">Sign In</a>
                <a href="{{ route('register') }}" class="register">Register</a>

                @endguest
            </div>
        </div>
        <div class="bg-trips">
            <div class="arrow-bus">
                <img src="{{ asset('imgs/Group.png') }}" alt="">
                {{--
                    we only need the first item from the $avaliableTrips collection
                    to retrieve starting_point,destination and date to put them in the header image.
                --}}
                {{-- @if(isset($avaliableTrips) && count($avaliableTrips) > 0)) --}}

                {{-- if the $avaliableTrips not empty --}}
                @if( ! $avaliableTrips->isEmpty() )
                <span class="pickup">{{$avaliableTrips[0]->starting_point}}</span>
                <span class="date">{{$avaliableTrips[0]->schedule_date}}</span>
                <span class="dropping">{{$avaliableTrips[0]->destination}}</span>
                @endif
            </div>

        </div>
    </div>
    <div class="trips-banner">
        <div class="container">
            <div class="ticket">
                <div class="banner-right">
                    {{-- search for trips --}}
                    <div class="tab-content">
                        <form action="{{route('trip.search')}}" method="GET">
                            @csrf
                            <input list="pickup" name="starting_point" placeholder="Pickup Point" required>
                            <datalist id="pickup">
                                <option value="Latakia">
                                <option value="Aleppo">
                                <option value="Damascus">
                                <option value="Homs">
                                <option value="Hama">
                                <option value="Tartous">
                            </datalist>
                            <input list="dropping" name="destination" placeholder="Dropping Point" required>
                            <datalist id="dropping">
                                <option value="Latakia">
                                <option value="Aleppo">
                                <option value="Damascus">
                                <option value="Homs">
                                <option value="Hama">
                                <option value="Tartous">
                            </datalist>
                            <input type="date" name="schedule_date" id="" class="date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+10 days')); ?>" required>
                            <input type="submit" value="Find Ticket" class="submit">
                        </form>
                    </div>
                </div>
                <div class="appointment">
                    <div class="appoint-ticket">
                        {{-- retreive availabe trips from database --}}
                        @if(count($avaliableTrips) > 0)
                        @foreach($avaliableTrips as $trip)
                            <div class="title-trip">Trip</div>
                            <div class="details">
                                <div class="first point">
                                    <h3 class="first-packup">{{$trip->starting_point }}</h3>
                                    <span>{{date('g:ia',strtotime($trip->departure_time))}}</span>
                                </div>
                                <div class="midle point">
                                    <i class="fa-solid fa-arrow-right"></i>
                                    <span class="date">{{$trip->schedule_date }}</span>
                                </div>
                                <div class="second point">
                                    <h3 class="second-dropp">{{$trip->destination }}</h3>
                                    <span>{{date('g:ia',strtotime($trip->estimate_arrival_time))}}</span>
                                </div>
                                <div class="four">
                                    <a href="{{ route('trip-details', ['trip' => $trip->id]) }}" class="reserv">reservation</a>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <div class="title-trip">Trip</div>
                        <div class="details">
                                <p style="text-align:center;font-weight: bold;">No bus trips are available at the moment. Please check again later.</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Start Footer -->
    <div class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="social">
                    <div class="logo">
                        <img src="{{ asset('imgs/logo.png') }}" alt="logo">
                    </div>
                    <p>We will be happy if you follow our company on social media</p>
                    <div class="icons">
                        <a href="https://www.facebook.com"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.twitter.com"><i class="fa-brands fa-twitter"></i></a>
                        <a href="htpps://www.instagram.com"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                <div class="useful-links all">
                    <h2 class="title-footer">Usefil Links</h2>
                    <ul class="footer-links">
                        <li><a href="">Home</a></li>
                        <li><a href="#trips">Trips</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="{{url('/contact')}}">Contact</a></li>
                    </ul>
                </div>
                <div class="policies all">
                    <h2 class="title-footer">Policies</h2>
                    <ul class="footer-links">
                        <li><a href="">Privacy Policy</a></li>
                        <li><a href="">Terms and Conditions</a></li>
                        <li><a href="">Ticket Policies</a></li>
                        <li><a href="">Refund Policy</a></li>
                    </ul>
                </div>
                <div class="contact-info all">
                    <h2 class="title-footer">Contact Info</h2>
                    <ul class="footer-links">
                        <li><a href="">Syria Latakia</a></li>
                        <li><a href="">+963932048737</a></li>
                        <li><a href="">luqman1it@gmail.com</a></li>
                        <li><a href="">awsaboud7@gmail.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer -->
</body>

</html>
