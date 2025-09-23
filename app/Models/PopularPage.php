<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class PopularPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'title',
        'total_views',
        'unique_views',
        'avg_time_on_page',
        'bounce_count',
        'bounce_rate',
        'date'
    ];

    protected $casts = [
        'date' => 'date',
        'total_views' => 'integer',
        'unique_views' => 'integer',
        'avg_time_on_page' => 'decimal:2',
        'bounce_count' => 'integer',
        'bounce_rate' => 'decimal:2'
    ];

    /**
     * Scope to filter by date
     */
    public function scopeByDate($query, $date)
    {
        return $query->where('date', $date);
    }

    /**
     * Scope to filter by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    /**
     * Scope to get top pages by views
     */
    public function scopeTopByViews($query, $limit = 10)
    {
        return $query->orderBy('total_views', 'desc')->limit($limit);
    }
}
