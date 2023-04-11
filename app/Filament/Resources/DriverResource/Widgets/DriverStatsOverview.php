<?php

namespace App\Filament\Resources\DriverResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Driver;

class DriverStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            //get the number of  the company drivers
            Card::make('Total Drivers', Driver::all()->count())
            ->description('Total Customers')
            ->color('success')
            ->extraAttributes([
                'style' => 'width:40%'
            ]),
        ];
    }
}
