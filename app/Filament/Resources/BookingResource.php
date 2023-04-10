<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('travels_schedule_id')->required()
                ->numeric(),
                Forms\Components\TextInput::make('customer_id')->required()
                ->numeric(),
                Forms\Components\TextInput::make('number_of_seats')->required()
                ->numeric(),
                Forms\Components\TextInput::make('price_per_seat')->required()
                ->numeric(),
                Forms\Components\TextInput::make('total_price')->required()
                ->numeric(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('travels_schedule_id')->sortable(),
                Tables\Columns\TextColumn::make('customer_id')->sortable(),
                Tables\Columns\TextColumn::make('number_of_seats'),
                Tables\Columns\TextColumn::make('price_per_seat'),
                Tables\Columns\TextColumn::make('total_price'),
                Tables\Columns\TextColumn::make('booking_date')->sortable()->searchable(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
