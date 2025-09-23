<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'organization',
        'data_type',
        'description',
        'time_period',
        'geographic_area',
        'data_format',
        'additional_info',
        'status',
        'admin_notes',
        'processed_at',
        'estimated_delivery',
        'rejection_reason',
        'delivered_at',
        'delivered_by',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'estimated_delivery' => 'date',
        'delivered_at' => 'datetime',
    ];
}
