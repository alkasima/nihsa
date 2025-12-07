@extends('layouts.app')

@section('title', $procurement->title . ' - Nigeria Hydrological Services Agency')

@section('breadcrumbs')
    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="{{ route('Procurements.index') }}" itemprop="item">
            <span itemprop="name">Procurements</span>
        </a>
        <meta itemprop="position" content="2" />
    </li>
    <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">{{ Str::limit($procurement->title, 30) }}</span>
        <meta itemprop="position" content="3" />
    </li>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">{{ $procurement->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- procurement Details Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <i class="far fa-file-pdf fa-5x text-danger"></i>
                            </div>

                            <div class="mb-4">
                                <h2 class="mb-3">{{ $procurement->title }}</h2>
                                <div class="d-flex flex-wrap gap-3 mb-3">
                                    <span class="badge bg-primary">{{ $procurement->type }}</span>
                                    <span class="badge bg-secondary">{{ $procurement->year }}</span>
                                    <span class="badge bg-info">Published: {{ $procurement->procurement_date->format('F j, Y') }}</span>
                                    @if($procurement->is_featured)
                                        <span class="badge bg-warning">Featured</span>
                                    @endif
                                </div>
                                <p class="lead">{{ $procurement->description ?? 'No description available.' }}</p>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('Procurements.download', $procurement->id) }}" class="btn cta-btn cta-btn-primary">
                                    <i class="fas fa-download me-2"></i> Download procurement
                                </a>
                                <a href="{{ route('Procurements.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Back to Procurements
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- procurement Preview (Placeholder) -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Document Preview</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="ratio ratio-16x9">
                                <div class="d-flex align-items-center justify-content-center bg-light p-5">
                                    <div class="text-center">
                                        <i class="far fa-file-pdf fa-5x text-danger mb-3"></i>
                                        <h4>Preview not available</h4>
                                        <p>Please download the document to view its contents.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Related Procurements Section -->
    @if($relatedProcurements->count() > 0)
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="mb-4">Related Procurements</h2>
                    <div class="row g-4">
                        @foreach($relatedProcurements as $related)
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ Str::limit($related->title, 50) }}</h5>
                                    <p class="card-text small text-muted">{{ $related->procurement_date->format('F j, Y') }}</p>
                                    <p class="card-text">{{ Str::limit($related->description ?? 'No description available', 100) }}</p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="{{ route('Procurements.show', $related) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
