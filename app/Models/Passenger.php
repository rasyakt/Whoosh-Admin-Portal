<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'passengers';

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'name',
        'identity_no',
        'gender',
        'date_of_birth',
        'passenger_type',
        'discount_type',
        'country',
        'document_type',
        'expiry_date',
        'whatsapp',
        'email',
        'is_saved',
    ];

    protected function casts(): array
    {
        return [
            'is_saved' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(MobileUser::class, 'user_id');
    }
}
