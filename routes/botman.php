<?php
use PharIo\Manifest\Url;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

//$botman = app('botman');
$botman = resolve('botman');
//definr all your bot commands


//hears('hi') it will response only for hi and just hi
// $botman->hears('hi(.*)', function($bot){
//     $bot->reply('hi how can i help yoy ?');
// });



//(.*) is a regular expression match any string
//for example hi bot or hi I am .... i will response


$botman->hears('hello(.*)|hi(.*)', function($bot){
    $bot->reply('hi how can i help you ?');
});

//if any user asked how to get balanec
$botman->hears('(.*)balance(.*)', function($bot){
    $bot->reply('You can add credit either by payment at one of our centers or
                via Syriatel Cash by sending the credit to the number 099. After that,
                kindly send a screenshot of the transfer process to the number 09920.
    ');
});


$botman->hears('weather in {location}', function($bot,$location){
   $url = 'http://api.weatherstack.com/current?access_key=d113d5161de51de47b224f2fc3f81a68&query='.urlencode($location);
   $response = json_decode(file_get_contents($url));
    $bot->reply('The weather in '. $response->location->name . ',' . $response->location->country .  ' is :');
     $bot->reply('Tempreature: '. $response->current->temperature . 'C');
     $bot->reply('Wind speed: '. $response->current->wind_speed);
     $bot->reply('Humidity: '. $response->current->humidity);
     //$bot->reply('Tempreature: '. $response->weather_descriptions);



    //$bot->reply('you interd ' . $location);
});

// $botman->hears('w', function($bot){
//     $url = 'http://api.weatherstack.com/current?access_key=d113d5161de51de47b224f2fc3f81a68&query=London';
//     $response = json_decode(file_get_contents($url));
//      $bot->reply('The weather in '. $response->location->name . ',' . $response->location->country .  ' is :');
//      $bot->reply('Tempreature: '. $response->current->temperature . 'C');
//      $bot->reply('Wind speed: '. $response->current->wind_speed);
//      $bot->reply('Humidity": '. $response->current->humidity);
//      //$bot->reply('Tempreature: '. $response->weather_descriptions);

//      //$bot->reply('you interd ' . $location);
//  });


$botman->hears('(.*)cancel(.*)trip(.*) |(.*)cancel(.*)reservation(.*)|(.*)cancel(.*)', function($bot){
    $bot->reply("to cancel a reservation you can visit the page
    <a  href='http://127.0.0.1:8000/bookings/not-finished' target = '_balank' style ='color:green ; text-decoration:none;'>
    Cancel Reservation
    </a>"
    );
});
//if the bot does not match any hears (if the bot dosent understand the input)
$botman->fallback(function($bot){
   // $url = Url::parse('http://127.0.0.1:8000/contact');
    $bot->reply('Sorry I don\'t understand it ');
    $bot->reply("For something else, you can visit the page
                <a  href='http://127.0.0.1:8000/contact' target = '_balank' style ='color:green ; text-decoration:none;' >
                Contact Us
                </a>
                to get in touch.
     ");
});
