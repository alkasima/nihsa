<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FloodData extends Model
{
    use HasFactory;

    protected $table = 'flood_data';

    protected $fillable = [
        'state',
        'lga',
        'community',
        'risk_level',
        'flood_type',
        'forecast_date',
        'description',
        'latitude',
        'longitude',
        'year',
        'period',
        'probability',
        'affected_population',
        'affected_area',
        'expected_rainfall'
    ];

    protected $casts = [
        'forecast_date' => 'date',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'probability' => 'integer',
        'affected_population' => 'integer',
        'affected_area' => 'decimal:2',
        'expected_rainfall' => 'decimal:2'
    ];

    // Scopes for filtering
    public function scopeByState($query, $state)
    {
        if ($state && $state !== 'all') {
            return $query->where('state', $state);
        }
        return $query;
    }

    public function scopeByRiskLevel($query, $riskLevel)
    {
        if ($riskLevel && $riskLevel !== 'all') {
            return $query->where('risk_level', $riskLevel);
        }
        return $query;
    }

    public function scopeByFloodType($query, $floodType)
    {
        if ($floodType && $floodType !== 'all') {
            return $query->where('flood_type', $floodType);
        }
        return $query;
    }

    public function scopeByYear($query, $year)
    {
        if ($year) {
            return $query->where('year', $year);
        }
        return $query;
    }

    public function scopeByPeriod($query, $period)
    {
        if ($period && $period !== 'all') {
            return $query->where('period', $period);
        }
        return $query;
    }
}
