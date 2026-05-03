<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StationDuration extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'station_durations';
    public $timestamps = false;

    protected $fillable = [
        'from_station_id',
        'to_station_id',
        'duration_minutes',
    ];

    public function fromStation()
    {
        return $this->belongsTo(Station::class, 'from_station_id');
    }

    public function toStation()
    {
        return $this->belongsTo(Station::class, 'to_station_id');
    }
}
