@extends('layouts.admin')

@section('title', 'Edit Flood Data')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.flood-data.index') }}">Flood Data Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Flood Data</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Flood Data</h1>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.flood-data.update', $floodData['id']) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Location Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                                    <select class="form-select @error('state') is-invalid @enderror" id="state" name="state" required>
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state }}" {{ (old('state', $floodData['state']) == $state) ? 'selected' : '' }}>{{ $state }}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="lga" class="form-label">Local Government Area <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('lga') is-invalid @enderror" id="lga" name="lga" value="{{ old('lga', $floodData['lga']) }}" required>
                                    @error('lga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="latitude" class="form-label">Latitude</label>
                                            <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude', $floodData['latitude']) }}" placeholder="e.g., 6.5244">
                                            @error('latitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="longitude" class="form-label">Longitude</label>
                                            <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude', $floodData['longitude']) }}" placeholder="e.g., 3.3792">
                                            @error('longitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Temporal Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                                            <select class="form-select @error('year') is-invalid @enderror" id="year" name="year" required>
                                                <option value="">Select Year</option>
                                                @for($year = 2020; $year <= 2030; $year++)
                                                    <option value="{{ $year }}" {{ (old('year', $floodData['year']) == $year) ? 'selected' : '' }}>{{ $year }}</option>
                                                @endfor
                                            </select>
                                            @error('year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="period" class="form-label">Period <span class="text-danger">*</span></label>
                                            <select class="form-select @error('period') is-invalid @enderror" id="period" name="period" required>
                                                <option value="">Select Period</option>
                                                <option value="AMJ" {{ (old('period', $floodData['period']) == 'AMJ') ? 'selected' : '' }}>April-May-June</option>
                                                <option value="JAS" {{ (old('period', $floodData['period']) == 'JAS') ? 'selected' : '' }}>July-August-September</option>
                                                <option value="ON" {{ (old('period', $floodData['period']) == 'ON') ? 'selected' : '' }}>October-November</option>
                                            </select>
                                            @error('period')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="forecast_date" class="form-label">Forecast Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('forecast_date') is-invalid @enderror" id="forecast_date" name="forecast_date" value="{{ old('forecast_date', $floodData['forecast_date']) }}" required>
                                    @error('forecast_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Risk Assessment</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="risk_level" class="form-label">Risk Level <span class="text-danger">*</span></label>
                                            <select class="form-select @error('risk_level') is-invalid @enderror" id="risk_level" name="risk_level" required>
                                                <option value="">Select Risk Level</option>
                                                <option value="High" {{ (old('risk_level', $floodData['risk_level']) == 'High') ? 'selected' : '' }}>High</option>
                                                <option value="Moderate" {{ (old('risk_level', $floodData['risk_level']) == 'Moderate') ? 'selected' : '' }}>Moderate</option>
                                                <option value="Low" {{ (old('risk_level', $floodData['risk_level']) == 'Low') ? 'selected' : '' }}>Low</option>
                                            </select>
                                            @error('risk_level')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="data_type" class="form-label">Data Type <span class="text-danger">*</span></label>
                                            <select class="form-select @error('data_type') is-invalid @enderror" id="data_type" name="data_type" required>
                                                <option value="">Select Data Type</option>
                                                <option value="prediction" {{ (old('data_type', $floodData['data_type']) == 'prediction') ? 'selected' : '' }}>Prediction</option>
                                                <option value="occurrence" {{ (old('data_type', $floodData['data_type']) == 'occurrence') ? 'selected' : '' }}>Occurrence</option>
                                                <option value="impact" {{ (old('data_type', $floodData['data_type']) == 'impact') ? 'selected' : '' }}>Impact Assessment</option>
                                            </select>
                                            @error('data_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="probability" class="form-label">Probability (%)</label>
                                    <input type="number" min="0" max="100" class="form-control @error('probability') is-invalid @enderror" id="probability" name="probability" value="{{ old('probability', $floodData['probability']) }}" placeholder="e.g., 75">
                                    @error('probability')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Impact Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="affected_area" class="form-label">Affected Area (sq km)</label>
                                            <input type="number" step="0.01" min="0" class="form-control @error('affected_area') is-invalid @enderror" id="affected_area" name="affected_area" value="{{ old('affected_area', $floodData['affected_area']) }}" placeholder="e.g., 120.5">
                                            @error('affected_area')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="population_at_risk" class="form-label">Population at Risk</label>
                                            <input type="number" min="0" class="form-control @error('population_at_risk') is-invalid @enderror" id="population_at_risk" name="population_at_risk" value="{{ old('population_at_risk', $floodData['population_at_risk']) }}" placeholder="e.g., 250000">
                                            @error('population_at_risk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="expected_rainfall" class="form-label">Expected Rainfall (mm)</label>
                                    <input type="number" step="0.1" min="0" class="form-control @error('expected_rainfall') is-invalid @enderror" id="expected_rainfall" name="expected_rainfall" value="{{ old('expected_rainfall', $floodData['expected_rainfall']) }}" placeholder="e.g., 350.5">
                                    @error('expected_rainfall')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Description</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required placeholder="Provide detailed description of the flood risk, conditions, and any relevant information...">{{ old('description', $floodData['description']) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.flood-data.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update Flood Data
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Auto-populate LGA based on state selection (if needed)
        document.getElementById('state').addEventListener('change', function() {
            // This could be enhanced to load LGAs dynamically
            console.log('State changed to:', this.value);
        });
    </script>
@endsection
