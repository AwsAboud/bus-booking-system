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
    <title>Profile</title>
</head>

<body>
    <div class="profile page">
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
                        <a href="prof" class="profile">Profile</a>
                        <a href="{{route('bookings.index')}}" class="appointment">Appointment</a>
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
            <div class="content">
                <div class="image">
                    <img src="{{ asset('imgs/Avatar-Profile-Vector.png') }}" alt="">
                </div>
                <div class="info-profile">
                    <div class="box">
                        <i class="fa-solid fa-signature"></i>
                        <h1 class="head">Name</h1>
                        <p class="words">luqman</p>
                    </div>
                    <div class="box">
                        <i class="fa-solid fa-envelope"></i>
                        <h1 class="head">Email</h1>
                        <p class="words">luqman1it@gmail.com</p>
                    </div>
                    <div class="box">
                        <i class="fa-solid fa-phone"></i>
                        <h1 class="head">Phone</h1>
                        <p class="words">0000000000</p>
                    </div>
                    <div class="box">
                        <i class="fa-solid fa-coins"></i>
                        <h1 class="head">Balance</h1>
                        <p class="words">200000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>