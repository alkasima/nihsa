<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'type',
        'year',
        'publication_date',
        'is_featured',
    ];

    protected $casts = [
        'publication_date' => 'date',
        'is_featured' => 'boolean',
    ];
}
