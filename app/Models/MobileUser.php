<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobileUser extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'user_id');
    }
}
