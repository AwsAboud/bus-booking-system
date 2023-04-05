<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travels_schedule_id')->constrained('travels_schedule')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('customer_id')->constrained('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('number_of_seats');
            $table->unsignedInteger('price__per_seat');
            $table->unsignedInteger('total_price');
            $table->date('booking_date')->default(DB::raw('CURRENT_DATE'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
