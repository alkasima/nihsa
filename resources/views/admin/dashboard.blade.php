@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Print</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <i class="fas fa-calendar me-1"></i> This Week
            </button>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card card-dashboard text-center h-100">
                <div class="card-body">
                    <div class="icon mb-3">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="count">{{ $newsCount }}</div>
                    <div class="title">News Articles</div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-primary">Manage News</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card card-dashboard text-center h-100">
                <div class="card-body">
                    <div class="icon mb-3">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="count">{{ $publicationsCount }}</div>
                    <div class="title">Publications</div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('admin.publications.index') }}" class="btn btn-sm btn-primary">Manage Publications</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card card-dashboard text-center h-100">
                <div class="card-body">
                    <div class="icon mb-3">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="count">{{ $dataRequestsCount }}</div>
                    <div class="title">Data Requests</div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('admin.data-requests.index') }}" class="btn btn-sm btn-primary">View Requests</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card card-dashboard text-center h-100">
                <div class="card-body">
                    <div class="icon mb-3">
                        <i class="fas fa-water"></i>
                    </div>
                    <div class="count">{{ $floodDataCount }}</div>
                    <div class="title">Flood Data Entries</div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('admin.flood-data.index') }}" class="btn btn-sm btn-primary">Manage Flood Data</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <!-- Pending Data Requests -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pending Data Requests</h5>
                    <span class="badge bg-light text-primary">{{ $pendingDataRequestsCount }} Pending</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-admin">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Data Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestDataRequests as $request)
                                    <tr>
                                        <td>{{ $request['name'] }}</td>
                                        <td>{{ $request['data_type'] }}</td>
                                        <td>{{ date('M d, Y', strtotime($request['created_at'])) }}</td>
                                        <td>
                                            @if($request['status'] == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($request['status'] == 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($request['status'] == 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @elseif($request['status'] == 'delivered')
                                                <span class="badge bg-info">Delivered</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-outline-primary btn-icon">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if($request['status'] == 'pending')
                                                    <a href="#" class="btn btn-sm btn-outline-success btn-icon">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger btn-icon">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.data-requests.index') }}" class="btn btn-outline-primary">View All Requests</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Latest News -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Latest News</h5>
                    <a href="{{ route('admin.news.create') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-plus me-1"></i> Add News
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-admin">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestNews as $news)
                                    <tr>
                                        <td>{{ $news['title'] }}</td>
                                        <td><span class="badge bg-secondary">{{ $news['category'] }}</span></td>
                                        <td>{{ date('M d, Y', strtotime($news['published_at'])) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-outline-primary btn-icon">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-outline-secondary btn-icon">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-outline-danger btn-icon">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-primary">View All News</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <!-- Quick Stats -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Quick Stats</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Zonal Offices
                            <span class="badge bg-primary rounded-pill">{{ $zonalOfficesCount }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Partner Organizations
                            <span class="badge bg-primary rounded-pill">{{ $partnersCount }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Pending Data Requests
                            <span class="badge bg-warning rounded-pill">{{ $pendingDataRequestsCount }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Publications
                            <span class="badge bg-primary rounded-pill">{{ $publicationsCount }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total News Articles
                            <span class="badge bg-primary rounded-pill">{{ $newsCount }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item mb-3 pb-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="fw-bold">New article published</div>
                                    <div>2025 Annual Flood Outlook Released</div>
                                    <div class="text-muted small">May 5, 2025 - 10:30 AM</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="timeline-item mb-3 pb-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="fw-bold">Data request approved</div>
                                    <div>Groundwater Data request from Robert Johnson</div>
                                    <div class="text-muted small">May 3, 2025 - 2:15 PM</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="timeline-item mb-3 pb-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="fw-bold">New publication added</div>
                                    <div>Flood Mitigation & Adaptation Measures</div>
                                    <div class="text-muted small">May 2, 2025 - 11:45 AM</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="timeline-item mb-3 pb-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="fw-bold">New user registered</div>
                                    <div>Admin user added: Sarah Johnson</div>
                                    <div class="text-muted small">May 1, 2025 - 9:20 AM</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="fw-bold">System alert</div>
                                    <div>Database backup completed successfully</div>
                                    <div class="text-muted small">April 30, 2025 - 12:00 AM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Add any dashboard-specific JavaScript here
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Dashboard loaded');
        });
    </script>
@endsection
