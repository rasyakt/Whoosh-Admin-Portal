<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'bookings';

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'booking_code',
        'origin_station',
        'destination_station',
        'departure_date',
        'departure_time',
        'arrival_time',
        'duration',
        'coach_class',
        'ticket_count',
        'price_per_ticket',
        'total_price',
        'selected_carriage',
        'selected_seats',
        'is_used',
        'is_paid',
        'is_cancelled',
        'refund_amount',
        'bank_name',
        'account_no',
        'account_holder',
        'booking_timestamp',
    ];

    protected function casts(): array
    {
        return [
            'is_used' => 'boolean',
            'is_paid' => 'boolean',
            'is_cancelled' => 'boolean',
            'refund_amount' => 'integer',
            'booking_timestamp' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(MobileUser::class, 'user_id');
    }

    public function passengers()
    {
        return $this->hasMany(BookingPassenger::class);
    }

    /**
     * Get computed status attribute
     */
    public function getStatusAttribute(): string
    {
        if ($this->is_cancelled) return 'Cancelled';
        if ($this->is_used) return 'Completed';
        if ($this->is_paid) return 'Paid';
        return 'Booked';
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'Cancelled' => 'red',
            'Completed' => 'emerald',
            'Paid' => 'blue',
            'Booked' => 'amber',
            default => 'gray',
        };
    }

    public function scopePaid($query)
    {
        return $query->where('is_paid', 1)->where('is_cancelled', 0);
    }

    public function scopeUnpaid($query)
    {
        return $query->where('is_paid', 0)->where('is_cancelled', 0);
    }

    public function scopeCancelled($query)
    {
        return $query->where('is_cancelled', 1);
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_used', 1);
    }
}
