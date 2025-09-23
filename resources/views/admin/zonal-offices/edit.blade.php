@extends('layouts.admin')

@section('title', 'Edit Zonal Office')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.zonal-offices.index') }}">Zonal Offices</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Office</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Zonal Office</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.zonal-offices.update', $zonalOffice->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Office Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $zonalOffice->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $zonalOffice->location) }}" required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address', $zonalOffice->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $zonalOffice->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $zonalOffice->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="states_covered" class="form-label">States Covered <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('states_covered') is-invalid @enderror" id="states_covered" name="states_covered" value="{{ old('states_covered', $zonalOffice->states_covered) }}" placeholder="e.g., Lagos, Ogun, Oyo" required>
                            @error('states_covered')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Enter states separated by commas</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude', $zonalOffice->latitude) }}">
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude', $zonalOffice->longitude) }}">
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $zonalOffice->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.zonal-offices.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back to List
                            </a>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Office
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">Office Information</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>ID:</strong> {{ $zonalOffice->id }}
                    </div>
                    <div class="mb-3">
                        <strong>Created:</strong><br>
                        <small>{{ $zonalOffice->created_at->format('M d, Y g:i A') }}</small>
                    </div>
                    <div class="mb-3">
                        <strong>Last Updated:</strong><br>
                        <small>{{ $zonalOffice->updated_at->format('M d, Y g:i A') }}</small>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.zonal-offices.index') }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="fas fa-list me-1"></i> View All Offices
                    </a>
                    <button type="button" class="btn btn-outline-info w-100 mb-2" data-bs-toggle="modal" data-bs-target="#viewModal{{ $zonalOffice->id }}">
                        <i class="fas fa-eye me-1"></i> View Details
                    </button>
                    <button type="button" class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $zonalOffice->id }}">
                        <i class="fas fa-trash me-1"></i> Delete Office
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal{{ $zonalOffice->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $zonalOffice->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel{{ $zonalOffice->id }}">{{ $zonalOffice->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Location</h6>
                            <p>{{ $zonalOffice->location }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Contact</h6>
                            <p>
                                @if($zonalOffice->phone)
                                    <div><i class="fas fa-phone me-1"></i> {{ $zonalOffice->phone }}</div>
                                @endif
                                @if($zonalOffice->email)
                                    <div><i class="fas fa-envelope me-1"></i> {{ $zonalOffice->email }}</div>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="fw-bold">Address</h6>
                            <p>{{ $zonalOffice->address }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="fw-bold">States Covered</h6>
                            <p><span class="badge bg-info">{{ $zonalOffice->states_covered }}</span></p>
                        </div>
                    </div>

                    @if($zonalOffice->description)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="fw-bold">Description</h6>
                                <p>{{ $zonalOffice->description }}</p>
                            </div>
                        </div>
                    @endif

                    @if($zonalOffice->latitude && $zonalOffice->longitude)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="fw-bold">Coordinates</h6>
                                <p>
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    Latitude: {{ $zonalOffice->latitude }},
                                    Longitude: {{ $zonalOffice->longitude }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $zonalOffice->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $zonalOffice->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $zonalOffice->id }}">Delete Zonal Office</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>{{ $zonalOffice->name }}</strong>?</p>
                    <p class="text-muted">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.zonal-offices.destroy', $zonalOffice->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Office</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection