<?php

namespace App\Filament\Resources\BusResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TravelsScheduleRelationManager extends RelationManager
{
    protected static string $relationship = 'travelsSchedule';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('bus_id')->searchable(),
                Tables\Columns\TextColumn::make('driver_id')->searchable(),
                Tables\Columns\TextColumn::make('starting_point')->searchable(),
                Tables\Columns\TextColumn::make('destination')->searchable(),
                Tables\Columns\TextColumn::make('schedule_date')->searchable(),
                Tables\Columns\TextColumn::make('departure_time')->searchable(),
                Tables\Columns\TextColumn::make('estimate_arrival_time'),
                Tables\Columns\TextColumn::make('price')->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
