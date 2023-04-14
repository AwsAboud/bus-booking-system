<?php

namespace App\Filament\Resources;

use App\Models\Bus;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\TravelsSchedule;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TravelsScheduleResource\Pages;
use App\Filament\Resources\TravelsScheduleResource\RelationManagers;
use App\Filament\Resources\TravelsScheduleResource\Widgets\TravelsStatsOverview;

class TravelsScheduleResource extends Resource
{
    protected static ?string $model = TravelsSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('bus_id')->required(),
                Forms\Components\TextInput::make('driver_id')->required(),
                Forms\Components\TextInput::make('starting_point')->required()
                ->datalist([
                    'Aleppo',
                    'Hama',
                    'Homs',
                    'Damascus',
                    'Latakia',
                    'Tartous',
                ]),
                Forms\Components\TextInput::make('destination')->required()
                ->datalist([
                    'Aleppo',
                    'Hama',
                    'Homs',
                    'Damascus',
                    'Latakia',
                    'Tartous',
                ]),
                // Allow admin to set travels date  with only 15 days ahead
                Forms\Components\DatePicker::make('schedule_date')->required()
                    ->label('Travel Date')
                 ->minDate(now())
                 ->maxDate(now()->addDays(15))
                 ->format('Y-m-d'),
                Forms\Components\TimePicker::make('departure_time')->required(),
                Forms\Components\TimePicker::make('estimate_arrival_time')->required(),
                Forms\Components\TextInput::make('price')
                ->numeric()->required()
                ->label('Price Per Seat'),
                Forms\Components\TextInput::make('remarks'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('bus_id')->searchable(),
                Tables\Columns\TextColumn::make('driver_id')->searchable(),
                Tables\Columns\TextColumn::make('starting_point')->searchable(),
                Tables\Columns\TextColumn::make('destination')->searchable(),
                Tables\Columns\TextColumn::make('schedule_date')->searchable(),
                Tables\Columns\TextColumn::make('departure_time')->searchable(),
                Tables\Columns\TextColumn::make('estimate_arrival_time'),
                Tables\Columns\TextColumn::make('price')->searchable(),
                Tables\Columns\TextColumn::make('remarks'),

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
            'index' => Pages\ListTravelsSchedules::route('/'),
            'create' => Pages\CreateTravelsSchedule::route('/create'),
            'edit' => Pages\EditTravelsSchedule::route('/{record}/edit'),
        ];
    }
     //Travels Widgets
     public static function getWidgets(): array
     {
         return [
             TravelsStatsOverview::class,

         ];
     }
}