@extends('layouts.admin')

@section('title', 'Website Analytics')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
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
    </style>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Website Analytics</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Website Analytics</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" id="export-pdf">
                    <i class="fas fa-file-pdf me-1"></i> Export PDF
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary" id="export-excel">
                    <i class="fas fa-file-excel me-1"></i> Export Excel
                </button>
            </div>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dateRangeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-calendar me-1"></i> 
                    @if($dateRange == 'today')
                        Today
                    @elseif($dateRange == 'yesterday')
                        Yesterday
                    @elseif($dateRange == 'last-7-days')
                        Last 7 Days
                    @elseif($dateRange == 'last-30-days')
                        Last 30 Days
                    @elseif($dateRange == 'this-month')
                        This Month
                    @elseif($dateRange == 'last-month')
                        Last Month
                    @else
                        Custom Range
                    @endif
                </button>
                <ul class="dropdown-menu" aria-labelledby="dateRangeDropdown">
                    <li><a class="dropdown-item" href="?date_range=today">Today</a></li>
                    <li><a class="dropdown-item" href="?date_range=yesterday">Yesterday</a></li>
                    <li><a class="dropdown-item" href="?date_range=last-7-days">Last 7 Days</a></li>
                    <li><a class="dropdown-item" href="?date_range=last-30-days">Last 30 Days</a></li>
                    <li><a class="dropdown-item" href="?date_range=this-month">This Month</a></li>
                    <li><a class="dropdown-item" href="?date_range=last-month">Last Month</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" id="custom-range">Custom Range</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stats-icon bg-primary text-white me-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 text-muted">Total Visitors</h6>
                        </div>
                    </div>
                    <h3 class="mb-0">{{ number_format($visitorStats['total_visitors']) }}</h3>
                    <div class="text-success mt-2">
                        <i class="fas fa-arrow-up me-1"></i> 12.5% from last period
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stats-icon bg-success text-white me-3">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 text-muted">Page Views</h6>
                        </div>
                    </div>
                    <h3 class="mb-0">{{ number_format($visitorStats['page_views']) }}</h3>
                    <div class="text-success mt-2">
                        <i class="fas fa-arrow-up me-1"></i> 8.3% from last period
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stats-icon bg-info text-white me-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 text-muted">Avg. Session Duration</h6>
                        </div>
                    </div>
                    <h3 class="mb-0">{{ $visitorStats['avg_session_duration'] }}</h3>
                    <div class="text-success mt-2">
                        <i class="fas fa-arrow-up me-1"></i> 5.2% from last period
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stats-icon bg-warning text-white me-3">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0 text-muted">Bounce Rate</h6>
                        </div>
                    </div>
                    <h3 class="mb-0">{{ $visitorStats['bounce_rate'] }}</h3>
                    <div class="text-danger mt-2">
                        <i class="fas fa-arrow-up me-1"></i> 2.1% from last period
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4 mb-4">
        <!-- Visitors Chart -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Visitors Overview</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="visitorsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Traffic Sources -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Traffic Sources</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="trafficSourcesChart"></canvas>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                @foreach($trafficSources as $source)
                                    <tr>
                                        <td>
                                            <i class="fas fa-circle me-2" style="color: 
                                                @if($source['source'] == 'Direct') #4e73df
                                                @elseif($source['source'] == 'Organic Search') #1cc88a
                                                @elseif($source['source'] == 'Referral') #36b9cc
                                                @elseif($source['source'] == 'Social Media') #f6c23e
                                                @else #e74a3b
                                                @endif
                                            "></i>
                                            {{ $source['source'] }}
                                        </td>
                                        <td class="text-end">{{ number_format($source['visitors']) }}</td>
                                        <td class="text-end">{{ number_format($source['percentage'], 1) }}%</td>
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
        <!-- Popular Pages -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Popular Pages</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Page</th>
                                    <th class="text-end">Views</th>
                                    <th class="text-end">Avg. Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($popularPages as $page)
                                    <tr>
                                        <td>
                                            <a href="{{ $page['url'] }}" target="_blank" class="text-decoration-none">{{ $page['page'] }}</a>
                                        </td>
                                        <td class="text-end">{{ number_format($page['views']) }}</td>
                                        <td class="text-end">{{ $page['avg_time'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Visitor Demographics -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Visitor Devices</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="chart-container" style="height: 200px;">
                                <canvas id="devicesChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless">
                                    <tbody>
                                        @foreach($visitorDevices as $device)
                                            <tr>
                                                <td>
                                                    <i class="fas fa-circle me-2" style="color: 
                                                        @if($device['device'] == 'Desktop') #4e73df
                                                        @elseif($device['device'] == 'Mobile') #1cc88a
                                                        @else #36b9cc
                                                        @endif
                                                    "></i>
                                                    {{ $device['device'] }}
                                                </td>
                                                <td class="text-end">{{ number_format($device['visitors']) }}</td>
                                                <td class="text-end">{{ number_format($device['percentage'], 1) }}%</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Visitor Browsers</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="chart-container" style="height: 200px;">
                                <canvas id="browsersChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless">
                                    <tbody>
                                        @foreach($visitorBrowsers as $browser)
                                            <tr>
                                                <td>
                                                    <i class="fas fa-circle me-2" style="color: 
                                                        @if($browser['browser'] == 'Chrome') #4e73df
                                                        @elseif($browser['browser'] == 'Safari') #1cc88a
                                                        @elseif($browser['browser'] == 'Firefox') #36b9cc
                                                        @elseif($browser['browser'] == 'Edge') #f6c23e
                                                        @else #e74a3b
                                                        @endif
                                                    "></i>
                                                    {{ $browser['browser'] }}
                                                </td>
                                                <td class="text-end">{{ number_format($browser['visitors']) }}</td>
                                                <td class="text-end">{{ number_format($browser['percentage'], 1) }}%</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <!-- Visitor Countries -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Visitor Countries</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th class="text-end">Visitors</th>
                                    <th class="text-end">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($visitorCountries as $country)
                                    <tr>
                                        <td>{{ $country['country'] }}</td>
                                        <td class="text-end">{{ number_format($country['visitors']) }}</td>
                                        <td class="text-end">{{ number_format($country['percentage'], 1) }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Visitor Types -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Visitor Types</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="chart-container" style="height: 200px;">
                                <canvas id="visitorTypesChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <i class="fas fa-circle me-2" style="color: #4e73df"></i>
                                                New Visitors
                                            </td>
                                            <td class="text-end">{{ number_format($visitorStats['total_visitors'] * floatval($visitorStats['new_visitors']) / 100) }}</td>
                                            <td class="text-end">{{ $visitorStats['new_visitors'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fas fa-circle me-2" style="color: #1cc88a"></i>
                                                Returning Visitors
                                            </td>
                                            <td class="text-end">{{ number_format($visitorStats['total_visitors'] * floatval($visitorStats['returning_visitors']) / 100) }}</td>
                                            <td class="text-end">{{ $visitorStats['returning_visitors'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Date Range Picker Modal -->
    <div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateRangeModalLabel">Select Date Range</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.reports.analytics') }}" method="GET">
                        <div class="mb-3">
                            <label for="date_range_picker" class="form-label">Date Range</label>
                            <input type="text" class="form-control" id="date_range_picker" name="custom_date_range">
                            <input type="hidden" name="date_range" value="custom">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Visitors Chart
            const visitorsCtx = document.getElementById('visitorsChart').getContext('2d');
            const visitorsChart = new Chart(visitorsCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_column($monthlyVisitors, 'month')) !!},
                    datasets: [
                        {
                            label: 'Visitors',
                            data: {!! json_encode(array_column($monthlyVisitors, 'visitors')) !!},
                            backgroundColor: 'rgba(78, 115, 223, 0.05)',
                            borderColor: 'rgba(78, 115, 223, 1)',
                            borderWidth: 2,
                            pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            fill: true,
                            tension: 0.3
                        },
                        {
                            label: 'Page Views',
                            data: {!! json_encode(array_column($monthlyVisitors, 'page_views')) !!},
                            backgroundColor: 'rgba(28, 200, 138, 0.05)',
                            borderColor: 'rgba(28, 200, 138, 1)',
                            borderWidth: 2,
                            pointBackgroundColor: 'rgba(28, 200, 138, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            fill: true,
                            tension: 0.3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
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
            
            // Traffic Sources Chart
            const trafficSourcesCtx = document.getElementById('trafficSourcesChart').getContext('2d');
            const trafficSourcesChart = new Chart(trafficSourcesCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_column($trafficSources, 'source')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($trafficSources, 'percentage')) !!},
                        backgroundColor: [
                            '#4e73df',
                            '#1cc88a',
                            '#36b9cc',
                            '#f6c23e',
                            '#e74a3b'
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
                            display: false
                        }
                    },
                    cutout: '70%'
                }
            });
            
            // Devices Chart
            const devicesCtx = document.getElementById('devicesChart').getContext('2d');
            const devicesChart = new Chart(devicesCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_column($visitorDevices, 'device')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($visitorDevices, 'percentage')) !!},
                        backgroundColor: [
                            '#4e73df',
                            '#1cc88a',
                            '#36b9cc'
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
                            display: false
                        }
                    },
                    cutout: '70%'
                }
            });
            
            // Browsers Chart
            const browsersCtx = document.getElementById('browsersChart').getContext('2d');
            const browsersChart = new Chart(browsersCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_column($visitorBrowsers, 'browser')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($visitorBrowsers, 'percentage')) !!},
                        backgroundColor: [
                            '#4e73df',
                            '#1cc88a',
                            '#36b9cc',
                            '#f6c23e',
                            '#e74a3b'
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
                            display: false
                        }
                    },
                    cutout: '70%'
                }
            });
            
            // Visitor Types Chart
            const visitorTypesCtx = document.getElementById('visitorTypesChart').getContext('2d');
            const visitorTypesChart = new Chart(visitorTypesCtx, {
                type: 'doughnut',
                data: {
                    labels: ['New Visitors', 'Returning Visitors'],
                    datasets: [{
                        data: [
                            parseFloat('{{ $visitorStats['new_visitors'] }}'),
                            parseFloat('{{ $visitorStats['returning_visitors'] }}')
                        ],
                        backgroundColor: [
                            '#4e73df',
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
                            display: false
                        }
                    },
                    cutout: '70%'
                }
            });
            
            // Date Range Picker
            $('#date_range_picker').daterangepicker({
                opens: 'left',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });
            
            // Custom Range Modal
            $('#custom-range').on('click', function(e) {
                e.preventDefault();
                $('#dateRangeModal').modal('show');
            });
            
            // Export PDF
            $('#export-pdf').on('click', function() {
                alert('Exporting PDF...');
                // In a real implementation, we would send an AJAX request to generate and download the PDF
            });
            
            // Export Excel
            $('#export-excel').on('click', function() {
                alert('Exporting Excel...');
                // In a real implementation, we would send an AJAX request to generate and download the Excel file
            });
        });
    </script>
@endsection
