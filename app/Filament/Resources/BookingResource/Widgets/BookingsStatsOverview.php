<?php

namespace App\Filament\Resources\BookingResource\Widgets;

use Carbon\Carbon;
use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BookingsStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
         //get bookings number in the  current day
         $currentDate = Carbon::now()->toDateString();
         $numberOfCurrentDayBookings = Booking::whereDate('booking_date',$currentDate)->count();
         //get bookings number in the  current month
         $currentMonth = Carbon::now()->month;
         $numberOfCurrentMonthBookings = Booking::whereMonth('booking_date',$currentMonth)->count();
        return [
            //Display the travels number in the  current day
            Card::make('Today\'s Bookings',$numberOfCurrentDayBookings)
            ->description('Todays Bookings')
            ->color('success'),
            //Display the get travels number in the  current month
            Card::make('This Month Bookings',$numberOfCurrentMonthBookings)
            ->description('This Month Bookings')
            ->color('success'),
        ];
    }
}
