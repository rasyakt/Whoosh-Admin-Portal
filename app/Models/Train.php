<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'trains';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'train_code',
        'capacity',
        'class_type',
        'status',
        'description',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
