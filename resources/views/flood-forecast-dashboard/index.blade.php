@extends('layouts.app')

@section('title', 'Flood Forecast Dashboard - Nigeria Hydrological Services Agency')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* NIHSA Dashboard Styles - Matching Official Design */
        :root {
            --nihsa-primary: #0056b3;
            --nihsa-secondary: #28a745;
            --nihsa-accent: #17a2b8;
            --nihsa-danger: #dc3545;
            --nihsa-warning: #ffc107;
            --nihsa-dark: #343a40;
            --nihsa-light: #f8f9fa;
        }

        .dashboard-hero {
            background: linear-gradient(135deg, var(--nihsa-primary) 0%, var(--nihsa-accent) 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }

        .dashboard-hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .dashboard-hero .lead {
            font-size: 1.2rem;
            opacity: 0.9;
        }



        .dashboard-card {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .dashboard-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .dashboard-card .card-header {
            background: var(--nihsa-light);
            border-bottom: 1px solid #dee2e6;
            font-weight: 600;
            padding: 1rem 1.25rem;
        }

        .dashboard-card .card-header.bg-primary {
            background: var(--nihsa-primary) !important;
            color: white;
            border-bottom: none;
        }

        .dashboard-card .card-header.bg-info {
            background: var(--nihsa-accent) !important;
            color: white;
            border-bottom: none;
        }

        .dashboard-card .card-header.bg-success {
            background: var(--nihsa-secondary) !important;
            color: white;
            border-bottom: none;
        }

        .dashboard-card .card-header.bg-warning {
            background: var(--nihsa-warning) !important;
            color: var(--nihsa-dark);
            border-bottom: none;
        }

        .dashboard-card .card-header.bg-secondary {
            background: var(--nihsa-dark) !important;
            color: white;
            border-bottom: none;
        }

        .dashboard-card .card-header.bg-dark {
            background: var(--nihsa-dark) !important;
            color: white;
            border-bottom: none;
        }



        .stats-card {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 60px;
            height: 60px;
            background: rgba(0, 86, 179, 0.1);
            border-radius: 50%;
            transform: translate(20px, -20px);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--nihsa-primary);
        }

        .stats-label {
            font-size: 0.9rem;
            color: var(--nihsa-dark);
            font-weight: 500;
        }

        .risk-high .stats-number { color: var(--nihsa-danger); }
        .risk-high::before { background: rgba(220, 53, 69, 0.1); }

        .risk-moderate .stats-number { color: var(--nihsa-warning); }
        .risk-moderate::before { background: rgba(255, 193, 7, 0.1); }

        .risk-low .stats-number { color: var(--nihsa-secondary); }
        .risk-low::before { background: rgba(40, 167, 69, 0.1); }

        .risk-total .stats-number { color: var(--nihsa-primary); }
        .risk-total::before { background: rgba(0, 86, 179, 0.1); }

        .sensor-status {
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-normal { background: #d4edda; color: #155724; }
        .status-warning { background: #fff3cd; color: #856404; }
        .status-critical { background: #f8d7da; color: #721c24; }

        .alert-card {
            border-left: 4px solid;
            border-radius: 0 8px 8px 0;
        }

        .alert-high { border-left-color: var(--nihsa-danger); }
        .alert-moderate { border-left-color: var(--nihsa-warning); }
        .alert-low { border-left-color: var(--nihsa-secondary); }

        .forecast-day {
            text-align: center;
            padding: 1rem;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 10px;
            border: 1px solid #dee2e6;
        }

        .forecast-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .time-slider {
            width: 100%;
            margin: 20px 0;
        }

        .export-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .data-table {
            font-size: 0.9rem;
        }

        .data-table th {
            background: var(--nihsa-light);
            border-top: none;
            font-weight: 600;
            color: var(--nihsa-dark);
        }

        .progress-thin {
            height: 4px;
        }

        .map-controls {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1000;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            border: 1px solid #dee2e6;
        }

        .basemap-selector {
            margin-bottom: 10px;
        }

        .overlay-controls {
            margin-top: 10px;
        }

        .overlay-controls label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        /* Button Styles */
        .btn-primary {
            background-color: var(--nihsa-primary);
            border-color: var(--nihsa-primary);
        }

        .btn-primary:hover {
            background-color: #004494;
            border-color: #004494;
        }

        .btn-success {
            background-color: var(--nihsa-secondary);
            border-color: var(--nihsa-secondary);
        }

        .btn-info {
            background-color: var(--nihsa-accent);
            border-color: var(--nihsa-accent);
        }

        @media (max-width: 768px) {
            .dashboard-hero h1 {
                font-size: 2rem;
            }



            .export-buttons {
                justify-content: center;
            }

            .stats-number {
                font-size: 2rem;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="dashboard-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1><i class="fas fa-chart-line me-3"></i>Flood Forecast Dashboard</h1>
                    <p class="lead mb-4">Real-time flood risk monitoring and forecasting system for Nigeria. Access comprehensive hydrological data, risk assessments, and early warning systems to support disaster preparedness and water resource management.</p>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="#statistics" class="btn btn-light">
                            <i class="fas fa-chart-bar me-2"></i>View Statistics
                        </a>
                        <a href="#map-section" class="btn btn-outline-light">
                            <i class="fas fa-map me-2"></i>Interactive Map
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <div class="export-buttons">
                        <button class="btn btn-light btn-sm" onclick="exportData('csv')" title="Export as CSV">
                            <i class="fas fa-file-csv me-1"></i> CSV
                        </button>
                        <button class="btn btn-light btn-sm" onclick="exportData('geojson')" title="Export as GeoJSON">
                            <i class="fas fa-map me-1"></i> GeoJSON
                        </button>
                        <button class="btn btn-light btn-sm" onclick="exportData('pdf')" title="Export as PDF">
                            <i class="fas fa-file-pdf me-1"></i> PDF
                        </button>
                        <button class="btn btn-outline-light btn-sm" onclick="shareUrl()" title="Share Dashboard">
                            <i class="fas fa-share me-1"></i> Share
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Cards -->
    <section id="statistics" class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="mb-3">Current Flood Risk Overview</h2>
                    <p class="text-muted">Real-time statistics showing flood risk distribution across Nigerian communities</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card risk-total">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="stats-number">{{ $statistics['total_communities'] }}</div>
                                <div class="stats-label">Total Communities</div>
                            </div>
                            <div class="text-primary">
                                <i class="fas fa-home fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card risk-high">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="stats-number">{{ $statistics['high_risk'] }}</div>
                                <div class="stats-label">High Risk Areas</div>
                            </div>
                            <div class="text-danger">
                                <i class="fas fa-exclamation-triangle fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card risk-moderate">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="stats-number">{{ $statistics['moderate_risk'] }}</div>
                                <div class="stats-label">Moderate Risk Areas</div>
                            </div>
                            <div class="text-warning">
                                <i class="fas fa-exclamation-circle fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card risk-low">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="stats-number">{{ $statistics['low_risk'] }}</div>
                                <div class="stats-label">Low Risk Areas</div>
                            </div>
                            <div class="text-success">
                                <i class="fas fa-check-circle fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Dashboard -->
    <section id="map-section" class="py-5">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="mb-3">Interactive Flood Risk Dashboard</h2>
                    <p class="text-muted">Comprehensive monitoring and analysis tools for flood risk assessment</p>
                </div>
            </div>
            <div class="row">
                <!-- Filters and Controls -->
                <div class="col-lg-3 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Controls</h5>
                        </div>
                        <div class="card-body">
                            <form id="filterForm">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Year</label>
                                    <select class="form-select" id="year" name="year">
                                        @foreach($availableYears as $yearOption)
                                            <option value="{{ $yearOption }}" {{ $year == $yearOption ? 'selected' : '' }}>{{ $yearOption }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="period" class="form-label">Period</label>
                                    <select class="form-select" id="period" name="period">
                                        <option value="all" {{ $period == 'all' ? 'selected' : '' }}>All Periods</option>
                                        @foreach($periods as $key => $label)
                                            <option value="{{ $key }}" {{ $period == $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-select" id="state" name="state">
                                        <option value="all" {{ $state == 'all' ? 'selected' : '' }}>All States</option>
                                        @foreach($nigerianStates as $stateOption)
                                            <option value="{{ $stateOption }}" {{ $state == $stateOption ? 'selected' : '' }}>{{ $stateOption }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="risk_level" class="form-label">Risk Level</label>
                                    <select class="form-select" id="risk_level" name="risk_level">
                                        <option value="all" {{ $riskLevel == 'all' ? 'selected' : '' }}>All Risk Levels</option>
                                        @foreach($riskLevels as $level)
                                            <option value="{{ $level }}" {{ $riskLevel == $level ? 'selected' : '' }}>{{ $level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="flood_type" class="form-label">Flood Type</label>
                                    <select class="form-select" id="flood_type" name="flood_type">
                                        <option value="all" {{ $floodType == 'all' ? 'selected' : '' }}>All Types</option>
                                        @foreach($floodTypes as $type)
                                            <option value="{{ $type }}" {{ $floodType == $type ? 'selected' : '' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="admin_level" class="form-label">Administrative Level</label>
                                    <select class="form-select" id="admin_level" name="admin_level">
                                        <option value="all" {{ $adminLevel == 'all' ? 'selected' : '' }}>All Levels</option>
                                        @foreach($adminLevels as $level)
                                            <option value="{{ $level }}" {{ $adminLevel == $level ? 'selected' : '' }}>{{ $level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i>Apply Filters
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Time Slider & Calendar Widget -->
                    <div class="dashboard-card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-calendar me-2"></i>Time Controls</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="forecast_date" class="form-label">Select Forecast Date</label>
                                <input type="date" class="form-control" id="forecast_date" name="forecast_date" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <label for="time_range" class="form-label">Time Range</label>
                                <input type="range" class="form-range time-slider" id="time_range" min="0" max="23" value="12">
                                <div class="d-flex justify-content-between">
                                    <small>00:00</small>
                                    <small id="current_time">12:00</small>
                                    <small>23:00</small>
                                </div>
                            </div>
                            <button class="btn btn-info w-100" onclick="animateTimeProgression()">
                                <i class="fas fa-play me-2"></i>Animate Progression
                            </button>
                        </div>
                    </div>

                    <!-- Sensor Status Dashboard -->
                    <div class="dashboard-card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-satellite-dish me-2"></i>Sensor Status</h5>
                        </div>
                        <div class="card-body">
                            @foreach($sensorData as $sensor)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <small class="fw-bold">{{ $sensor['name'] }}</small>
                                        <span class="sensor-status status-{{ strtolower($sensor['status']) }}">
                                            {{ $sensor['status'] }}
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold">{{ $sensor['current_value'] }} {{ $sensor['unit'] }}</span>
                                        <small class="text-muted">{{ $sensor['last_updated']->diffForHumans() }}</small>
                                    </div>
                                    <div class="progress progress-thin mt-1">
                                        @php
                                            $percentage = ($sensor['current_value'] / $sensor['threshold_critical']) * 100;
                                            $percentage = min(100, max(0, $percentage));
                                        @endphp
                                        <div class="progress-bar
                                            @if($sensor['status'] === 'Critical') bg-danger
                                            @elseif($sensor['status'] === 'Warning') bg-warning
                                            @else bg-success
                                            @endif"
                                            style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Community Alerts -->
                    <div class="dashboard-card">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Active Alerts</h5>
                        </div>
                        <div class="card-body">
                            @foreach($communityAlerts as $alert)
                                <div class="alert-card dashboard-card mb-3 alert-{{ strtolower($alert['risk_level']) }}">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="mb-0">{{ $alert['state'] }} - {{ $alert['lga'] }}</h6>
                                            <span class="badge bg-{{ $alert['risk_level'] === 'High' ? 'danger' : ($alert['risk_level'] === 'Moderate' ? 'warning' : 'success') }}">
                                                {{ $alert['alert_type'] }}
                                            </span>
                                        </div>
                                        <p class="mb-2 small">{{ $alert['description'] }}</p>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">
                                                <i class="fas fa-clock me-1"></i>
                                                Valid until {{ $alert['valid_until']->format('M j, H:i') }}
                                            </small>
                                            <small class="text-muted">
                                                {{ count($alert['communities']) }} communities
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Interactive Map Access -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-map me-2"></i>Interactive Flood Risk Map</h5>
                        </div>
                        <div class="card-body text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-map-marked-alt text-primary" style="font-size: 4rem; opacity: 0.7;"></i>
                            </div>
                            <h4 class="mb-3">View Interactive Map</h4>
                            <p class="text-muted mb-4">
                                Access the full interactive flood risk map with detailed markers,
                                legend, and real-time data visualization for all Nigerian communities.
                            </p>
                            <div class="d-grid gap-2">
                                <a href="{{ route('map') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-external-link-alt me-2"></i>
                                    Open Interactive Map
                                </a>
                                <small class="text-muted mt-2">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Opens in new page with full map functionality
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Temporal Forecasting & Data Tables -->
                <div class="col-lg-3 mb-4">
                    <!-- 7-Day Forecast -->
                    <div class="dashboard-card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-cloud-rain me-2"></i>7-Day Forecast</h5>
                        </div>
                        <div class="card-body">
                            @foreach($forecastData as $forecast)
                                <div class="forecast-day">
                                    <div class="forecast-icon">
                                        @if($forecast['flood_risk'] === 'High')
                                            <i class="fas fa-exclamation-triangle text-danger"></i>
                                        @elseif($forecast['flood_risk'] === 'Moderate')
                                            <i class="fas fa-exclamation-circle text-warning"></i>
                                        @else
                                            <i class="fas fa-check-circle text-success"></i>
                                        @endif
                                    </div>
                                    <h6>{{ $forecast['day_name'] }}</h6>
                                    <p class="mb-1"><strong>{{ $forecast['expected_rainfall'] }}mm</strong></p>
                                    <p class="mb-1">{{ $forecast['rainfall_probability'] }}% chance</p>
                                    <span class="badge bg-{{ $forecast['flood_risk'] === 'High' ? 'danger' : ($forecast['flood_risk'] === 'Moderate' ? 'warning' : 'success') }}">
                                        {{ $forecast['flood_risk'] }} Risk
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="dashboard-card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Quick Stats</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Population at Risk:</span>
                                    <strong>{{ number_format($statistics['total_population_at_risk']) }}</strong>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Affected Area:</span>
                                    <strong>{{ number_format($statistics['total_affected_area'], 1) }} km²</strong>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>States Affected:</span>
                                    <strong>{{ $statistics['states_affected'] }}</strong>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>LGAs Affected:</span>
                                    <strong>{{ $statistics['lgas_affected'] }}</strong>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button class="btn btn-outline-primary btn-sm" onclick="downloadReport()">
                                    <i class="fas fa-download me-1"></i> Download Report
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Tables & Charts Section -->
    <section class="py-5 bg-light">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="mb-3">Detailed Analysis & Reports</h2>
                    <p class="text-muted">Community-level data and hydrological time series analysis</p>
                </div>
            </div>
            <div class="row">
                <!-- Community-Level Alerts & Listings -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Community-Level Risk Listings</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover data-table">
                                    <thead>
                                        <tr>
                                            <th>State</th>
                                            <th>LGA</th>
                                            <th>Community</th>
                                            <th>Risk Level</th>
                                            <th>Flood Type</th>
                                            <th>Population</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($floodData as $data)
                                            <tr>
                                                <td>{{ $data['state'] }}</td>
                                                <td>{{ $data['lga'] }}</td>
                                                <td>{{ $data['community'] }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $data['risk'] === 'High' ? 'danger' : ($data['risk'] === 'Moderate' ? 'warning' : 'success') }}">
                                                        {{ $data['risk'] }}
                                                    </span>
                                                </td>
                                                <td>{{ $data['flood_type'] }}</td>
                                                <td>{{ number_format($data['affected_population']) }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary" onclick="viewDetails({{ $data['id'] }})">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-info" onclick="zoomToLocation({{ $data['lat'] }}, {{ $data['lng'] }})">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hydrographs & Time Series -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Rainfall & Water Level Time Series</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="timeSeriesChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Help & Methodology Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="mb-3">About This Dashboard</h2>
                    <p class="text-muted">Technical information and support resources</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="dashboard-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Dashboard Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h6 class="text-primary"><i class="fas fa-database me-2"></i>Data Sources</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Rainfall Models (ECMWF, GFS)</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Hydrodynamic Simulations</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Real-time Sensor Networks</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Satellite Observations</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Ground-based Weather Stations</li>
                                    </ul>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <h6 class="text-primary"><i class="fas fa-clock me-2"></i>Update Frequency</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-sync text-info me-2"></i>Forecasts: Daily at 06:00 UTC</li>
                                        <li class="mb-2"><i class="fas fa-sync text-info me-2"></i>Sensor Data: Every 15 minutes</li>
                                        <li class="mb-2"><i class="fas fa-sync text-info me-2"></i>Alerts: Real-time</li>
                                        <li class="mb-2"><i class="fas fa-sync text-info me-2"></i>Maps: Every 6 hours</li>
                                        <li class="mb-2"><i class="fas fa-sync text-info me-2"></i>Statistics: Hourly</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h6 class="text-primary"><i class="fas fa-shield-alt me-2"></i>Data Quality</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Quality controlled observations</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Validated forecast models</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Peer-reviewed methodologies</li>
                                    </ul>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <h6 class="text-primary"><i class="fas fa-users me-2"></i>Target Users</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-user-tie text-warning me-2"></i>Emergency Management Agencies</li>
                                        <li class="mb-2"><i class="fas fa-user-tie text-warning me-2"></i>Water Resource Managers</li>
                                        <li class="mb-2"><i class="fas fa-user-tie text-warning me-2"></i>Research Institutions</li>
                                        <li class="mb-2"><i class="fas fa-user-tie text-warning me-2"></i>Government Officials</li>
                                    </ul>
                                </div>
                            </div>

                            <hr class="my-4">
                            <div class="text-center">
                                <h6 class="mb-3">Need Support or Have Questions?</h6>
                                <p class="text-muted mb-4">Our technical team is available to assist with data interpretation and system usage.</p>
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    <a href="mailto:info@nihsa.gov.ng" class="btn btn-primary">
                                        <i class="fas fa-envelope me-2"></i> Email Support
                                    </a>
                                    <a href="{{ route('contact.index') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-phone me-2"></i> Contact Us
                                    </a>
                                    <a href="{{ route('about') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-info-circle me-2"></i> About NIHSA
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing dashboard...');

            try {
                initializeCharts();
                console.log('Charts initialized');

                initializeEventListeners();
                console.log('Event listeners initialized');

                // Call handleMobileView
                handleMobileView();

            } catch (error) {
                console.error('Error during initialization:', error);
            }
        });






                            maxZoom: 19,
                            subdomains: ['a', 'b', 'c']
                        });
                    } catch (error) {
                        console.log('OpenStreetMap failed, trying CartoDB...');
                        tileLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                            maxZoom: 19,
                            subdomains: 'abcd'
                        });
                    }
            }

            // Add error handling
            tileLayer.on('tileerror', function(error, tile) {
                console.log('Tile loading error:', error);
            });

            tileLayer.addTo(map);
            currentBasemap = type;

            // Force map refresh
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        }

        function addMapControls() {
            // Add zoom control
            L.control.zoom({
                position: 'topright'
            }).addTo(map);

            // Add scale control
            L.control.scale().addTo(map);
        }

        function loadFloodData() {
            // Get current filter values
            const filters = {
                year: document.getElementById('year').value,
                period: document.getElementById('period').value,
                state: document.getElementById('state').value,
                risk_level: document.getElementById('risk_level').value,
                flood_type: document.getElementById('flood_type').value,
                admin_level: document.getElementById('admin_level').value
            };

            // Load flood data from server
            fetch('{{ route("flood-forecast-dashboard.api.data") }}?' + new URLSearchParams({
                type: 'flood_data',
                ...filters
            }))
            .then(response => response.json())
            .then(data => {
                displayFloodMarkers(data);
            })
            .catch(error => {
                console.error('Error loading flood data:', error);
            });
        }

        function displayFloodMarkers(floodData) {
            // Clear existing markers
            floodMarkers.forEach(marker => map.removeLayer(marker));
            floodMarkers = [];

            // Add new markers
            floodData.forEach(function(point) {
                let color, borderColor;
                switch(point.risk) {
                    case 'High':
                        color = '#ff0000';
                        borderColor = '#cc0000';
                        break;
                    case 'Moderate':
                        color = '#ffa500';
                        borderColor = '#cc8400';
                        break;
                    case 'Low':
                        color = '#ffff00';
                        borderColor = '#cccc00';
                        break;
                    default:
                        color = '#0000ff';
                        borderColor = '#0000cc';
                }

                // Adjust marker style based on flood type
                let radius = 8;
                if (point.flood_type === 'Coastal') {
                    color = '#00cc66';
                    borderColor = '#009944';
                } else if (point.flood_type === 'Flash/Urban') {
                    color = '#9900cc';
                    borderColor = '#770099';
                    radius = 6;
                } else if (point.flood_type === 'Riverine') {
                    color = '#0066cc';
                    borderColor = '#004499';
                    radius = 10;
                }

                const marker = L.circleMarker([point.lat, point.lng], {
                    radius: radius,
                    fillColor: color,
                    color: borderColor,
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.8
                }).addTo(map);

                // Create popup content
                const popupContent = `
                    <div class="flood-popup">
                        <h6><strong>${point.state} - ${point.lga}</strong></h6>
                        <p><strong>Community:</strong> ${point.community}</p>
                        <p><strong>Risk Level:</strong> <span class="badge bg-${point.risk === 'High' ? 'danger' : (point.risk === 'Moderate' ? 'warning' : 'success')}">${point.risk}</span></p>
                        <p><strong>Flood Type:</strong> ${point.flood_type}</p>
                        <p><strong>Probability:</strong> ${point.probability}%</p>
                        <p><strong>Population at Risk:</strong> ${point.affected_population.toLocaleString()}</p>
                        <p><strong>Affected Area:</strong> ${point.affected_area} km²</p>
                        <p><strong>Expected Rainfall:</strong> ${point.expected_rainfall}mm</p>
                        <hr>
                        <p class="mb-0">${point.description}</p>
                        <div class="mt-2">
                            <button class="btn btn-sm btn-primary" onclick="viewDetails(${point.id})">
                                <i class="fas fa-info-circle me-1"></i> Details
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="sendAlert(${point.id})">
                                <i class="fas fa-bell me-1"></i> Alert
                            </button>
                        </div>
                    </div>
                `;

                marker.bindPopup(popupContent, {
                    maxWidth: 300,
                    className: 'flood-popup-container'
                });

                floodMarkers.push(marker);
            });
        }

        function initializeCharts() {
            // Initialize time series chart
            const ctx = document.getElementById('timeSeriesChart').getContext('2d');
            const timeSeriesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Rainfall (mm)',
                        data: [45, 52, 78, 125, 180, 220, 280, 320, 250, 150, 80, 55],
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.1,
                        yAxisID: 'y'
                    }, {
                        label: 'Water Level (m)',
                        data: [2.1, 2.3, 2.8, 3.2, 4.1, 4.8, 5.2, 5.8, 4.9, 3.5, 2.8, 2.2],
                        borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        tension: 0.1,
                        yAxisID: 'y1'
                    }]
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Rainfall (mm)'
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Water Level (m)'
                            },
                            grid: {
                                drawOnChartArea: false,
                            },
                        }
                    }
                }
            });
        }

        function initializeEventListeners() {
            // Filter form submission
            document.getElementById('filterForm').addEventListener('submit', function(e) {
                e.preventDefault();
                updateStatistics();
            });

            // Time slider
            document.getElementById('time_range').addEventListener('input', function(e) {
                const hour = e.target.value;
                document.getElementById('current_time').textContent = hour.padStart(2, '0') + ':00';
            });

            // Date picker
            flatpickr("#forecast_date", {
                dateFormat: "Y-m-d",
                defaultDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    updateForecastForDate(dateStr);
                }
            });
        }

        // Export functions
        function exportData(format) {
            const filters = {
                year: document.getElementById('year').value,
                period: document.getElementById('period').value,
                state: document.getElementById('state').value,
                risk_level: document.getElementById('risk_level').value,
                flood_type: document.getElementById('flood_type').value,
                admin_level: document.getElementById('admin_level').value,
                format: format
            };

            const url = '{{ route("flood-forecast-dashboard.export") }}?' + new URLSearchParams(filters);
            window.open(url, '_blank');
        }

        function shareUrl() {
            const filters = {
                year: document.getElementById('year').value,
                period: document.getElementById('period').value,
                state: document.getElementById('state').value,
                risk_level: document.getElementById('risk_level').value,
                flood_type: document.getElementById('flood_type').value,
                admin_level: document.getElementById('admin_level').value
            };

            const url = window.location.origin + window.location.pathname + '?' + new URLSearchParams(filters);

            if (navigator.share) {
                navigator.share({
                    title: 'NIHSA Flood Forecast Dashboard',
                    text: 'Check out the current flood risk situation in Nigeria',
                    url: url
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(url).then(function() {
                    alert('URL copied to clipboard!');
                });
            }
        }



        function zoomToLocation(lat, lng) {
            map.setView([lat, lng], 12);

            // Find and open the popup for this location
            floodMarkers.forEach(marker => {
                const markerLatLng = marker.getLatLng();
                if (Math.abs(markerLatLng.lat - lat) < 0.001 && Math.abs(markerLatLng.lng - lng) < 0.001) {
                    marker.openPopup();
                }
            });
        }

        // Animation functions
        function animateTimeProgression() {
            if (isAnimating) {
                isAnimating = false;
                return;
            }

            isAnimating = true;
            const slider = document.getElementById('time_range');
            let currentHour = 0;

            const interval = setInterval(() => {
                if (!isAnimating || currentHour > 23) {
                    clearInterval(interval);
                    isAnimating = false;
                    return;
                }

                slider.value = currentHour;
                document.getElementById('current_time').textContent = currentHour.toString().padStart(2, '0') + ':00';
                updateMapForTime(currentHour);
                currentHour++;
            }, 500);
        }

        function updateMapForTime(hour) {
            // Update map visualization based on time
            // This would typically involve updating the data displayed on the map
            // For demo purposes, we'll just update the opacity of markers
            const opacity = 0.3 + (Math.sin(hour * Math.PI / 12) + 1) * 0.35;
            floodMarkers.forEach(marker => {
                marker.setStyle({ fillOpacity: opacity });
            });
        }

        // Data interaction functions
        function viewDetails(floodId) {
            // This would typically open a modal or navigate to a detail page
            alert(`Viewing details for flood area ID: ${floodId}`);
        }

        function sendAlert(floodId) {
            // This would typically send an alert to relevant authorities
            if (confirm('Send alert for this flood risk area?')) {
                alert(`Alert sent for flood area ID: ${floodId}`);
            }
        }

        function downloadReport() {
            // Generate and download a comprehensive report
            exportData('pdf');
        }

        function updateStatistics() {
            // Update statistics based on current filters
            // This would typically make an AJAX call to get updated stats
            console.log('Updating statistics...');
        }

        function updateForecastForDate(dateStr) {
            // Update forecast data for selected date
            console.log('Updating forecast for date:', dateStr);
        }

        // User Authentication/API functions (if needed)
        function authenticateUser() {
            // Handle user authentication for API access
            console.log('Authenticating user...');
        }

        // Mobile responsiveness
        function handleMobileView() {
            if (window.innerWidth < 768) {
                document.getElementById('map').style.height = '400px';
                if (typeof map !== 'undefined' && map) {
                    map.invalidateSize();
                }
            }
        }

        // Event listeners for responsive design
        window.addEventListener('resize', handleMobileView);
        window.addEventListener('orientationchange', function() {
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        });

        // Initialize mobile view on load
        handleMobileView();
    </script>
@endsection
