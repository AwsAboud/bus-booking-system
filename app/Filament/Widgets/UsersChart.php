<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\User;
use Filament\Widgets\LineChartWidget;

class UsersChart extends LineChartWidget
{
    protected static ?string $heading = 'Users Joined';

    // protected function getData(): array
    // {
    //     $users = User::select('created_at')->get()->groupBy(function($users) {
    //         return Carbon::parse($users->created_at)->format('F');
    //     });
    //     $quantities = [];
    //     foreach ($users as $user => $value) {
    //         array_push($quantities, $value->count());
    //     }
    //     return [
    //         'datasets' =>[
    //             [
    //                 'label' => 'Users',
    //                 'data' =>$quantities,
    //                 'fill' => false,
    //                 'borderColor' => 'rgb(75, 192, 192)',
    //                 'tension' => 0.1
    //             ],
    //      ],
    //      'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    //     ];
    // }
//     protected function getData(): array
// {
//     $users = User::select('created_at')->get()->groupBy(function($users) {
//         return Carbon::parse($users->created_at)->format('F');
//     });

//     $quantities = [];
//     $labels = [];

//     // Loop through the months and add the user count to the quantities array
//     // If there are no users for a particular month, add a zero to the quantities array
//     foreach (range(1, 12) as $month) {
//         $monthName = Carbon::createFromDate(null, $month, 1)->format('F');
//         $label = $monthName;

//         if (isset($users[$monthName])) {
//             $count = $users[$monthName]->count();
//             array_push($quantities, $count);
//         } else {
//             array_push($quantities, 0);
//         }

//         array_push($labels, $label);
//     }

//     return [
//         'datasets' => [
//             [
//                 'label' => 'Users',
//                 'data' => $quantities,
//                 'fill' => false,
//                 'borderColor' => 'rgb(75, 192, 192)',
//                 'tension' => 0.1
//             ]
//         ],
//         'labels' => $labels
//     ];
//  }
    protected function getData(): array
    {
        $users = User::select('created_at')->get()->groupBy(function($users) {
            return Carbon::parse($users->created_at)->format('F');
        });

        $quantities = [];
        $labels = [];

        // Loop through the months until the current month and add the user count to the quantities array
        // If there are no users for a particular month, add a zero to the quantities array
        $currentMonth = Carbon::now()->month;
        // this is to calculate the  total users exsist in each mounth
        //if you what the number of users that joined evey mouth (not the total number)
        //you can comment the line 88 & 94 ($totalUser = 0;) and uncommet the line 95(//array_push($quantities, $count);)
        $totalUser = 0;
        foreach (range(1, $currentMonth) as $month) {
            $monthName = Carbon::createFromDate(null, $month, 1)->format('F');
            $label = $monthName;
            if (isset($users[$monthName])) {
                $count = $users[$monthName]->count();
                $totalUser +=  $count;
                //array_push($quantities, $count);
                array_push($quantities, $totalUser);
            } else {
                array_push($quantities, 0);
            }

            array_push($labels, $label);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Users',
                    'data' => $quantities,
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.1
                ]
            ],
            'labels' => $labels
        ];
    }


}
