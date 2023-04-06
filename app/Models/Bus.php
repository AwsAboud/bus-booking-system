<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_number',
        'bus_plate_number',
        'capacity',
    ];

    public function travelsSchedule (){
        return $this->hasMany(TravelsSchedule::class);
    }
}
