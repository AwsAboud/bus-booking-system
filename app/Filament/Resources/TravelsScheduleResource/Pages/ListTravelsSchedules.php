<?php

namespace App\Filament\Resources\TravelsScheduleResource\Pages;

use App\Filament\Resources\TravelsScheduleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTravelsSchedules extends ListRecords
{
    protected static string $resource = TravelsScheduleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
