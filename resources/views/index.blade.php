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

    <title>bus booking</title>

</head>

<body>
    <!-- Start Landing Page -->
    <div class="landing-page page" id="home">
        <div class="header-area">
            <div class="logo"><img src="{{ asset('imgs/logo.png') }}" alt="logo">
            </div>
            <ul class="links">
                <li><a href="#home">Home</a></li>
                <li><a href="#trips">Trips</a></li>
                <li><a href="{{url('about')}}">About</a></li>
                <li><a href="{{url('/contact')}}">Contact</a></li>
            </ul>

            <div class="info-enter">
                @auth
                <div class="dropdown">
                    <button class="dropbtn">{{auth()->user()->name}}</button>
                    <div class="dropdown-content">
                        <a href="{{url('user-profile')}}" class="profile">profile</a>
                        <a href="{{route('bookings.index')}}" class="appointment">My Reservation</a>
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
            <div class="banner">
                <div class="banner-left">
                    <h1 class="title">Get Your Ticket Online, Easy and Safely</h1>
                    <a href="#">Get Ticket Now</a>
                </div>
                <div class="banner-right">
                    <h4 class="title">
                        {{-- get the user name if the user was authenticated --}}
                        @auth
                        Hi
                        <span style="color:forestgreen">{{auth()->user()->name}}</span> !
                        @endauth
                        Choose Your Ticket:
                    </h4>
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
                            <input type="date" name="schedule_date" id="" class="date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+10 days')); ?>">
                            <input type="submit" value="Find Ticket" class="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="long-image">
            <img src="{{ asset('imgs/longImage.png') }}" alt="">
            <img src="{{ asset('imgs/bus.png') }}" alt="" class="bus">
        </div>
    </div>
    <!-- End Landing Page -->

    <!-- Start Cities-Images -->
    <div class="images-page" id="trips">
        <div class="container">
            <div class="main-heading">
                <h1>Travel with us</h1>
                <p>Choose the place you want to travel to</p>
            </div>
            <div class="images-container">
                <div class="box">
                    <img src="{{ asset('imgs/latakia1.jpg') }}" alt="">
                    <div class="content">
                        <h2>Latakia</h2>
                        <p>See More</p>
                    </div>
                </div>
                <div class="box">
                    <img src="{{ asset('imgs/aleppo1.jpg') }}" alt="">
                    <div class="content">
                        <h2>Aleppo</h2>
                        <p>See More</p>
                    </div>
                </div>
                <div class="box">
                    <img src="{{ asset('imgs/damascus1.jpg') }}" alt="">
                    <div class="content">
                        <h2>Damascus</h2>
                        <p>See More</p>
                    </div>
                </div>
                <div class="box">
                    <img src="{{ asset('imgs/homs1.jpg') }}" alt="">
                    <div class="content">
                        <h2>Homs</h2>
                        <p>See More</p>
                    </div>
                </div>
                <div class="box">
                    <img src="{{ asset('imgs/hama1.jpg') }}" alt="">
                    <div class="content">
                        <h2>Hama</h2>
                        <p>See More</p>
                    </div>
                </div>
                <div class="box">
                    <img src="{{ asset('imgs/tartous1.jpg') }}" alt="">
                    <div class="content">
                        <h2>Tartous</h2>
                        <p>See More</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cities=Images -->

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
                        <li><a href="{{url('about')}}">About</a></li>
                        <li><a href="{{url('contact')}}">Contact</a></li>
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
    <!-- <script src="{{ asset('javascript/master.js') }}"></script> -->
    @include('sweetalert::alert')
    <script>
        var botmanWidget = {
            title: 'Viser Bus',
            // mainColor: '#008866',
            //bubbleBackground: '#FF5733',
            //aboutText: 'Created by Aws ',
        };
    </script>
    <!-- Bootman widget -->
    <div>
        <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
    </div>

    {{-- botman web widget --}}
    {{-- <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script> --}}
</body>
@guest
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    let tabContent = document.querySelectorAll(".tab-content form input");
    let getTicketNow = document.querySelector(".banner .banner-left a");

    function AlertFunction() {
        swal("You Are Not Registered!", "Please Register");
    }

    tabContent.forEach((ele) => {
        ele.addEventListener("click", AlertFunction);
    })

    getTicketNow.addEventListener("click", AlertFunction)
</script>
@endguest

</html>
