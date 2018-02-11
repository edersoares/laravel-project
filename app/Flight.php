<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'year',
        'month',
        'day_of_month',
        'day_of_week',
        'dep_time',
        'crs_dep_time',
        'arr_time',
        'crs_arr_time',
        'unique_carrier',
        'flight_num',
        'tail_num',
        'actual_elapsed_time',
        'crs_elapsed_time',
        'air_time',
        'arr_delay',
        'dep_delay',
        'origin',
        'dest',
        'distance',
        'taxi_in',
        'taxi_out',
        'cancelled',
        'cancellation_code',
        'diverted',
        'carrier_delay',
        'weather_delay',
        'nas_delay',
        'security_delay',
        'late_aircraft_delay',
    ];
}
