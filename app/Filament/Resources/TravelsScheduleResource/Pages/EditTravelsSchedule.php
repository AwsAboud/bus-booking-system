<?php

namespace App\Filament\Resources\TravelsScheduleResource\Pages;

use App\Filament\Resources\TravelsScheduleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTravelsSchedule extends EditRecord
{
    protected static string $resource = TravelsScheduleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
