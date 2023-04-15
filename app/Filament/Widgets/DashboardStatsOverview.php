<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\TravelsSchedule;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

//display charts on the main dashboard
class DashboardStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
         //get the payment amount in the current day
         $currentDate = Carbon::now()->toDateString();
         $paymentAmountOfCurrentDay = Payment::whereDate('payment_date',$currentDate)->count();

         //get the payment amount in the current month
         $currentMonth = Carbon::now()->month;
         $paymentAmountOfCurrentMonth = Payment::whereMonth('payment_date',$currentMonth)->count();

         //get travels number in the  current day
        $currentDate = Carbon::now()->toDateString();
        $numberOfCurrentDayTravels = TravelsSchedule::whereDate('schedule_date', $currentDate)->count();

        //get travels number in the  current month
        $currentMonth = Carbon::now()->month;
        $numberOfCurrentMonthTravels = TravelsSchedule::whereMonth('schedule_date', $currentMonth)->count();

        //get bookings number in the  current day
        $currentDate = Carbon::now()->toDateString();
        $numberOfCurrentDayBookings = Booking::whereDate('booking_date',$currentDate)->count();

        //get bookings number in the  current month
        $currentMonth = Carbon::now()->month;
        $numberOfCurrentMonthBookings = Booking::whereMonth('booking_date',$currentMonth)->count();
        return [
            //get the number of drivers in the company
            Card::make('Total Drivers', Driver::all()->count())
            ->description('Total Drivers')
            ->color('success')
            ->extraAttributes([
                     'onclick' => 'window.open("http://127.0.0.1:8000/admin/bookings","_self")',

            ]),

            //get the number of buses in the company
             Card::make('Total Buses', Bus::all()->count())
             ->description('Total Buses')
             ->color('success')
             ->extraAttributes([
                // go to buses bage
                'onclick' => 'window.open("http://127.0.0.1:8000/admin/buses","_self")'

        ]),

             //get the number of  the company Customers
            Card::make('Total Customers', Customer::all()->count())
            ->description('Total Customers')
            ->color('success')
            ->extraAttributes([
                // go to customers bage
                'onclick' => 'window.open("http://127.0.0.1:8000/admin/customers","_self")'

        ]),

            //Display the payment amount in the current month
            Card::make('Today\'s Earnings',$paymentAmountOfCurrentDay. ' $')
            ->description('Todays Earnings')
            ->color('success')
            ->extraAttributes([
                // go to payments bage
                'onclick' => 'window.open("http://127.0.0.1:8000/admin/payments","_self")'

        ]),

            //Display the payment amount in the current day
            Card::make('This Month Earnings',$paymentAmountOfCurrentMonth . ' $')
            ->description('This Month Earnings')
            ->color('success')
            ->extraAttributes([
                // go to payments bage
                'onclick' => 'window.open("http://127.0.0.1:8000/admin/payments","_self")'

        ]),

            //Display the travels number in the  current day
            Card::make('Today\'s Travels',$numberOfCurrentDayTravels)
            ->description('Todays Travels')
            ->color('success')
            ->extraAttributes([
                // go to travels bage
                'onclick' => 'window.open("http://127.0.0.1:8000/admin/travels-schedules ","_self")'

        ]),

            //Display the get travels number in the  current month
            Card::make('This Month Travels', Driver::all()->count())
            ->description('This Month Travels')
            ->color('success')
            ->extraAttributes([
                // go to travels bage
                'onclick' => 'window.open("http://127.0.0.1:8000/admin/travels-schedules ","_self")'

        ]),

            //Display the bookings number in the  current day
            Card::make('Today\'s Bookings',$numberOfCurrentDayBookings)
            ->description('Todays Bookings')
            ->color('success')
            ->extraAttributes([
                // go to bookings bage
                'onclick' => 'window.open("http://127.0.0.1:8000/admin/bookings ","_self")'

        ]),

            //Display the bookings number in the  current month
            Card::make('This Month Bookings',$numberOfCurrentMonthBookings)
            ->description('This Month Bookings')
            ->color('success')
            ->extraAttributes([
                // go to bookings bage
                'onclick' => 'window.open("http://127.0.0.1:8000/admin/bookings ","_self")'

        ]),

        ];
    }
}
