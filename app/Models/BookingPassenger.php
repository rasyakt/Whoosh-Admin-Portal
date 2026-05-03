<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingPassenger extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'booking_passengers';
    public $timestamps = false;

    protected $fillable = [
        'booking_id',
        'passenger_id',
        'name',
        'identity_no',
        'passenger_type',
        'seat_number',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }
}
