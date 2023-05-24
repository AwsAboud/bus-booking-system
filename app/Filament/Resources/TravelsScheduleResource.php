<?php

namespace App\Filament\Resources;

use App\Models\Bus;
use Filament\Forms;
use Filament\Tables;
use App\Models\Driver;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\TravelsSchedule;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TravelsScheduleResource\Pages;
use App\Filament\Resources\TravelsScheduleResource\RelationManagers;
use App\Filament\Resources\TravelsScheduleResource\Widgets\TravelsStatsOverview;
use App\Filament\Resources\TravelsScheduleResource\RelationManagers\BusRelationManager;
use App\Filament\Resources\TravelsScheduleResource\RelationManagers\DriverRelationManager;
use App\Filament\Resources\TravelsScheduleResource\RelationManagers\BookingsRelationManager;

class TravelsScheduleResource extends Resource
{
    protected static ?string $model = TravelsSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-table';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                // to understand why we put label('Bus Number') for bus_id
                //read the below commet
                Select::make('bus_id')
                ->label('Bus Number')
                /*
                --------------------------------------------------------------------------------
                    - pluck($value, $key)[the definision for it Get an array with the
                     values of givin $key
                        (
                        $valueيعني بالمشرمحي وقت العرض ع الشاشة رح تعرض ال
                        $key ووقت التخزين بالدلتا رح تخزن
                        )]
                    so when we write pluck('bus_number', 'id') then if
                    we slect bus_number = 11 it will store in
                    the database the  [id] for the selected bus number (الكلام مو منطفي شوي بما انو )
                    - we do this because the bus_number is  easier
                    for admin to remember than the bus id
                    - so to prevent conviosen for the adminUse  we
                    put  label('Bus Number') for bus_id coulmn :)
                    - visit the [ https://filamentphp.com/docs/2.x/forms/fields#select ]
                    and whach the video in this page for more information
                ---------------------------------------------------------------------------------
                */
                ->options(Bus::all()->pluck('bus_number', 'id'))
                ->searchable()
                ->required()
                ->reactive(),
                Select::make('driver_id')
                ->label('Driver')
                ->options(Driver::all()->pluck('name', 'id'))
                ->searchable()->required(),
                //Forms\Components\TextInput::make('driver_id')->required(),
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
                Forms\Components\TextInput::make('available_seats')
                ->numeric()->required(),
                // Select::make('available_seats')
                // ->required()
                // ->options(function(callable $get){
                //     $bus = Bus::find($get('bus_id'))->first();

                //     if($bus )
                //     return  $bus->pluck('id','id');

                // }),
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
                Tables\Columns\TextColumn::make('available_seats'),
                Tables\Columns\TextColumn::make('remarks'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array

    {
        return [
            BusRelationManager::class,
            DriverRelationManager::class,
            BookingsRelationManager::class,
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
