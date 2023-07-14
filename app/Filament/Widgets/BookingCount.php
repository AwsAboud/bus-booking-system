<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Booking;
use Filament\Widgets\BarChartWidget;

class BookingCount extends BarChartWidget
{
    protected static ?string $heading = 'Bookings Count';

    protected function getData(): array
    {
        $bookings = Booking::select('created_at')->get()->groupBy(function($booking) {
            return Carbon::parse($booking->created_at)->month;
        })->sortKeys();
        $quantities = [];
        foreach ($bookings as $booking => $value) {
            array_push($quantities, $value->count());
        }
        return [
            'datasets' => [
                [
                    'label' => 'Bookings',
                    'data' => $quantities,
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',


                    ],
                    'borderColor' => [
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',

                    ],
                    'borderWidth' => 1.5
                ],
            ],
            'labels' => $bookings->keys()->map(function ($monthNumber) {
                return Carbon::createFromDate(null, $monthNumber, null)->format('F');
            }),
        ];
    }
}
