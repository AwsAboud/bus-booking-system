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
            Card::make('Total Buses', Bus::count())
            ->description('Total Buses')
            ->color('success')
            ->extraAttributes([
                'style' => 'width:40%'
            ]),

        ];
    }
}
