<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'stations';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
        'location',
        'facilities',
    ];

    public function durationsFrom()
    {
        return $this->hasMany(StationDuration::class, 'from_station_id');
    }

    public function durationsTo()
    {
        return $this->hasMany(StationDuration::class, 'to_station_id');
    }

    public function schedulesOrigin()
    {
        return $this->hasMany(Schedule::class, 'origin_station_id');
    }

    public function schedulesDestination()
    {
        return $this->hasMany(Schedule::class, 'destination_station_id');
    }
}
