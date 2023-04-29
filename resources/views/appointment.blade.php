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
    <title>Appointment</title>
</head>

<body>
    <div class="appointmentMain page">
        <div class="header-area">
            <div class="logo"><img src="{{ asset('imgs/logo.png') }}" alt="logo">
            </div>
            <ul class="links">
                <li><a href="#home">Home</a></li>
                <li><a href="#trips">Trips</a></li>
                <li><a href="#">About</a></li>
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
                    <a href="#" class="btn activenow">Completed</a href="#">
                    <a href="#" class="btn">No Completed</a href="#">
                </div>
                <div class="list">
                    <h4 class="title-list">List Of Appointment</h4>
                    <div class="list-content">
                        <h3>App ID</h3>
                        <h3>Bus Id</h3>
                        <h3>starting</h3>
                        <h3>destination</h3>
                        <h3>Date</h3>
                        <h3>Start</h3>
                        <h3>End</h3>

                    </div>
                    <div class="info">
                        <p>1</p>
                        <p>1</p>
                        <p>Latakia</p>
                        <p>Damascus</p>
                        <p>2/2/2023</p>
                        <p>8:00</p>
                        <p>9:00</p>
                    </div>
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
</body>

</html>
