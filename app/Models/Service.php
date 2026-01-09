<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'duration_minutes',
        'price',
        'type',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'service_id');
    }
}