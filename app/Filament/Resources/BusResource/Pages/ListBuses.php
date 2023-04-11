<?php

namespace App\Filament\Resources\BusResource\Pages;

use App\Filament\Resources\BusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BusResource\Widgets\BusStatsOverview;

class ListBuses extends ListRecords
{
    protected static string $resource = BusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    //Bus widgets
    protected function getHeaderWidgets(): array
    {
        return [
            BusStatsOverview::class,
        ];
    }


}


