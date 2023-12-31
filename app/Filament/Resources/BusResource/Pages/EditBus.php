<?php

namespace App\Filament\Resources\BusResource\Pages;

use App\Filament\Resources\BusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBus extends EditRecord
{
    protected static string $resource = BusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
