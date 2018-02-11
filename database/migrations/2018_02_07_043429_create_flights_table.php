<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year');
            $table->string('month');
            $table->string('day_of_month');
            $table->string('day_of_week');
            $table->string('dep_time');
            $table->string('crs_dep_time');
            $table->string('arr_time');
            $table->string('crs_arr_time');
            $table->string('unique_carrier');
            $table->string('flight_num');
            $table->string('tail_num');
            $table->string('actual_elapsed_time');
            $table->string('crs_elapsed_time');
            $table->string('air_time');
            $table->string('arr_delay');
            $table->string('dep_delay');
            $table->string('origin');
            $table->string('dest');
            $table->string('distance');
            $table->string('taxi_in');
            $table->string('taxi_out');
            $table->string('cancelled');
            $table->string('cancellation_code');
            $table->string('diverted');
            $table->string('carrier_delay');
            $table->string('weather_delay');
            $table->string('nas_delay');
            $table->string('security_delay');
            $table->string('late_aircraft_delay');
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
        Schema::dropIfExists('flights');
    }
}
