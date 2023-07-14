<?php

namespace App\Filament\Widgets;

use App\Models\TravelsSchedule;
use Carbon\Carbon;
//use App\Models\User;
use Filament\Widgets\BarChartWidget;

class TravelsNumbersPerMonth extends BarChartWidget
{
    protected static ?string $heading = 'Travels Count';


//     protected function getData(): array
// {
//     $travels = TravelsSchedule::select('created_at')->get()->groupBy(function($travel) {
//         return Carbon::parse($travel->created_at)->format('F');
//     });
//     $quantities = [];
//     foreach ($travels as $travel => $value) {
//         array_push($quantities, $value->count());
//     }
//     return [
//         'datasets' => [
//             [
//                 'label' => 'Travels Count',
//                 'data' => $quantities,
//                 'backgroundColor' => [
//                     'rgba(255, 99, 132, 0.2)',
//                     'rgba(255, 159, 64, 0.2)',
//                     'rgba(255, 205, 86, 0.2)',
//                     'rgba(75, 192, 192, 0.2)',
//                     'rgba(54, 162, 235, 0.2)',
//                     'rgba(153, 102, 255, 0.2)',
//                     'rgba(201, 203, 207, 0.2)'
//                 ],
//                 'borderColor' => [
//                     'rgb(255, 99, 132)',
//                     'rgb(255, 159, 64)',
//                     'rgb(255, 205, 86)',
//                     'rgb(75, 192, 192)',
//                     'rgb(54, 162, 235)',
//                     'rgb(153, 102, 255)',
//                     'rgb(201, 203, 207)'
//                 ],
//                 'borderWidth' => 1
//             ],
//         ],
//         'labels' => $travels->keys(),
//     ];
// }

protected function getData(): array
{
    $travels = TravelsSchedule::select('created_at')->get()->groupBy(function($travel) {
        return Carbon::parse($travel->created_at)->month;
    })->sortKeys();
    $quantities = [];
    foreach ($travels as $travel => $value) {
        array_push($quantities, $value->count());
    }
    return [
        'datasets' => [
            [
                'label' => 'Travels Count',
                'data' => $quantities,
                'backgroundColor' => [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                'borderColor' => [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                'borderWidth' => 1.5
            ],
        ],
        'labels' => $travels->keys()->map(function ($monthNumber) {
            return Carbon::createFromDate(null, $monthNumber, null)->format('F');
        }),
    ];
}
}
