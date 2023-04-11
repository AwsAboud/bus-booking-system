<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Customer;

class CustomerStatsOverview extends BaseWidget
{
    //Customer Widgets
    protected function getCards(): array
    {
        return [
            //get the number of  the company Customers
            Card::make('Total Customers', Customer::all()->count())
            ->description('Total Customers')
            ->color('success')
            ->extraAttributes([
                'style' => 'width:40%'
            ]),
        ];
    }
}
