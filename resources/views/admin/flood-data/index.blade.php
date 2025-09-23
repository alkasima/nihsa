@extends('layouts.admin')

@section('title', 'Flood Data Management')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Flood Data Management</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Flood Data Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.flood-data.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> Add Flood Data
                </a>
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fas fa-file-import me-1"></i> Import Data
                </button>
            </div>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-download me-1"></i> Export
                </button>
                <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                    <li><a class="dropdown-item" href="#">Export as CSV</a></li>
                    <li><a class="dropdown-item" href="#">Export as Excel</a></li>
                    <li><a class="dropdown-item" href="#">Export as PDF</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Flood Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="import_file" class="form-label">Select File</label>
                            <input type="file" class="form-control" id="import_file" name="import_file" accept=".csv, .xlsx" required>
                            <div class="form-text">Accepted formats: CSV, Excel</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <select class="form-select" id="year" name="year" required>
                                <option value="">Select Year</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="data_type" class="form-label">Data Type</label>
                            <select class="form-select" id="data_type" name="data_type" required>
                                <option value="">Select Data Type</option>
                                <option value="flood_prediction">Flood Prediction</option>
                                <option value="flood_occurrence">Flood Occurrence</option>
                                <option value="flood_impact">Flood Impact</option>
                            </select>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="has_header" name="has_header" value="1" checked>
                            <label class="form-check-label" for="has_header">
                                File has header row
                            </label>
                        </div>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Please ensure your file follows the required format. <a href="#">Download template</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.flood-data.index') }}" method="GET" class="row g-3">
                <div class="col-md-2">
                    <label for="year" class="form-label">Year</label>
                    <select class="form-select" id="year" name="year">
                        <option value="">All Years</option>
                        <option value="2025" {{ request('year') == '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2024" {{ request('year') == '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2023" {{ request('year') == '2023' ? 'selected' : '' }}>2023</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="state" class="form-label">State</label>
                    <select class="form-select" id="state" name="state">
                        <option value="">All States</option>
                        <option value="Lagos" {{ request('state') == 'Lagos' ? 'selected' : '' }}>Lagos</option>
                        <option value="Kano" {{ request('state') == 'Kano' ? 'selected' : '' }}>Kano</option>
                        <option value="Rivers" {{ request('state') == 'Rivers' ? 'selected' : '' }}>Rivers</option>
                        <option value="Bayelsa" {{ request('state') == 'Bayelsa' ? 'selected' : '' }}>Bayelsa</option>
                        <option value="Kogi" {{ request('state') == 'Kogi' ? 'selected' : '' }}>Kogi</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="risk_level" class="form-label">Risk Level</label>
                    <select class="form-select" id="risk_level" name="risk_level">
                        <option value="">All Risk Levels</option>
                        <option value="High" {{ request('risk_level') == 'High' ? 'selected' : '' }}>High</option>
                        <option value="Moderate" {{ request('risk_level') == 'Moderate' ? 'selected' : '' }}>Moderate</option>
                        <option value="Low" {{ request('risk_level') == 'Low' ? 'selected' : '' }}>Low</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="data_type" class="form-label">Data Type</label>
                    <select class="form-select" id="data_type" name="data_type">
                        <option value="">All Types</option>
                        <option value="prediction" {{ request('data_type') == 'prediction' ? 'selected' : '' }}>Prediction</option>
                        <option value="occurrence" {{ request('data_type') == 'occurrence' ? 'selected' : '' }}>Occurrence</option>
                        <option value="impact" {{ request('data_type') == 'impact' ? 'selected' : '' }}>Impact</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Flood Data List -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-admin">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>State</th>
                            <th>LGA</th>
                            <th>Year</th>
                            <th>Period</th>
                            <th>Risk Level</th>
                            <th>Data Type</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- In a real implementation, this would be populated from the database -->
                        @php
                            $dummyFloodData = [
                                [
                                    'id' => 1,
                                    'state' => 'Lagos',
                                    'lga' => 'Ikorodu',
                                    'year' => 2025,
                                    'period' => 'July-September',
                                    'risk_level' => 'High',
                                    'data_type' => 'prediction',
                                    'details' => [
                                        'probability' => '80%',
                                        'affected_area' => '120 sq km',
                                        'population_at_risk' => '250,000',
                                        'expected_rainfall' => '350mm'
                                    ]
                                ],
                                [
                                    'id' => 2,
                                    'state' => 'Rivers',
                                    'lga' => 'Port Harcourt',
                                    'year' => 2025,
                                    'period' => 'August-October',
                                    'risk_level' => 'High',
                                    'data_type' => 'prediction',
                                    'details' => [
                                        'probability' => '85%',
                                        'affected_area' => '150 sq km',
                                        'population_at_risk' => '300,000',
                                        'expected_rainfall' => '400mm'
                                    ]
                                ],
                                [
                                    'id' => 3,
                                    'state' => 'Kogi',
                                    'lga' => 'Lokoja',
                                    'year' => 2025,
                                    'period' => 'July-October',
                                    'risk_level' => 'High',
                                    'data_type' => 'prediction',
                                    'details' => [
                                        'probability' => '90%',
                                        'affected_area' => '200 sq km',
                                        'population_at_risk' => '180,000',
                                        'expected_rainfall' => '380mm'
                                    ]
                                ],
                                [
                                    'id' => 4,
                                    'state' => 'Bayelsa',
                                    'lga' => 'Yenagoa',
                                    'year' => 2025,
                                    'period' => 'August-October',
                                    'risk_level' => 'High',
                                    'data_type' => 'prediction',
                                    'details' => [
                                        'probability' => '85%',
                                        'affected_area' => '180 sq km',
                                        'population_at_risk' => '150,000',
                                        'expected_rainfall' => '420mm'
                                    ]
                                ],
                                [
                                    'id' => 5,
                                    'state' => 'Kano',
                                    'lga' => 'Kano Municipal',
                                    'year' => 2025,
                                    'period' => 'July-August',
                                    'risk_level' => 'Moderate',
                                    'data_type' => 'prediction',
                                    'details' => [
                                        'probability' => '60%',
                                        'affected_area' => '80 sq km',
                                        'population_at_risk' => '120,000',
                                        'expected_rainfall' => '250mm'
                                    ]
                                ],
                                [
                                    'id' => 6,
                                    'state' => 'Lagos',
                                    'lga' => 'Ikorodu',
                                    'year' => 2024,
                                    'period' => 'July-September',
                                    'risk_level' => 'High',
                                    'data_type' => 'occurrence',
                                    'details' => [
                                        'affected_area' => '110 sq km',
                                        'affected_population' => '220,000',
                                        'rainfall_recorded' => '330mm',
                                        'damage_estimate' => '$15 million'
                                    ]
                                ],
                                [
                                    'id' => 7,
                                    'state' => 'Rivers',
                                    'lga' => 'Port Harcourt',
                                    'year' => 2024,
                                    'period' => 'August-October',
                                    'risk_level' => 'High',
                                    'data_type' => 'occurrence',
                                    'details' => [
                                        'affected_area' => '140 sq km',
                                        'affected_population' => '280,000',
                                        'rainfall_recorded' => '390mm',
                                        'damage_estimate' => '$20 million'
                                    ]
                                ],
                                [
                                    'id' => 8,
                                    'state' => 'Kogi',
                                    'lga' => 'Lokoja',
                                    'year' => 2024,
                                    'period' => 'July-October',
                                    'risk_level' => 'High',
                                    'data_type' => 'impact',
                                    'details' => [
                                        'affected_area' => '190 sq km',
                                        'affected_population' => '170,000',
                                        'displaced_persons' => '50,000',
                                        'casualties' => '15',
                                        'infrastructure_damage' => '$25 million',
                                        'agricultural_damage' => '$10 million'
                                    ]
                                ]
                            ];
                        @endphp
                        
                        @foreach($dummyFloodData as $data)
                            <tr>
                                <td>{{ $data['id'] }}</td>
                                <td>{{ $data['state'] }}</td>
                                <td>{{ $data['lga'] }}</td>
                                <td>{{ $data['year'] }}</td>
                                <td>{{ $data['period'] }}</td>
                                <td>
                                    @if($data['risk_level'] == 'High')
                                        <span class="badge bg-danger">High</span>
                                    @elseif($data['risk_level'] == 'Moderate')
                                        <span class="badge bg-warning">Moderate</span>
                                    @elseif($data['risk_level'] == 'Low')
                                        <span class="badge bg-success">Low</span>
                                    @endif
                                </td>
                                <td>
                                    @if($data['data_type'] == 'prediction')
                                        <span class="badge bg-primary">Prediction</span>
                                    @elseif($data['data_type'] == 'occurrence')
                                        <span class="badge bg-info">Occurrence</span>
                                    @elseif($data['data_type'] == 'impact')
                                        <span class="badge bg-secondary">Impact</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary" title="View" data-bs-toggle="modal" data-bs-target="#viewModal{{ $data['id'] }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.flood-data.edit', $data['id']) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data['id'] }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- View Modal -->
                                    <div class="modal fade" id="viewModal{{ $data['id'] }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $data['id'] }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewModalLabel{{ $data['id'] }}">Flood Data Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">State</h6>
                                                            <p>{{ $data['state'] }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">LGA</h6>
                                                            <p>{{ $data['lga'] }}</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <h6 class="fw-bold">Year</h6>
                                                            <p>{{ $data['year'] }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h6 class="fw-bold">Period</h6>
                                                            <p>{{ $data['period'] }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h6 class="fw-bold">Risk Level</h6>
                                                            <p>
                                                                @if($data['risk_level'] == 'High')
                                                                    <span class="badge bg-danger">High</span>
                                                                @elseif($data['risk_level'] == 'Moderate')
                                                                    <span class="badge bg-warning">Moderate</span>
                                                                @elseif($data['risk_level'] == 'Low')
                                                                    <span class="badge bg-success">Low</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
                                                    <h6 class="fw-bold">Details</h6>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            @foreach($data['details'] as $key => $value)
                                                                <tr>
                                                                    <th>{{ ucwords(str_replace('_', ' ', $key)) }}</th>
                                                                    <td>{{ $value }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $data['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $data['id'] }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $data['id'] }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete the flood data for {{ $data['state'] }}, {{ $data['lga'] }} ({{ $data['year'] }})? This action cannot be undone.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.flood-data.destroy', $data['id']) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
