<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZonalOffice extends Model
{
    protected $fillable = [
        'name',
        'location',
        'address',
        'phone',
        'email',
        'description',
        'latitude',
        'longitude',
        'states_covered',
    ];
}
