<?php

namespace App\Models;

use App\Models\User;
use App\Models\TravelsSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'travels_schedule_id',
        'user_id',
        'number_of_seats',
        'price_per_seat',
        'total_price',
        'booking_date',
    ];
    public function user(){

        return $this->belongsTo(User::class);
     }

    public function payment(){

        return $this->hasOne(Payment::class);
    }

    public function travelsSchedule(){

        return $this->belongsTo(TravelsSchedule::class);
     }



 }
