@extends('layouts.admin')

@section('title', 'View User')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">User Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">View User</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">User Profile: {{ $user['name'] }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.users.edit', $user['id']) }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-edit me-1"></i> Edit User
                </a>
                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fas fa-trash me-1"></i> Delete User
                </button>
            </div>
        </div>
    </div>
    
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the user "{{ $user['name'] }}"? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.users.destroy', $user['id']) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px; font-size: 40px;">
                            {{ substr($user['name'], 0, 1) }}
                        </div>
                    </div>
                    <h4 class="card-title">{{ $user['name'] }}</h4>
                    <p class="card-text text-muted">
                        @if($user['role'] == 'admin')
                            <span class="badge bg-danger">Admin</span>
                        @elseif($user['role'] == 'editor')
                            <span class="badge bg-primary">Editor</span>
                        @elseif($user['role'] == 'viewer')
                            <span class="badge bg-info">Viewer</span>
                        @endif
                    </p>
                    <p class="card-text">
                        @if($user['status'] == 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </p>
                    <div class="d-grid gap-2">
                        <a href="mailto:{{ $user['email'] }}" class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-1"></i> Send Email
                        </a>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Email:</strong> {{ $user['email'] }}
                    </li>
                    <li class="list-group-item">
                        <strong>Phone:</strong> {{ $user['profile']['phone'] ?? 'Not provided' }}
                    </li>
                    <li class="list-group-item">
                        <strong>Department:</strong> {{ $user['profile']['department'] ?? 'Not provided' }}
                    </li>
                    <li class="list-group-item">
                        <strong>Position:</strong> {{ $user['profile']['position'] ?? 'Not provided' }}
                    </li>
                    <li class="list-group-item">
                        <strong>Created:</strong> {{ date('F j, Y', strtotime($user['created_at'])) }}
                    </li>
                    <li class="list-group-item">
                        <strong>Last Login:</strong> {{ date('F j, Y g:i A', strtotime($user['last_login'])) }}
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">User Bio</h5>
                </div>
                <div class="card-body">
                    <p>{{ $user['profile']['bio'] ?? 'No bio provided.' }}</p>
                </div>
            </div>
            
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Permissions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Manage Users
                                    @if($user['permissions']['manage_users'] ?? false)
                                        <span class="badge bg-success rounded-pill"><i class="fas fa-check"></i></span>
                                    @else
                                        <span class="badge bg-danger rounded-pill"><i class="fas fa-times"></i></span>
                                    @endif
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Manage News
                                    @if($user['permissions']['manage_news'] ?? false)
                                        <span class="badge bg-success rounded-pill"><i class="fas fa-check"></i></span>
                                    @else
                                        <span class="badge bg-danger rounded-pill"><i class="fas fa-times"></i></span>
                                    @endif
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Manage Publications
                                    @if($user['permissions']['manage_publications'] ?? false)
                                        <span class="badge bg-success rounded-pill"><i class="fas fa-check"></i></span>
                                    @else
                                        <span class="badge bg-danger rounded-pill"><i class="fas fa-times"></i></span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Manage Flood Data
                                    @if($user['permissions']['manage_flood_data'] ?? false)
                                        <span class="badge bg-success rounded-pill"><i class="fas fa-check"></i></span>
                                    @else
                                        <span class="badge bg-danger rounded-pill"><i class="fas fa-times"></i></span>
                                    @endif
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Manage Data Requests
                                    @if($user['permissions']['manage_data_requests'] ?? false)
                                        <span class="badge bg-success rounded-pill"><i class="fas fa-check"></i></span>
                                    @else
                                        <span class="badge bg-danger rounded-pill"><i class="fas fa-times"></i></span>
                                    @endif
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Manage Settings
                                    @if($user['permissions']['manage_settings'] ?? false)
                                        <span class="badge bg-success rounded-pill"><i class="fas fa-check"></i></span>
                                    @else
                                        <span class="badge bg-danger rounded-pill"><i class="fas fa-times"></i></span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle me-2"></i> Permissions are determined by the user's role. To change permissions, edit the user's role.
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @if(!empty($user['activity']))
                            @foreach($user['activity'] as $activity)
                                <div class="timeline-item mb-3 pb-3 border-bottom">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-history"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <div class="fw-bold">{{ $activity['action'] }}</div>
                                            <div>{{ $activity['item'] }}</div>
                                            <div class="text-muted small">{{ date('F j, Y g:i A', strtotime($activity['timestamp'])) }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">No recent activity found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
