<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingRule extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'pricing_rules';
    public $timestamps = false;

    protected $fillable = [
        'origin_station',
        'destination_station',
        'coach_class',
        'base_price',
        'peak_price',
        'off_peak_price',
        'effective_from',
        'effective_until',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'base_price' => 'integer',
            'peak_price' => 'integer',
            'off_peak_price' => 'integer',
        ];
    }
}
