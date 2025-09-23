<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo',
        'website_url',
        'partnership_type',
        'display_order',
    ];
}
