<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class UserSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'ip_address',
        'user_agent',
        'device_type',
        'browser',
        'os',
        'country',
        'city',
        'session_duration',
        'page_count',
        'is_new_visitor',
        'first_visit_at',
        'last_activity_at'
    ];

    protected $casts = [
        'first_visit_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_new_visitor' => 'boolean',
        'session_duration' => 'integer',
        'page_count' => 'integer'
    ];

    /**
     * Get all page views for this session
     */
    public function pageViews()
    {
        return $this->hasMany(PageView::class, 'session_id', 'session_id');
    }

    /**
     * Get traffic source for this session
     */
    public function trafficSource()
    {
        return $this->hasOne(TrafficSource::class, 'session_id', 'session_id');
    }

    /**
     * Scope to filter by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('first_visit_at', [$startDate, $endDate]);
    }

    /**
     * Scope to filter by today
     */
    public function scopeToday($query)
    {
        return $query->whereDate('first_visit_at', Carbon::today());
    }

    /**
     * Scope to filter by current month
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('first_visit_at', Carbon::now()->month)
                    ->whereYear('first_visit_at', Carbon::now()->year);
    }

    /**
     * Scope to filter by last 30 days
     */
    public function scopeLast30Days($query)
    {
        return $query->where('first_visit_at', '>=', Carbon::now()->subDays(30));
    }
}
