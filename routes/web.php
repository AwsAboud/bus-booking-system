<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use RealRashid\SweetAlert\Facades\Alert;

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


Route::get('/hash', function () {
    return  Hash::make('adminadmin');
});
Route::view('/contact', 'contact');
Route::view('/about', 'about');
//Route::view('/test','test');
Route::get('/test', [BookingController::class, 'index']);
//search for trips
Route::get('/search-for-trip', [TravelController::class, 'search'])->name('trip.search');
Route::get('/trip-details/{tripId}', [TravelController::class, 'show'])
    ->middleware('auth')->name('trip-details');

Route::post('/book-trip/{scheduleId}', [BookingController::class, 'store'])->name('booking.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');


require __DIR__ . '/auth.php';
