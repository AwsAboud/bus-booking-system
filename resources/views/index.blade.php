<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main File Css -->
    <link rel="stylesheet" href="{{asset('assets/css/master.css')}}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Georama:wght@300;400&display=swap" rel="stylesheet">
    <title>bus booking</title>

</head>

<body>
    <!-- Start Landing Page -->
    <div class="landing-page">
        <div class="header-area">
            <div class="logo"><img src="{{ asset('imgs/logo.png') }}" alt="logo">
            </div>
            <ul class="links">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <div class="info-enter">
                <a href="#" class="login">Sign In</a>
                <a href="#" class="sign">Sign Up</a>
            </div>
        </div>
        <div class="container">
            <div class="banner">
                <div class="banner-left">
                    <h1 class="title">Get Your Ticket Online, Easy and Safely</h1>
                    <a href="">Get Ticket Now</a>
                </div>
                <div class="banner-right">
                    <h4 class="title">Choose Your Ticket:</h4>
                    <div class="tab-content">
                        <form action="">
                            <input list="pickup" name="pickup" placeholder="Pickup Point">
                            <datalist id="pickup">
                                <option value="Latakia">
                                <option value="Aleppo">
                                <option value="Damascus">
                                <option value="Homs">
                            </datalist>
                            <input list="dropping" name="dropping" placeholder="Dropping Point">
                            <datalist id="dropping">
                                <option value="Latakia">
                                <option value="Aleppo">
                                <option value="Damascus">
                                <option value="Homs">
                            </datalist>
                            <input type="date" name="date" id="" class="date" min="<?php echo date('Y-m-ad'); ?>" max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
                            <input type="submit" value="Find Ticket" class="submit">
                        </form>
                    </div>
                </div>
            </div>
            <div class="long-image">
                <img src="{{ asset('imgs/longImage.png') }}" alt="">
                <img src="{{ asset('imgs/bus.png') }}" alt="" class="bus">
            </div>

        </div>
    </div>
    <!-- End Landing Page -->
</body>

</html>