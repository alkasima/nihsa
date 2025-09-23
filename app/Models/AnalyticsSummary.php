<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class AnalyticsSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'total_visitors',
        'unique_visitors',
        'page_views',
        'sessions',
        'avg_session_duration',
        'bounce_rate',
        'new_visitor_rate',
        'top_pages',
        'traffic_sources',
        'device_breakdown',
        'browser_breakdown',
        'country_breakdown'
    ];

    protected $casts = [
        'date' => 'date',
        'total_visitors' => 'integer',
        'unique_visitors' => 'integer',
        'page_views' => 'integer',
        'sessions' => 'integer',
        'avg_session_duration' => 'decimal:2',
        'bounce_rate' => 'decimal:2',
        'new_visitor_rate' => 'decimal:2',
        'top_pages' => 'array',
        'traffic_sources' => 'array',
        'device_breakdown' => 'array',
        'browser_breakdown' => 'array',
        'country_breakdown' => 'array'
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
     * Scope to get latest summary
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('date', 'desc')->first();
    }

    /**
     * Get or create summary for a specific date
     */
    public static function getOrCreateForDate($date)
    {
        $date = Carbon::parse($date)->toDateString();

        return static::firstOrCreate(
            ['date' => $date],
            [
                'total_visitors' => 0,
                'unique_visitors' => 0,
                'page_views' => 0,
                'sessions' => 0,
                'avg_session_duration' => 0,
                'bounce_rate' => 0,
                'new_visitor_rate' => 0,
                'top_pages' => [],
                'traffic_sources' => [],
                'device_breakdown' => [],
                'browser_breakdown' => [],
                'country_breakdown' => []
            ]
        );
    }
}
