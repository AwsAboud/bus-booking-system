<?php

namespace App\Filament\Resources\BookingResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BookingResource;
use App\Filament\Resources\BusResource\Widgets\BusStatsOverview;
use App\Filament\Resources\BookingResource\Widgets\BookingsStatsOverview;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
        //Bookings widgets
        protected function getHeaderWidgets(): array
        {
            return [
                BookingsStatsOverview::class,
            ];
        }

}
