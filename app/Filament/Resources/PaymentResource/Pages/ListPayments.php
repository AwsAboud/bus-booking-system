<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PaymentResource;
use App\Filament\Resources\PaymentResource\Widgets\PaymentsStatsOverview;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // Payments wedgets
    protected function getHeaderWidgets(): array
    {
        return [
            PaymentsStatsOverview::class,
        ];
    }
}
