<?php

namespace App\Filament\Resources\TravelsScheduleResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TravelsScheduleResource;
use App\Filament\Resources\TravelsScheduleResource\Widgets\TravelsStatsOverview;

class ListTravelsSchedules extends ListRecords
{
    protected static string $resource = TravelsScheduleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

       //Travels widget
       protected function getHeaderWidgets(): array
       {
           return [
                TravelsStatsOverview::class,
           ];
       }

}
