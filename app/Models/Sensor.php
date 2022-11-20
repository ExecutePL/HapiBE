<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sensor extends Model
{
    use HasFactory;

    protected $statuses = array(
        0 => 'offline',
        1 => 'online'
    );

    protected $fillable = [
        'name',
        'serial_number',
        'latitude',
        'longitude',
        'batteryLevel',
        'status'
    ];

    public function getStatusAttribute($value)
    {
        return $this->statuses[$value];
    }

    public function measures(): HasMany
    {
        return $this->hasMany(Measurement::class, 'sensor_id', 'id');
    }
}
