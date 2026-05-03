<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'promos';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'discount',
        'valid_until',
        'code',
        'min_purchase',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
