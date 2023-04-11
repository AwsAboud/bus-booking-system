<?php

namespace App\Filament\Resources\DriverResource\Pages;

use App\Filament\Resources\DriverResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DriverResource\Widgets\DriverStatsOverview;
class ListDrivers extends ListRecords
{
    protected static string $resource = DriverResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    //
    protected function getHeaderWidgets(): array
    {
        return [
            DriverStatsOverview::class,
        ];
    }

}
