@extends('layouts.admin')

@section('title', 'Edit Partner')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Partners</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Partner</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Partner</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Partner Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $partner->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="partnership_type" class="form-label">Partnership Type</label>
                            <select class="form-select @error('partnership_type') is-invalid @enderror" id="partnership_type" name="partnership_type">
                                <option value="">Select Type</option>
                                <option value="Government" {{ old('partnership_type', $partner->partnership_type) == 'Government' ? 'selected' : '' }}>Government</option>
                                <option value="NGO" {{ old('partnership_type', $partner->partnership_type) == 'NGO' ? 'selected' : '' }}>NGO</option>
                                <option value="International" {{ old('partnership_type', $partner->partnership_type) == 'International' ? 'selected' : '' }}>International</option>
                                <option value="Private Sector" {{ old('partnership_type', $partner->partnership_type) == 'Private Sector' ? 'selected' : '' }}>Private Sector</option>
                                <option value="Academic" {{ old('partnership_type', $partner->partnership_type) == 'Academic' ? 'selected' : '' }}>Academic</option>
                            </select>
                            @error('partnership_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website_url" class="form-label">Website URL</label>
                            <input type="url" class="form-control @error('website_url') is-invalid @enderror" id="website_url" name="website_url" value="{{ old('website_url', $partner->website_url) }}" placeholder="https://example.com">
                            @error('website_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="display_order" class="form-label">Display Order</label>
                                <input type="number" class="form-control @error('display_order') is-invalid @enderror" id="display_order" name="display_order" value="{{ old('display_order', $partner->display_order) }}" min="0">
                                @error('display_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Lower numbers appear first</div>
                            </div>
                            <div class="col-md-6">
                                <label for="logo" class="form-label">Logo</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($partner->logo)
                                    <div class="form-text">
                                        <small class="text-muted">Current logo: {{ $partner->logo }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $partner->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back to List
                            </a>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Partner
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
                    <h6 class="mb-0">Partner Information</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>ID:</strong> {{ $partner->id }}
                    </div>
                    <div class="mb-3">
                        <strong>Created:</strong><br>
                        <small>{{ $partner->created_at->format('M d, Y g:i A') }}</small>
                    </div>
                    <div class="mb-3">
                        <strong>Last Updated:</strong><br>
                        <small>{{ $partner->updated_at->format('M d, Y g:i A') }}</small>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="fas fa-list me-1"></i> View All Partners
                    </a>
                    <button type="button" class="btn btn-outline-info w-100 mb-2" data-bs-toggle="modal" data-bs-target="#viewModal{{ $partner->id }}">
                        <i class="fas fa-eye me-1"></i> View Details
                    </button>
                    <button type="button" class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $partner->id }}">
                        <i class="fas fa-trash me-1"></i> Delete Partner
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal{{ $partner->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $partner->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel{{ $partner->id }}">
                        @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="rounded me-2" width="30" height="30">
                        @endif
                        {{ $partner->name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Partnership Type</h6>
                            <p>
                                @if($partner->partnership_type)
                                    <span class="badge bg-info">{{ $partner->partnership_type }}</span>
                                @else
                                    <span class="text-muted">Not specified</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Display Order</h6>
                            <p><span class="badge bg-secondary">{{ $partner->display_order }}</span></p>
                        </div>
                    </div>

                    @if($partner->website_url)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="fw-bold">Website</h6>
                                <p>
                                    <a href="{{ $partner->website_url }}" target="_blank" class="text-decoration-none">
                                        <i class="fas fa-external-link-alt me-1"></i>
                                        {{ $partner->website_url }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    @endif

                    @if($partner->description)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="fw-bold">Description</h6>
                                <p>{{ $partner->description }}</p>
                            </div>
                        </div>
                    @endif

                    @if($partner->logo)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="fw-bold">Logo</h6>
                                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="img-fluid rounded">
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
    <div class="modal fade" id="deleteModal{{ $partner->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $partner->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $partner->id }}">Delete Partner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>{{ $partner->name }}</strong>?</p>
                    <p class="text-muted">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Partner</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection