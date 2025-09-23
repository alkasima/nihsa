@extends('layouts.admin')

@section('title', 'Flood Data Visualization')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        .stats-card {
            transition: all 0.3s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .stats-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .chart-container {
            position: relative;
            height: 300px;
        }
        #map {
            height: 500px;
            width: 100%;
            border-radius: 0.25rem;
        }
        .risk-high {
            background-color: #e74a3b;
            color: white;
        }
        .risk-moderate {
            background-color: #f6c23e;
            color: white;
        }
        .risk-low {
            background-color: #1cc88a;
            color: white;
        }
    </style>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Flood Data Visualization</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Flood Data Visualization</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" id="export-pdf">
                    <i class="fas fa-file-pdf me-1"></i> Export PDF
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary" id="export-excel">
                    <i class="fas fa-file-excel me-1"></i> Export Excel
                </button>
            </div>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.reports.flood-data') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="year" class="form-label">Year</label>
                    <select class="form-select" id="year" name="year">
                        @foreach($years as $y)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="state" class="form-label">State</label>
                    <select class="form-select" id="state" name="state">
                        @foreach($states as $key => $value)
                            <option value="{{ $key }}" {{ $state == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="risk_level" class="form-label">Risk Level</label>
                    <select class="form-select" id="risk_level" name="risk_level">
                        @foreach($riskLevels as $key => $value)
                            <option value="{{ $key }}" {{ $riskLevel == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-4">
            <div class="card stats-card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stats-icon bg-primary text-white me-3">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 text-muted">Affected Area</h6>
                        </div>
                    </div>
                    <h3 class="mb-0">{{ $floodImpactData['affected_area'] }}</h3>
                    <div class="text-danger mt-2">
                        <i class="fas fa-arrow-up me-1"></i> 3.8% from last year
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
            <div class="card stats-card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stats-icon bg-danger text-white me-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 text-muted">Affected Population</h6>
                        </div>
                    </div>
                    <h3 class="mb-0">{{ $floodImpactData['affected_population'] }}</h3>
                    <div class="text-danger mt-2">
                        <i class="fas fa-arrow-up me-1"></i> 4.3% from last year
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
            <div class="card stats-card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stats-icon bg-warning text-white me-3">
                            <i class="fas fa-home"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 text-muted">Displaced Persons</h6>
                        </div>
                    </div>
                    <h3 class="mb-0">{{ $floodImpactData['displaced_persons'] }}</h3>
                    <div class="text-danger mt-2">
                        <i class="fas fa-arrow-up me-1"></i> 2.9% from last year
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4 mb-4">
        <!-- Nigeria Map -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Flood Risk Map - Nigeria {{ $year }}</h5>
                </div>
                <div class="card-body">
                    <div id="map"></div>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-center">
                        <div class="me-4">
                            <span class="badge risk-high me-1">&nbsp;</span> High Risk
                        </div>
                        <div class="me-4">
                            <span class="badge risk-moderate me-1">&nbsp;</span> Moderate Risk
                        </div>
                        <div>
                            <span class="badge risk-low me-1">&nbsp;</span> Low Risk
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Risk Level Distribution -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Risk Level Distribution</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="riskLevelChart"></canvas>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                @foreach($riskLevelDistribution as $level)
                                    <tr>
                                        <td>
                                            <span class="badge {{ $level['level'] == 'High' ? 'risk-high' : ($level['level'] == 'Moderate' ? 'risk-moderate' : 'risk-low') }} me-2">{{ $level['level'] }}</span>
                                        </td>
                                        <td>{{ $level['count'] }} areas</td>
                                        <td class="text-end">{{ $level['percentage'] }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4 mb-4">
        <!-- Monthly Flood Incidents -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Monthly Flood Incidents - {{ $year }}</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="monthlyIncidentsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Yearly Comparison -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Yearly Comparison</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th class="text-end">Incidents</th>
                                    <th class="text-end">Area (sq km)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($yearlyComparison as $comparison)
                                    <tr class="{{ $comparison['year'] == $year ? 'table-primary' : '' }}">
                                        <td>{{ $comparison['year'] }}</td>
                                        <td class="text-end">{{ $comparison['incidents'] }}</td>
                                        <td class="text-end">{{ number_format($comparison['affected_area']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <!-- State Risk Data -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">State-by-State Flood Risk Analysis - {{ $year }}</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="stateRiskChart"></canvas>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>State</th>
                                    <th class="text-end">High Risk Areas</th>
                                    <th class="text-end">Moderate Risk Areas</th>
                                    <th class="text-end">Low Risk Areas</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stateRiskData as $data)
                                    <tr>
                                        <td>{{ $data['state'] }}</td>
                                        <td class="text-end">
                                            <span class="badge risk-high">{{ $data['high_risk'] }}</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge risk-moderate">{{ $data['moderate_risk'] }}</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge risk-low">{{ $data['low_risk'] }}</span>
                                        </td>
                                        <td class="text-end">{{ $data['high_risk'] + $data['moderate_risk'] + $data['low_risk'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Monthly Incidents Chart
            const monthlyIncidentsCtx = document.getElementById('monthlyIncidentsChart').getContext('2d');
            const monthlyIncidentsChart = new Chart(monthlyIncidentsCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_column($monthlyFloodIncidents, 'month')) !!},
                    datasets: [{
                        label: 'Flood Incidents',
                        data: {!! json_encode(array_column($monthlyFloodIncidents, 'incidents')) !!},
                        backgroundColor: 'rgba(78, 115, 223, 0.8)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
            
            // Risk Level Chart
            const riskLevelCtx = document.getElementById('riskLevelChart').getContext('2d');
            const riskLevelChart = new Chart(riskLevelCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_column($riskLevelDistribution, 'level')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($riskLevelDistribution, 'percentage')) !!},
                        backgroundColor: [
                            '#e74a3b',
                            '#f6c23e',
                            '#1cc88a'
                        ],
                        borderWidth: 0,
                        hoverOffset: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    cutout: '70%'
                }
            });
            
            // State Risk Chart
            const stateRiskCtx = document.getElementById('stateRiskChart').getContext('2d');
            const stateRiskChart = new Chart(stateRiskCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_column($stateRiskData, 'state')) !!},
                    datasets: [
                        {
                            label: 'High Risk',
                            data: {!! json_encode(array_column($stateRiskData, 'high_risk')) !!},
                            backgroundColor: '#e74a3b',
                            borderColor: '#e74a3b',
                            borderWidth: 1
                        },
                        {
                            label: 'Moderate Risk',
                            data: {!! json_encode(array_column($stateRiskData, 'moderate_risk')) !!},
                            backgroundColor: '#f6c23e',
                            borderColor: '#f6c23e',
                            borderWidth: 1
                        },
                        {
                            label: 'Low Risk',
                            data: {!! json_encode(array_column($stateRiskData, 'low_risk')) !!},
                            backgroundColor: '#1cc88a',
                            borderColor: '#1cc88a',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            stacked: true,
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            stacked: true,
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
            
            // Initialize Map
            const map = L.map('map').setView([9.0820, 8.6753], 6);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            // Add state markers (this is dummy data, in a real implementation we would use GeoJSON)
            const stateCoordinates = {
                'Lagos': [6.5244, 3.3792],
                'Rivers': [4.8156, 7.0498],
                'Bayelsa': [4.7719, 6.0699],
                'Delta': [5.5324, 5.8987],
                'Kogi': [7.7337, 6.6906],
                'Anambra': [6.2209, 6.9370],
                'Benue': [7.3369, 8.7404],
                'Cross River': [5.8702, 8.5988],
                'Edo': [6.5438, 5.8987],
                'Imo': [5.4833, 7.0333]
            };
            
            // Add markers for each state
            @foreach($stateRiskData as $data)
                @if(isset($stateCoordinates[$data['state']]))
                    // Calculate total risk areas
                    const totalRiskAreas{{ $loop->index }} = {{ $data['high_risk'] + $data['moderate_risk'] + $data['low_risk'] }};
                    
                    // Determine marker color based on highest risk category
                    let markerColor{{ $loop->index }};
                    if ({{ $data['high_risk'] }} > {{ $data['moderate_risk'] }} && {{ $data['high_risk'] }} > {{ $data['low_risk'] }}) {
                        markerColor{{ $loop->index }} = '#e74a3b';
                    } else if ({{ $data['moderate_risk'] }} > {{ $data['high_risk'] }} && {{ $data['moderate_risk'] }} > {{ $data['low_risk'] }}) {
                        markerColor{{ $loop->index }} = '#f6c23e';
                    } else {
                        markerColor{{ $loop->index }} = '#1cc88a';
                    }
                    
                    // Create marker
                    const marker{{ $loop->index }} = L.circleMarker(
                        [{{ $stateCoordinates[$data['state']][0] }}, {{ $stateCoordinates[$data['state']][1] }}],
                        {
                            radius: Math.sqrt(totalRiskAreas{{ $loop->index }}) * 2,
                            fillColor: markerColor{{ $loop->index }},
                            color: '#fff',
                            weight: 1,
                            opacity: 1,
                            fillOpacity: 0.8
                        }
                    ).addTo(map);
                    
                    // Add popup
                    marker{{ $loop->index }}.bindPopup(
                        '<strong>{{ $data['state'] }}</strong><br>' +
                        'High Risk Areas: {{ $data['high_risk'] }}<br>' +
                        'Moderate Risk Areas: {{ $data['moderate_risk'] }}<br>' +
                        'Low Risk Areas: {{ $data['low_risk'] }}<br>' +
                        'Total: ' + totalRiskAreas{{ $loop->index }}
                    );
                @endif
            @endforeach
            
            // Export PDF
            document.getElementById('export-pdf').addEventListener('click', function() {
                alert('Exporting PDF...');
                // In a real implementation, we would send an AJAX request to generate and download the PDF
            });
            
            // Export Excel
            document.getElementById('export-excel').addEventListener('click', function() {
                alert('Exporting Excel...');
                // In a real implementation, we would send an AJAX request to generate and download the Excel file
            });
        });
    </script>
@endsection
