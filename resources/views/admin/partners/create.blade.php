@extends('layouts.admin')

@section('title', 'Add New Partner')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Partners</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Partner</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Partner</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Partner Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="partnership_type" class="form-label">Partnership Type</label>
                            <select class="form-select @error('partnership_type') is-invalid @enderror" id="partnership_type" name="partnership_type">
                                <option value="">Select Type</option>
                                <option value="Government" {{ old('partnership_type') == 'Government' ? 'selected' : '' }}>Government</option>
                                <option value="NGO" {{ old('partnership_type') == 'NGO' ? 'selected' : '' }}>NGO</option>
                                <option value="International" {{ old('partnership_type') == 'International' ? 'selected' : '' }}>International</option>
                                <option value="Private Sector" {{ old('partnership_type') == 'Private Sector' ? 'selected' : '' }}>Private Sector</option>
                                <option value="Academic" {{ old('partnership_type') == 'Academic' ? 'selected' : '' }}>Academic</option>
                            </select>
                            @error('partnership_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website_url" class="form-label">Website URL</label>
                            <input type="url" class="form-control @error('website_url') is-invalid @enderror" id="website_url" name="website_url" value="{{ old('website_url') }}" placeholder="https://example.com">
                            @error('website_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="display_order" class="form-label">Display Order</label>
                                <input type="number" class="form-control @error('display_order') is-invalid @enderror" id="display_order" name="display_order" value="{{ old('display_order', 0) }}" min="0">
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
                                <div class="form-text">Optional: Upload partner logo (JPEG, PNG, JPG, GIF, max 2MB)</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
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
                                    <i class="fas fa-save me-1"></i> Create Partner
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
                    <h6 class="mb-0">Guidelines</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Required Fields:</strong>
                        <ul class="list-unstyled mt-2">
                            <li><i class="fas fa-check text-success me-1"></i> Partner Name</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <strong>Optional Fields:</strong>
                        <ul class="list-unstyled mt-2">
                            <li><i class="fas fa-minus text-muted me-1"></i> Partnership Type</li>
                            <li><i class="fas fa-minus text-muted me-1"></i> Website URL</li>
                            <li><i class="fas fa-minus text-muted me-1"></i> Display Order</li>
                            <li><i class="fas fa-minus text-muted me-1"></i> Logo</li>
                            <li><i class="fas fa-minus text-muted me-1"></i> Description</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <strong>Logo Requirements:</strong>
                        <ul class="list-unstyled mt-2">
                            <li><i class="fas fa-info-circle text-info me-1"></i> Format: JPEG, PNG, JPG, GIF</li>
                            <li><i class="fas fa-info-circle text-info me-1"></i> Max Size: 2MB</li>
                            <li><i class="fas fa-info-circle text-info me-1"></i> Recommended: Square format</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-list me-1"></i> View All Partners
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection