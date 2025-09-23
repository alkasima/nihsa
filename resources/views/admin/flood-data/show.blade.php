@extends('layouts.admin')

@section('title', 'View Flood Data')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.flood-data.index') }}">Flood Data Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Flood Data</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Flood Data Details</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.flood-data.edit', $floodData['id']) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash me-1"></i> Delete
                </button>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Location Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4"><strong>State:</strong></div>
                        <div class="col-sm-8">{{ $floodData['state'] }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4"><strong>LGA:</strong></div>
                        <div class="col-sm-8">{{ $floodData['lga'] }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4"><strong>Coordinates:</strong></div>
                        <div class="col-sm-8">
                            @if($floodData['latitude'] && $floodData['longitude'])
                                {{ $floodData['latitude'] }}, {{ $floodData['longitude'] }}
                                <a href="https://www.google.com/maps?q={{ $floodData['latitude'] }},{{ $floodData['longitude'] }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">
                                    <i class="fas fa-map-marker-alt"></i> View on Map
                                </a>
                            @else
                                <span class="text-muted">Not specified</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Temporal Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4"><strong>Year:</strong></div>
                        <div class="col-sm-8">{{ $floodData['year'] }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4"><strong>Period:</strong></div>
                        <div class="col-sm-8">
                            @switch($floodData['period'])
                                @case('AMJ')
                                    April-May-June
                                    @break
                                @case('JAS')
                                    July-August-September
                                    @break
                                @case('ON')
                                    October-November
                                    @break
                                @default
                                    {{ $floodData['period'] }}
                            @endswitch
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4"><strong>Forecast Date:</strong></div>
                        <div class="col-sm-8">{{ date('F j, Y', strtotime($floodData['forecast_date'])) }}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">Risk Assessment</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4"><strong>Risk Level:</strong></div>
                        <div class="col-sm-8">
                            <span class="badge bg-{{ $floodData['risk_level'] === 'High' ? 'danger' : ($floodData['risk_level'] === 'Moderate' ? 'warning' : 'success') }} fs-6">
                                {{ $floodData['risk_level'] }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4"><strong>Data Type:</strong></div>
                        <div class="col-sm-8">
                            <span class="badge bg-{{ $floodData['data_type'] === 'prediction' ? 'primary' : ($floodData['data_type'] === 'occurrence' ? 'info' : 'secondary') }} fs-6">
                                {{ ucfirst($floodData['data_type']) }}
                            </span>
                        </div>
                    </div>
                    @if(isset($floodData['details']['probability']))
                    <hr>
                    <div class="row">
                        <div class="col-sm-4"><strong>Probability:</strong></div>
                        <div class="col-sm-8">{{ $floodData['details']['probability'] }}</div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Impact Details</h5>
                </div>
                <div class="card-body">
                    @if(isset($floodData['details']['affected_area']))
                    <div class="row">
                        <div class="col-sm-6"><strong>Affected Area:</strong></div>
                        <div class="col-sm-6">{{ $floodData['details']['affected_area'] }}</div>
                    </div>
                    <hr>
                    @endif
                    
                    @if(isset($floodData['details']['population_at_risk']))
                    <div class="row">
                        <div class="col-sm-6"><strong>Population at Risk:</strong></div>
                        <div class="col-sm-6">{{ $floodData['details']['population_at_risk'] }}</div>
                    </div>
                    <hr>
                    @endif
                    
                    @if(isset($floodData['details']['expected_rainfall']))
                    <div class="row">
                        <div class="col-sm-6"><strong>Expected Rainfall:</strong></div>
                        <div class="col-sm-6">{{ $floodData['details']['expected_rainfall'] }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="card-title mb-0">Description</h5>
        </div>
        <div class="card-body">
            <p class="mb-0">{{ $floodData['description'] }}</p>
        </div>
    </div>
    
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('admin.flood-data.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>
        <div>
            <a href="{{ route('admin.flood-data.edit', $floodData['id']) }}" class="btn btn-primary me-2">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                <i class="fas fa-trash me-1"></i> Delete
            </button>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this flood data record? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.flood-data.destroy', $floodData['id']) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function confirmDelete() {
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endsection
