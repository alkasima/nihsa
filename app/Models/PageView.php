<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class PageView extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'url',
        'title',
        'user_agent',
        'ip_address',
        'referrer',
        'device_type',
        'browser',
        'browser_version',
        'os',
        'country',
        'city',
        'latitude',
        'longitude',
        'page_load_time',
        'time_on_page',
        'is_bounce',
        'visited_at'
    ];

    protected $casts = [
        'visited_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_bounce' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'page_load_time' => 'integer',
        'time_on_page' => 'integer'
    ];

    /**
     * Scope to filter by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('visited_at', [$startDate, $endDate]);
    }

    /**
     * Scope to filter by today
     */
    public function scopeToday($query)
    {
        return $query->whereDate('visited_at', Carbon::today());
    }

    /**
     * Scope to filter by current month
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('visited_at', Carbon::now()->month)
                    ->whereYear('visited_at', Carbon::now()->year);
    }

    /**
     * Scope to filter by last 30 days
     */
    public function scopeLast30Days($query)
    {
        return $query->where('visited_at', '>=', Carbon::now()->subDays(30));
    }

    /**
     * Get the user session this page view belongs to
     */
    public function session()
    {
        return $this->belongsTo(UserSession::class, 'session_id', 'session_id');
    }
}
