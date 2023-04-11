<?php

namespace App\Filament\Resources\PaymentResource\Widgets;

use Carbon\Carbon;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PaymentsStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        //get the payment amount in the current day
         $currentDate = Carbon::now()->toDateString();
         $paymentAmountOfCurrentDay = Payment::whereDate('payment_date',$currentDate)->count();
         //get the payment amount in the current month
         $currentMonth = Carbon::now()->month;
         $paymentAmountOfCurrentMonth = Payment::whereMonth('payment_date',$currentMonth)->count();
        return [
            //Display the payment amount in the current month
            Card::make('Today\'s Earnings',$paymentAmountOfCurrentDay)
            ->description('Todays Earnings')
            ->color('success'),
            //Display the payment amount in the current day
            Card::make('This Month Earnings',$paymentAmountOfCurrentMonth)
            ->description('This Month Earnings')
            ->color('success'),
        ];
    }
}
