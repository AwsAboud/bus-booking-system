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
                <li><a href="#home">Home</a></li>
                <li><a href="#trips">Trips</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <div class="info-enter">
                @auth
                <a href="{{ route('logout') }}" class="log out">logout</a>
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
                <span class="pickup">Latakia</span>
                <span class="date">4/4/2023</span>
                <span class="dropping">Damascus</span>
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
                            <input type="date" name="schedule_date" id="" class="date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" required>
                            <input type="submit" value="Find Ticket" class="submit">
                        </form>
                    </div>
                </div>
                <div class="appointment">
                    <div class="appoint-ticket">
                        <div class="title-trip">Trip</div>
                        <div class="details">
                            <div class="first point">
                                <h3 class="first-packup">Latakia</h3>
                                <span>8:00</span>
                            </div>
                            <i class="fa-solid fa-arrow-right"></i>
                            <div class="second point">
                                <h3 class="second-dropp">Damascus</h3>
                                <span>9:00</span>
                            </div>
                            <a href="" class="reserv">reservation</a>
                        </div>

                    </div>
                    <div class="appoint-ticket">
                        <div class="title-trip">Trip</div>
                        <div class="details">
                            <div class="first point">
                                <h3 class="first-packup">Latakia</h3>
                                <span>8:00</span>
                            </div>
                            <i class="fa-solid fa-arrow-right"></i>
                            <div class="second point">
                                <h3 class="second-dropp">Damascus</h3>
                                <span>9:00</span>
                            </div>
                            <a href="" class="reserv">reservation</a>
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
                    <p>Delectus culpa laboriosam debitis saepe. Commodi earum minus ut obcaecati veniam deserunt est!</p>
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
                        <li><a href="">Contact</a></li>
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
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer -->
</body>

</html>