<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//The main page
Route::get('/', function () {
    return view('index');
})->name('home');


Route::view('/contact', 'contact');
//Route::view('/bookings', 'appointment');
Route::view('/about', 'about');

Route::post('/send-message', [MessageController::class, 'store'])->name('message.store');

Route::middleware('auth')->group(function () {
    //Route::view('/test','test');
    Route::get('/bookings/{status?}', [BookingController::class, 'index'])->name('bookings.index');
    //search for trips
    Route::get('/search-for-trip', [TravelController::class, 'search'])->name('trip.search');
    Route::get('/trip-details/{trip}', [TravelController::class, 'show'])->name('trip-details');

    Route::post('/book-trip/{trip}', [BookingController::class, 'store'])->name('booking.store');
    //cancel booking
    Route::delete('/cancel-booking/{booking}', [BookingController::class, 'cancelBooking'])->name('booking.cancel');
    //profile
    Route::view('/user-profile', 'profile');

});


Route::get('/hash', function () {
    return  Hash::make('adminadmin');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//botman
Route::post('/botman', function () {
    app('botman')->listen();
});





require __DIR__ . '/auth.php';
