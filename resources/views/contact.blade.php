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
    <title>Contact</title>
</head>

<body>
    <!-- Start Page Contact -->
    <div class="contact">
        <div class="bgcontact">
            <h1 class="title-contact">Contact Us</h1>
        </div>
        <div class="container">
            <div class="head">
                <h2>Let's get in touch</h2>
                <p>We are open for any suggestion or just to have a chat</p>
            </div>
            <div class="info">
                <div class="box">
                    <h3 class="address">Our Address</h3>
                    <p>Syria Latakia</p>
                </div>
                <div class="box">
                    <h3 class="call">Call Us</h3>
                    <p>+963932048737</p>
                </div>
                <div class="box">
                    <h3 class="email">Email Us</h3>
                    <p>awsaboud7@gmail.com</p>
                    <p>luqman1it@gmail.com</p>
                </div>
            </div>
            <div class="contact-form">
                <form action="{{route('message.store')}}" method="POST">
                    @csrf
                    <h4 class="contact-title">Have any Questions?</h4>
                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" name="name" id="name" class="form-input" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject :</label>
                        <input type="text" name="title" id="subject" class="form-input" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" name="email" id="email" class="form-input" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone :</label>
                        <input type="text" name="phone" id="phone" class="form-input" placeholder="Phone">
                    </div>
                    <div class="form-group">
                        <label for="msg">msg :</label>
                        <textarea name="message_body" id="msg" cols="30" rows="10" placeholder="Your Msg"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Send Us Message" class="submit-contact">
                    </div>
                </form>
                <div class="image-contact">
                    <img src="{{ asset('imgs/problem2.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Contact -->

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
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="#trips">Trips</a></li>
                        <li><a href="{{url('about')}}">About</a></li>
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
                        <li><a href="">aws.amin.aboud@gmail.com</a></li>
                        <li><a href="">awsaboud7@gmail.com</a></li>
                        <li><a href="">luqman1it@gmail.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer -->

    <!-- <script src="{{ asset('javascript/master.js') }}"></script> -->
</body>

</html>
