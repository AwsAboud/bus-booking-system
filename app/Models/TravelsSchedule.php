<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TravelsSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'driver_id',
        'starting_point',
        'destination',
        'schedule_date',
        'departure_time',
        'estimate_arrival_time',
        'price',
        'remarks'
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
    public function driver()
    {
        return $this->belongsTo(Bus::class);
    }

    public function Bookings (){
        return $this->hasMany(Booking::class);
    }
}
