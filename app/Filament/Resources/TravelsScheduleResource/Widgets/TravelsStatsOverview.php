<?php

namespace App\Filament\Resources\TravelsScheduleResource\Widgets;

use Carbon\Carbon;
use App\Models\Driver;
use App\Models\TravelsSchedule;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TravelsStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {   //get travels number in the  current day
        $currentDate = Carbon::now()->toDateString();
        $numberOfCurrentDayTravels = TravelsSchedule::whereDate('schedule_date', $currentDate)->count();
        //get travels number in the  current month
        $currentMonth = Carbon::now()->month;
        $numberOfCurrentMonthTravels = TravelsSchedule::whereMonth('schedule_date', $currentMonth)->count();
        return [
            //Display the travels number in the  current day
            Card::make('Today\'s Travels',$numberOfCurrentDayTravels)
            ->description('Todays Travels')
            ->color('success'),
            //Display the get travels number in the  current month
            Card::make('This Month Travels', Driver::all()->count())
            ->description('This Month Travels')
            ->color('success'),

        ];
    }
}
