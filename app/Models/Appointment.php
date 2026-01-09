<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'service_id',
        'name',
        'email',
        'phone',
        'preferred_date',
        'preferred_time',
        'mode',
        'status',
        'notes',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}