<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'travels_schedule_id',
        'customer_id',
        'number_of_seats',
        'price_per_seat',
        'total_price',
        'booking_date',
    ];
    public function customer(){

        return $this->belongsTo(Customer::class);
     }

    public function payment(){

        return $this->hasOne(Payment::class);
    }

    public function travelsSchedule(){

        return $this->belongsTo(TravelsSchedule::class);
     }



 }
