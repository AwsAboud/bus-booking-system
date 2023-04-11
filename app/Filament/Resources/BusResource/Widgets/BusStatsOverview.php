<?php

namespace App\Filament\Resources\BusResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Bus;

class BusStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            //get the number of buses in the company
            Card::make('Total Buses', Bus::all()->count())
            ->description('Total Buses')
            ->color('success')
            ->extraAttributes([
                'style' => 'width:40%'
            ]),

            //Card::make('Buses', Bus::all()->count())
            // //you can add custom style using the function below
            // // light green #22d822
            // ->extraAttributes([
            //     'style' => 'background: #1fc71f ;;width:30%'
            // ])
        ];
    }
}
