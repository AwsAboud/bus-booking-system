<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusResource\Pages;
use App\Filament\Resources\BusResource\RelationManagers;
use App\Models\Bus;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BusResource\Widgets\BusStatsOverview;

class BusResource extends Resource
{
    protected static ?string $model = Bus::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('bus_number')
                    ->required()->numeric(),
                Forms\Components\TextInput::make('bus_plate_number')
                    ->required()->numeric(),
                Forms\Components\TextInput::make('capacity')
                    ->required()->numeric()
                    ->minValue(20)->maxValue(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id') ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('bus_number') ->searchable(),
                Tables\Columns\TextColumn::make('bus_plate_number')->searchable(),
                Tables\Columns\TextColumn::make('capacity') ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBuses::route('/'),
            'create' => Pages\CreateBus::route('/create'),
            'edit' => Pages\EditBus::route('/{record}/edit'),
        ];
    }


       //Bus Widgets
       public static function getWidgets(): array
       {
           return [
               BusStatsOverview::class,

           ];
       }
}