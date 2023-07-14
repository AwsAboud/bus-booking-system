<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Payment;
use Filament\Widgets\LineChartWidget;

class Earnings extends LineChartWidget
{
    protected static ?string $heading = 'Earnings';


    protected function getData(): array
{
    // Group payments by month
    $payments = Payment::select('created_at', 'payment_amount')
                        ->get()
                        ->groupBy(function($payment) {
                            return Carbon::parse($payment->created_at)->format('F');
                        });

    $quantities = [];
    $labels = [];

    // Loop through the months until the current month and add the payment amount to the quantities array
    // If there are no payments for a particular month, add a zero to the quantities array
    $currentMonth = Carbon::now()->month;
    $monthNames = [];
    for ($i = 1; $i <= $currentMonth; $i++) {
        $monthName = Carbon::createFromDate(null, $i, 1)->format('F');
        $label = $monthName;
        array_push($monthNames, $monthName);

        if (isset($payments[$monthName])) {
            $amount = $payments[$monthName]->sum('payment_amount');
            array_push($quantities, $amount);
        } else {
            array_push($quantities, 0);
        }

        array_push($labels, $label);
    }

    // Fill in any missing months between the earliest payment month and the current month with zero values
    $earliestMonth = $monthNames[0];
    for ($i = 0; $i < count($monthNames); $i++) {
        if ($monthNames[$i] !== $earliestMonth) {
            $prevMonth = Carbon::parse($monthNames[$i - 1])->addMonth()->format('F');
            while ($prevMonth !== $monthNames[$i]) {
                array_push($quantities, 0);
                array_push($labels, $prevMonth);
                $prevMonth = Carbon::parse($prevMonth)->addMonth()->format('F');
            }
        }
    }

    return [
        'datasets' => [
            [
                'label' => 'Payments',
                'data' => $quantities,
                'fill' => false,
                'borderColor' => 'rgba(255, 90, 90)',
                'tension' => 0.1
            ]
        ],
        'labels' => $labels
    ];
}
}
