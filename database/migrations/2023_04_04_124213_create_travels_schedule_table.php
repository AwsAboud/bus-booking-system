<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelsScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained('buses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('driver_id')->constrained('drivers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('starting_point');
            $table->string('destination');
            $table->date('schedule_date');
            $table->time('departure_time', $precision = 0);
            $table->time('estimate_arrival_time', $precision = 0)->nullable();
            $table->unsignedInteger('price');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('travels_schedule');
    }
}
