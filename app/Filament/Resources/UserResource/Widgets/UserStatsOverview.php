<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class UserStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $usersCount = User::count();
        return [
             //get the number of  the company Customers
             Card::make('Total Customers',$usersCount)
             ->description('Total Customers')
             ->color('success')
             ->extraAttributes([
                 'style' => 'width:40%'
             ]),
        ];
    }
}
