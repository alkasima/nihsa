@extends('layouts.admin')

@section('title', 'Downloadable Reports')

@section('styles')
    <style>
        .report-card {
            transition: all 0.3s;
        }
        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .report-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .badge-analytics {
            background-color: #4e73df;
            color: white;
        }
        .badge-flood-data {
            background-color: #1cc88a;
            color: white;
        }
        .badge-user-activity {
            background-color: #f6c23e;
            color: white;
        }
    </style>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Downloadable Reports</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Downloadable Reports</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#generateReportModal">
                <i class="fas fa-plus me-1"></i> Generate New Report
            </button>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.reports.downloads') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="report_type" class="form-label">Report Type</label>
                    <select class="form-select" id="report_type" name="report_type">
                        @foreach($reportTypes as $key => $value)
                            <option value="{{ $key }}" {{ request('report_type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="report_format" class="form-label">Format</label>
                    <select class="form-select" id="report_format" name="report_format">
                        @foreach($reportFormats as $key => $value)
                            <option value="{{ $key }}" {{ request('report_format') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Search by title or description">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="{{ route('admin.reports.downloads') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Reports List -->
    <div class="row g-4">
        @foreach($reports as $report)
            <div class="col-md-6 col-lg-4">
                <div class="card report-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="report-icon 
                                @if($report['type'] == 'analytics') bg-primary 
                                @elseif($report['type'] == 'flood-data') bg-success 
                                @else bg-warning 
                                @endif text-white me-3">
                                @if($report['type'] == 'analytics')
                                    <i class="fas fa-chart-line"></i>
                                @elseif($report['type'] == 'flood-data')
                                    <i class="fas fa-water"></i>
                                @else
                                    <i class="fas fa-user-clock"></i>
                                @endif
                            </div>
                            <div>
                                <span class="badge 
                                    @if($report['type'] == 'analytics') badge-analytics 
                                    @elseif($report['type'] == 'flood-data') badge-flood-data 
                                    @else badge-user-activity 
                                    @endif mb-1">
                                    @if($report['type'] == 'analytics')
                                        Analytics
                                    @elseif($report['type'] == 'flood-data')
                                        Flood Data
                                    @else
                                        User Activity
                                    @endif
                                </span>
                                <h5 class="card-title mb-0">{{ $report['title'] }}</h5>
                            </div>
                        </div>
                        <p class="card-text text-muted">{{ $report['description'] }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <span class="badge bg-light text-dark me-2">{{ $report['format'] }}</span>
                                <span class="badge bg-light text-dark me-2">{{ $report['size'] }}</span>
                                <span class="badge bg-light text-dark">{{ $report['download_count'] }} downloads</span>
                            </div>
                            <a href="{{ route('admin.reports.download', $report['id']) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i> Download
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-muted small">
                        <i class="fas fa-calendar-alt me-1"></i> Generated on {{ date('M d, Y', strtotime($report['created_at'])) }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Generate Report Modal -->
    <div class="modal fade" id="generateReportModal" tabindex="-1" aria-labelledby="generateReportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="generateReportModalLabel">Generate New Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.reports.generate') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="report_type_modal" class="form-label">Report Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="report_type_modal" name="report_type" required>
                                <option value="analytics">Website Analytics</option>
                                <option value="flood-data">Flood Data</option>
                                <option value="user-activity">User Activity</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="report_format_modal" class="form-label">Report Format <span class="text-danger">*</span></label>
                            <select class="form-select" id="report_format_modal" name="report_format" required>
                                <option value="PDF">PDF</option>
                                <option value="Excel">Excel</option>
                                <option value="CSV">CSV</option>
                                <option value="GeoJSON">GeoJSON</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date_range" class="form-label">Date Range <span class="text-danger">*</span></label>
                            <select class="form-select" id="date_range" name="date_range" required>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="last-7-days">Last 7 Days</option>
                                <option value="last-30-days" selected>Last 30 Days</option>
                                <option value="this-month">This Month</option>
                                <option value="last-month">Last Month</option>
                                <option value="this-year">This Year</option>
                                <option value="last-year">Last Year</option>
                                <option value="custom">Custom Range</option>
                            </select>
                        </div>
                        <div class="mb-3 custom-date-range" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date">
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Report Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Generate Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show/hide custom date range based on date range selection
            const dateRange = document.getElementById('date_range');
            const customDateRange = document.querySelector('.custom-date-range');
            
            dateRange.addEventListener('change', function() {
                if (this.value === 'custom') {
                    customDateRange.style.display = 'block';
                } else {
                    customDateRange.style.display = 'none';
                }
            });
            
            // Set default dates for custom range
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');
            
            const today = new Date();
            const thirtyDaysAgo = new Date();
            thirtyDaysAgo.setDate(today.getDate() - 30);
            
            startDate.valueAsDate = thirtyDaysAgo;
            endDate.valueAsDate = today;
            
            // Auto-generate report title based on type and date range
            const reportTypeModal = document.getElementById('report_type_modal');
            const title = document.getElementById('title');
            
            function updateTitle() {
                const reportType = reportTypeModal.options[reportTypeModal.selectedIndex].text;
                const dateRangeText = dateRange.options[dateRange.selectedIndex].text;
                const currentMonth = today.toLocaleString('default', { month: 'long' });
                const currentYear = today.getFullYear();
                
                title.value = `${reportType} Report - ${currentMonth} ${currentYear}`;
            }
            
            reportTypeModal.addEventListener('change', updateTitle);
            dateRange.addEventListener('change', updateTitle);
            
            // Initial title update
            updateTitle();
        });
    </script>
@endsection
