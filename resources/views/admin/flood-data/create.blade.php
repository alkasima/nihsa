@extends('layouts.admin')

@section('title', 'Add Flood Data')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.flood-data.index') }}">Flood Data Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Flood Data</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Flood Data</h1>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.flood-data.store') }}" method="POST">
                @csrf
                
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
                                        <option value="Abia" {{ old('state') == 'Abia' ? 'selected' : '' }}>Abia</option>
                                        <option value="Adamawa" {{ old('state') == 'Adamawa' ? 'selected' : '' }}>Adamawa</option>
                                        <option value="Akwa Ibom" {{ old('state') == 'Akwa Ibom' ? 'selected' : '' }}>Akwa Ibom</option>
                                        <option value="Anambra" {{ old('state') == 'Anambra' ? 'selected' : '' }}>Anambra</option>
                                        <option value="Bauchi" {{ old('state') == 'Bauchi' ? 'selected' : '' }}>Bauchi</option>
                                        <option value="Bayelsa" {{ old('state') == 'Bayelsa' ? 'selected' : '' }}>Bayelsa</option>
                                        <option value="Benue" {{ old('state') == 'Benue' ? 'selected' : '' }}>Benue</option>
                                        <option value="Borno" {{ old('state') == 'Borno' ? 'selected' : '' }}>Borno</option>
                                        <option value="Cross River" {{ old('state') == 'Cross River' ? 'selected' : '' }}>Cross River</option>
                                        <option value="Delta" {{ old('state') == 'Delta' ? 'selected' : '' }}>Delta</option>
                                        <option value="Ebonyi" {{ old('state') == 'Ebonyi' ? 'selected' : '' }}>Ebonyi</option>
                                        <option value="Edo" {{ old('state') == 'Edo' ? 'selected' : '' }}>Edo</option>
                                        <option value="Ekiti" {{ old('state') == 'Ekiti' ? 'selected' : '' }}>Ekiti</option>
                                        <option value="Enugu" {{ old('state') == 'Enugu' ? 'selected' : '' }}>Enugu</option>
                                        <option value="FCT" {{ old('state') == 'FCT' ? 'selected' : '' }}>Federal Capital Territory</option>
                                        <option value="Gombe" {{ old('state') == 'Gombe' ? 'selected' : '' }}>Gombe</option>
                                        <option value="Imo" {{ old('state') == 'Imo' ? 'selected' : '' }}>Imo</option>
                                        <option value="Jigawa" {{ old('state') == 'Jigawa' ? 'selected' : '' }}>Jigawa</option>
                                        <option value="Kaduna" {{ old('state') == 'Kaduna' ? 'selected' : '' }}>Kaduna</option>
                                        <option value="Kano" {{ old('state') == 'Kano' ? 'selected' : '' }}>Kano</option>
                                        <option value="Katsina" {{ old('state') == 'Katsina' ? 'selected' : '' }}>Katsina</option>
                                        <option value="Kebbi" {{ old('state') == 'Kebbi' ? 'selected' : '' }}>Kebbi</option>
                                        <option value="Kogi" {{ old('state') == 'Kogi' ? 'selected' : '' }}>Kogi</option>
                                        <option value="Kwara" {{ old('state') == 'Kwara' ? 'selected' : '' }}>Kwara</option>
                                        <option value="Lagos" {{ old('state') == 'Lagos' ? 'selected' : '' }}>Lagos</option>
                                        <option value="Nasarawa" {{ old('state') == 'Nasarawa' ? 'selected' : '' }}>Nasarawa</option>
                                        <option value="Niger" {{ old('state') == 'Niger' ? 'selected' : '' }}>Niger</option>
                                        <option value="Ogun" {{ old('state') == 'Ogun' ? 'selected' : '' }}>Ogun</option>
                                        <option value="Ondo" {{ old('state') == 'Ondo' ? 'selected' : '' }}>Ondo</option>
                                        <option value="Osun" {{ old('state') == 'Osun' ? 'selected' : '' }}>Osun</option>
                                        <option value="Oyo" {{ old('state') == 'Oyo' ? 'selected' : '' }}>Oyo</option>
                                        <option value="Plateau" {{ old('state') == 'Plateau' ? 'selected' : '' }}>Plateau</option>
                                        <option value="Rivers" {{ old('state') == 'Rivers' ? 'selected' : '' }}>Rivers</option>
                                        <option value="Sokoto" {{ old('state') == 'Sokoto' ? 'selected' : '' }}>Sokoto</option>
                                        <option value="Taraba" {{ old('state') == 'Taraba' ? 'selected' : '' }}>Taraba</option>
                                        <option value="Yobe" {{ old('state') == 'Yobe' ? 'selected' : '' }}>Yobe</option>
                                        <option value="Zamfara" {{ old('state') == 'Zamfara' ? 'selected' : '' }}>Zamfara</option>
                                    </select>
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="lga" class="form-label">LGA <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('lga') is-invalid @enderror" id="lga" name="lga" value="{{ old('lga') }}" required>
                                    @error('lga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude') }}" placeholder="e.g. 9.0820">
                                    @error('latitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude') }}" placeholder="e.g. 8.6753">
                                    @error('longitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Time Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                                    <select class="form-select @error('year') is-invalid @enderror" id="year" name="year" required>
                                        <option value="">Select Year</option>
                                        <option value="2025" {{ old('year') == '2025' ? 'selected' : '' }}>2025</option>
                                        <option value="2024" {{ old('year') == '2024' ? 'selected' : '' }}>2024</option>
                                        <option value="2023" {{ old('year') == '2023' ? 'selected' : '' }}>2023</option>
                                        <option value="2022" {{ old('year') == '2022' ? 'selected' : '' }}>2022</option>
                                        <option value="2021" {{ old('year') == '2021' ? 'selected' : '' }}>2021</option>
                                    </select>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="period" class="form-label">Period <span class="text-danger">*</span></label>
                                    <select class="form-select @error('period') is-invalid @enderror" id="period" name="period" required>
                                        <option value="">Select Period</option>
                                        <option value="January-March" {{ old('period') == 'January-March' ? 'selected' : '' }}>January-March</option>
                                        <option value="April-June" {{ old('period') == 'April-June' ? 'selected' : '' }}>April-June</option>
                                        <option value="July-September" {{ old('period') == 'July-September' ? 'selected' : '' }}>July-September</option>
                                        <option value="October-December" {{ old('period') == 'October-December' ? 'selected' : '' }}>October-December</option>
                                        <option value="January-June" {{ old('period') == 'January-June' ? 'selected' : '' }}>January-June</option>
                                        <option value="July-December" {{ old('period') == 'July-December' ? 'selected' : '' }}>July-December</option>
                                        <option value="Annual" {{ old('period') == 'Annual' ? 'selected' : '' }}>Annual</option>
                                    </select>
                                    @error('period')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Flood Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="data_type" class="form-label">Data Type <span class="text-danger">*</span></label>
                                    <select class="form-select @error('data_type') is-invalid @enderror" id="data_type" name="data_type" required>
                                        <option value="">Select Data Type</option>
                                        <option value="prediction" {{ old('data_type') == 'prediction' ? 'selected' : '' }}>Prediction</option>
                                        <option value="occurrence" {{ old('data_type') == 'occurrence' ? 'selected' : '' }}>Occurrence</option>
                                        <option value="impact" {{ old('data_type') == 'impact' ? 'selected' : '' }}>Impact</option>
                                    </select>
                                    @error('data_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="risk_level" class="form-label">Risk Level <span class="text-danger">*</span></label>
                                    <select class="form-select @error('risk_level') is-invalid @enderror" id="risk_level" name="risk_level" required>
                                        <option value="">Select Risk Level</option>
                                        <option value="High" {{ old('risk_level') == 'High' ? 'selected' : '' }}>High</option>
                                        <option value="Moderate" {{ old('risk_level') == 'Moderate' ? 'selected' : '' }}>Moderate</option>
                                        <option value="Low" {{ old('risk_level') == 'Low' ? 'selected' : '' }}>Low</option>
                                    </select>
                                    @error('risk_level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Prediction Fields -->
                                <div id="prediction-fields" class="data-type-fields">
                                    <div class="mb-3">
                                        <label for="probability" class="form-label">Probability</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control @error('probability') is-invalid @enderror" id="probability" name="probability" value="{{ old('probability') }}" min="0" max="100">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @error('probability')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="affected_area" class="form-label">Affected Area</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control @error('affected_area') is-invalid @enderror" id="affected_area" name="affected_area" value="{{ old('affected_area') }}" min="0">
                                            <span class="input-group-text">sq km</span>
                                        </div>
                                        @error('affected_area')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="population_at_risk" class="form-label">Population at Risk</label>
                                        <input type="number" class="form-control @error('population_at_risk') is-invalid @enderror" id="population_at_risk" name="population_at_risk" value="{{ old('population_at_risk') }}" min="0">
                                        @error('population_at_risk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="expected_rainfall" class="form-label">Expected Rainfall</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control @error('expected_rainfall') is-invalid @enderror" id="expected_rainfall" name="expected_rainfall" value="{{ old('expected_rainfall') }}" min="0">
                                            <span class="input-group-text">mm</span>
                                        </div>
                                        @error('expected_rainfall')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Occurrence Fields -->
                                <div id="occurrence-fields" class="data-type-fields d-none">
                                    <div class="mb-3">
                                        <label for="affected_area_occurrence" class="form-label">Affected Area</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control @error('affected_area_occurrence') is-invalid @enderror" id="affected_area_occurrence" name="affected_area_occurrence" value="{{ old('affected_area_occurrence') }}" min="0">
                                            <span class="input-group-text">sq km</span>
                                        </div>
                                        @error('affected_area_occurrence')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="affected_population" class="form-label">Affected Population</label>
                                        <input type="number" class="form-control @error('affected_population') is-invalid @enderror" id="affected_population" name="affected_population" value="{{ old('affected_population') }}" min="0">
                                        @error('affected_population')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="rainfall_recorded" class="form-label">Rainfall Recorded</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control @error('rainfall_recorded') is-invalid @enderror" id="rainfall_recorded" name="rainfall_recorded" value="{{ old('rainfall_recorded') }}" min="0">
                                            <span class="input-group-text">mm</span>
                                        </div>
                                        @error('rainfall_recorded')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="damage_estimate" class="form-label">Damage Estimate</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control @error('damage_estimate') is-invalid @enderror" id="damage_estimate" name="damage_estimate" value="{{ old('damage_estimate') }}" min="0">
                                            <select class="form-select" id="damage_estimate_unit" name="damage_estimate_unit">
                                                <option value="thousand" {{ old('damage_estimate_unit') == 'thousand' ? 'selected' : '' }}>Thousand</option>
                                                <option value="million" {{ old('damage_estimate_unit') == 'million' ? 'selected' : '' }}>Million</option>
                                                <option value="billion" {{ old('damage_estimate_unit') == 'billion' ? 'selected' : '' }}>Billion</option>
                                            </select>
                                        </div>
                                        @error('damage_estimate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Impact Fields -->
                                <div id="impact-fields" class="data-type-fields d-none">
                                    <div class="mb-3">
                                        <label for="affected_area_impact" class="form-label">Affected Area</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control @error('affected_area_impact') is-invalid @enderror" id="affected_area_impact" name="affected_area_impact" value="{{ old('affected_area_impact') }}" min="0">
                                            <span class="input-group-text">sq km</span>
                                        </div>
                                        @error('affected_area_impact')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="affected_population_impact" class="form-label">Affected Population</label>
                                        <input type="number" class="form-control @error('affected_population_impact') is-invalid @enderror" id="affected_population_impact" name="affected_population_impact" value="{{ old('affected_population_impact') }}" min="0">
                                        @error('affected_population_impact')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="displaced_persons" class="form-label">Displaced Persons</label>
                                        <input type="number" class="form-control @error('displaced_persons') is-invalid @enderror" id="displaced_persons" name="displaced_persons" value="{{ old('displaced_persons') }}" min="0">
                                        @error('displaced_persons')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="casualties" class="form-label">Casualties</label>
                                        <input type="number" class="form-control @error('casualties') is-invalid @enderror" id="casualties" name="casualties" value="{{ old('casualties') }}" min="0">
                                        @error('casualties')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="infrastructure_damage" class="form-label">Infrastructure Damage</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control @error('infrastructure_damage') is-invalid @enderror" id="infrastructure_damage" name="infrastructure_damage" value="{{ old('infrastructure_damage') }}" min="0">
                                            <select class="form-select" id="infrastructure_damage_unit" name="infrastructure_damage_unit">
                                                <option value="thousand" {{ old('infrastructure_damage_unit') == 'thousand' ? 'selected' : '' }}>Thousand</option>
                                                <option value="million" {{ old('infrastructure_damage_unit') == 'million' ? 'selected' : '' }}>Million</option>
                                                <option value="billion" {{ old('infrastructure_damage_unit') == 'billion' ? 'selected' : '' }}>Billion</option>
                                            </select>
                                        </div>
                                        @error('infrastructure_damage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="agricultural_damage" class="form-label">Agricultural Damage</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control @error('agricultural_damage') is-invalid @enderror" id="agricultural_damage" name="agricultural_damage" value="{{ old('agricultural_damage') }}" min="0">
                                            <select class="form-select" id="agricultural_damage_unit" name="agricultural_damage_unit">
                                                <option value="thousand" {{ old('agricultural_damage_unit') == 'thousand' ? 'selected' : '' }}>Thousand</option>
                                                <option value="million" {{ old('agricultural_damage_unit') == 'million' ? 'selected' : '' }}>Million</option>
                                                <option value="billion" {{ old('agricultural_damage_unit') == 'billion' ? 'selected' : '' }}>Billion</option>
                                            </select>
                                        </div>
                                        @error('agricultural_damage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Additional Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.flood-data.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Flood Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dataTypeSelect = document.getElementById('data_type');
            const predictionFields = document.getElementById('prediction-fields');
            const occurrenceFields = document.getElementById('occurrence-fields');
            const impactFields = document.getElementById('impact-fields');
            
            // Function to toggle fields based on data type
            function toggleFields() {
                const dataType = dataTypeSelect.value;
                
                // Hide all fields first
                predictionFields.classList.add('d-none');
                occurrenceFields.classList.add('d-none');
                impactFields.classList.add('d-none');
                
                // Show fields based on selected data type
                if (dataType === 'prediction') {
                    predictionFields.classList.remove('d-none');
                } else if (dataType === 'occurrence') {
                    occurrenceFields.classList.remove('d-none');
                } else if (dataType === 'impact') {
                    impactFields.classList.remove('d-none');
                }
            }
            
            // Initial toggle
            toggleFields();
            
            // Listen for changes
            dataTypeSelect.addEventListener('change', toggleFields);
        });
    </script>
@endsection
