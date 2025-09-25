@extends('layouts.app')

@section('title', 'Publications - Nigeria Hydrological Services Agency')

@section('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #0056b3 0%, #004494 100%);
        --secondary-gradient: linear-gradient(135deg, #28a745 0%, #218838 100%);
        --accent-gradient: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        --warning-gradient: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        --danger-gradient: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.1);
        --shadow-medium: 0 5px 20px rgba(0, 0, 0, 0.15);
        --shadow-heavy: 0 10px 40px rgba(0, 0, 0, 0.2);
        --border-radius: 20px;
        --border-radius-sm: 15px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .publications-hero {
        background: var(--primary-gradient);
        color: white;
        position: relative;
        overflow: hidden;
        min-height: 500px;
        display: flex;
        align-items: center;
    }

    .publications-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
        opacity: 0.5;
    }

    .publications-hero::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .publications-hero .hero-content {
        position: relative;
        z-index: 2;
    }

    .stats-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--border-radius);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .stats-card:hover::before {
        left: 100%;
    }

    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-heavy);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .stats-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
    }

    .stats-primary .stats-icon { background: rgba(40, 167, 69, 0.2); color: #28a745; }
    .stats-success .stats-icon { background: rgba(23, 162, 184, 0.2); color: #17a2b8; }
    .stats-info .stats-icon { background: rgba(255, 193, 7, 0.2); color: #ffc107; }

    .filter-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
    }

    .filter-card .card-header {
        background: linear-gradient(135deg, var(--primary-color), #004494);
        color: white;
        border: none;
        padding: 1.5rem;
    }

    .filter-card .card-body {
        padding: 1.5rem;
    }

    .publication-card {
        background: white;
        border-radius: var(--border-radius-sm);
        box-shadow: var(--shadow-light);
        border: none;
        transition: var(--transition);
        overflow: hidden;
        height: 100%;
        position: relative;
        transform: translateZ(0);
    }

    .publication-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: var(--transition);
    }

    .publication-card:hover::before {
        transform: scaleX(1);
    }

    .publication-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: var(--shadow-heavy);
    }

    .publication-icon {
        width: 90px;
        height: 90px;
        background: var(--danger-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2.2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
        transition: var(--transition);
    }

    .publication-icon::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transform: rotate(45deg);
        transition: all 0.8s;
        opacity: 0;
    }

    .publication-card:hover .publication-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 12px 35px rgba(220, 53, 69, 0.4);
    }

    .publication-card:hover .publication-icon::before {
        animation: shine 0.8s ease-out;
        opacity: 1;
    }

    @keyframes shine {
        0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }

    .publication-card .card-body {
        padding: 2rem;
        text-align: center;
    }

    .publication-card .card-title {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .featured-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(135deg, #ffc107, #e0a800);
        color: #212529;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 10;
    }

    .publication-meta {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 0 0 15px 15px;
        border-top: 1px solid #dee2e6;
    }

    .publication-type-badge {
        background: linear-gradient(135deg, var(--primary-color), #004494);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .section-title {
        color: var(--primary-color);
        font-weight: 700;
        position: relative;
        margin-bottom: 2rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, var(--primary-color), #004494);
        border-radius: 2px;
    }

    .search-container {
        position: relative;
        z-index: 1;
    }

    .search-box {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.1rem;
        z-index: 3;
        transition: var(--transition);
    }

    .search-input {
        padding-left: 55px;
        padding-right: 25px;
        border-radius: 30px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: white;
        transition: var(--transition);
        position: relative;
        z-index: 2;
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .search-input:focus {
        border-color: rgba(255, 255, 255, 0.5);
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        outline: none;
    }

    .search-input:focus + .search-glow,
    .search-input:focus ~ .search-glow {
        opacity: 1;
        transform: scale(1.1);
    }

    .search-glow {
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.1));
        border-radius: 32px;
        opacity: 0;
        transition: var(--transition);
        z-index: 1;
    }

    .filter-select {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .filter-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(0, 86, 179, 0.25);
    }

    .btn-filter {
        background: linear-gradient(135deg, var(--primary-color), #004494);
        border: none;
        border-radius: 25px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 86, 179, 0.3);
    }

    .publication-list-item {
        background: white;
        border: none;
        border-radius: var(--border-radius-sm);
        margin-bottom: 1.5rem;
        transition: var(--transition);
        overflow: hidden;
        position: relative;
        border-left: 4px solid transparent;
    }

    .publication-list-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--primary-gradient);
        transform: scaleY(0);
        transition: var(--transition);
    }

    .publication-list-item:hover {
        transform: translateX(15px);
        box-shadow: var(--shadow-medium);
        border-left-color: #0056b3;
    }

    .publication-list-item:hover::before {
        transform: scaleY(1);
    }

    .publication-list-content {
        padding: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .publication-list-info h5 {
        color: var(--primary-color);
        margin-bottom: 0.75rem;
        font-weight: 700;
        font-size: 1.25rem;
        line-height: 1.3;
    }

    .publication-list-meta {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .publication-list-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .btn-view {
        background: var(--primary-gradient);
        border: none;
        border-radius: 15px;
        padding: 0.4rem 0.8rem;
        font-size: 0.75rem;
        font-weight: 600;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 0.2px;
        min-width: 60px;
        height: 32px;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-view::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-view:hover::before {
        left: 100%;
    }

    .btn-view:hover {
        transform: translateY(-1px) scale(1.01);
        box-shadow: 0 3px 10px rgba(0, 86, 179, 0.25);
    }

    .btn-download {
        background: var(--secondary-gradient);
        border: none;
        border-radius: 15px;
        padding: 0.4rem 0.8rem;
        font-size: 0.75rem;
        font-weight: 600;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 0.2px;
        min-width: 60px;
        height: 32px;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-download::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-download:hover::before {
        left: 100%;
    }

    .btn-download:hover {
        transform: translateY(-1px) scale(1.01);
        box-shadow: 0 3px 10px rgba(40, 167, 69, 0.25);
    }

    .empty-state {
        text-align: center;
        padding: 5rem 3rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-light);
        position: relative;
        overflow: hidden;
    }

    .empty-state::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(0, 86, 179, 0.05) 0%, transparent 70%);
        animation: pulse 4s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.5; }
        50% { transform: scale(1.1) rotate(180deg); opacity: 0.8; }
    }

    .empty-state i {
        font-size: 5rem;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 2rem;
        animation: float 3s ease-in-out infinite;
    }

    .empty-state h4 {
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        font-weight: 700;
        font-size: 1.75rem;
    }

    .empty-state p {
        color: #6c757d;
        font-size: 1.1rem;
        line-height: 1.6;
        max-width: 500px;
        margin: 0 auto 2rem;
    }

    .help-card {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
        border-radius: 15px;
        border: none;
        text-align: center;
    }

    .help-card .card-body {
        padding: 2rem;
    }

    .help-card i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.8;
    }

    .help-card .btn {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        min-width: fit-content;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        border-radius: 20px;
    }

    .help-card .btn span {
        display: inline-block;
    }

    .help-card .btn i {
        font-size: 0.85rem;
    }

    @media (max-width: 768px) {
        .publications-hero {
            padding: 3rem 0;
        }

        .publication-list-content {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .publication-list-actions {
            width: 100%;
            justify-content: center;
        }

        .btn-view, .btn-download {
            padding: 0.3rem 0.6rem;
            font-size: 0.7rem;
            min-width: 50px;
            height: 28px;
        }
    }
</style>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <section class="py-3 bg-light border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Publications</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="publications-hero py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h1 class="display-4 fw-bold mb-4">Publications</h1>
                        <p class="lead mb-4">Access our comprehensive collection of hydrological reports, research papers, bulletins, and technical publications</p>

                        <!-- Enhanced Quick Stats -->
                        <div class="row g-4 mt-5">
                            <div class="col-md-4">
                                <div class="stats-card card text-center p-4 stats-primary">
                                    <div class="card-body">
                                        <div class="stats-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <h2 class="text-white mb-2">{{ number_format($publications->total()) }}</h2>
                                        <p class="mb-0 text-white-50">Total Publications</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-card card text-center p-4 stats-success">
                                    <div class="card-body">
                                        <div class="stats-icon">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                        <h2 class="text-white mb-2">{{ count($types) }}</h2>
                                        <p class="mb-0 text-white-50">Publication Types</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-card card text-center p-4 stats-info">
                                    <div class="card-body">
                                        <div class="stats-icon">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                        <h2 class="text-white mb-2">{{ count($years) }}</h2>
                                        <p class="mb-0 text-white-50">Years Available</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="search-box position-relative">
                        <div class="search-container">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" class="form-control form-control-lg search-input" id="search-filter" placeholder="Search publications...">
                            <div class="search-glow"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Publications Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <!-- Enhanced Filters Sidebar -->
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="filter-card card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Publications</h5>
                        </div>
                        <div class="card-body">
                            <form id="filter-form">
                                <div class="mb-4">
                                    <label for="year-filter" class="form-label fw-bold">
                                        <i class="fas fa-calendar-alt me-2"></i>Year
                                    </label>
                                    <select class="form-select filter-select" id="year-filter">
                                        <option value="all" selected>All Years</option>
                                        @foreach($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="type-filter" class="form-label fw-bold">
                                        <i class="fas fa-tags me-2"></i>Publication Type
                                    </label>
                                    <select class="form-select filter-select" id="type-filter">
                                        <option value="all" selected>All Types</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="button" class="btn btn-filter w-100" id="apply-filters">
                                    <i class="fas fa-search me-2"></i>Apply Filters
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="help-card card">
                        <div class="card-body text-center">
                            <i class="fas fa-question-circle"></i>
                            <h5 class="mb-3">Need Help?</h5>
                            <p class="mb-3">Can't find what you're looking for? Request specific data or publications.</p>
                            <a href="{{ route('data-request.create') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-envelope me-2"></i><span style="white-space: nowrap;">Request Data</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Publications List -->
                <div class="col-lg-9">
                    <!-- Debug Information (hidden) -->
                    <div class="alert alert-info" style="display: none;">
                        <h6>Debug Info:</h6>
                        <p><strong>Total Publications:</strong> {{ $publications->total() }}</p>
                        <p><strong>Current Page Count:</strong> {{ $publications->count() }}</p>
                        <p><strong>Publications by Type Count:</strong> {{ count($publicationsByType) }}</p>
                        <p><strong>Types:</strong> {{ implode(', ', $types) }}</p>
                        <p><strong>Years:</strong> {{ implode(', ', $years) }}</p>
                        <p><strong>Publications by Type:</strong></p>
                        <pre>{{ json_encode($publicationsByType, JSON_PRETTY_PRINT) }}</pre>
                    </div>

                    <!-- Featured Publications -->
                    <div class="mb-5">
                        <h2 class="section-title">Featured Publications</h2>
                        <div class="row g-4">
                            @php
                                $featuredPublications = $publications->filter(function($pub) {
                                    return $pub->is_featured;
                                });
                            @endphp

                            @forelse($featuredPublications as $index => $publication)
                                <div class="col-md-6 col-lg-4 featured-item-{{ $index }}">
                                    <div class="publication-card card position-relative">
                                        @if($publication->is_featured)
                                            <div class="featured-badge">
                                                <i class="fas fa-star me-1"></i>Featured
                                            </div>
                                        @endif

                                        <div class="card-body text-center p-4">
                                            <div class="publication-icon">
                                                <i class="far fa-file-pdf"></i>
                                            </div>
                                            <h5 class="card-title mb-3">{{ $publication->title }}</h5>
                                            <div class="d-flex justify-content-center align-items-center gap-2 mb-3">
                                                <span class="publication-type-badge">{{ $publication->type }}</span>
                                                <span class="badge bg-light text-dark border">
                                                    <i class="fas fa-calendar me-1"></i>{{ $publication->year }}
                                                </span>
                                            </div>
                                            <p class="card-text text-muted mb-3">
                                                <i class="fas fa-clock me-1"></i>{{ $publication->publication_date->format('M j, Y') }}
                                            </p>
                                            <p class="card-text">{{ Str::limit($publication->description, 100) }}</p>
                                        </div>

                                        <div class="publication-meta">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="d-flex gap-1" style="gap: 0.5rem !important;">
                                                    <a href="{{ route('publications.show', $publication->id) }}" class="btn btn-view">
                                                        <i class="fas fa-eye me-1"></i>View
                                                    </a>
                                                    <a href="{{ route('publications.download', $publication->id) }}" class="btn btn-download">
                                                        <i class="fas fa-download me-1"></i>Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="empty-state">
                                        <i class="fas fa-star"></i>
                                        <h4>No Featured Publications</h4>
                                        <p>Check back later for featured publications from NIHSA.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    
                    <!-- Publications by Type -->
                    @forelse($publicationsByType as $type => $typePublications)
                        <div class="mb-5 publication-section" id="section-{{ $type }}">
                            <h2 class="section-title">{{ $type }}</h2>
                            <div class="row g-3">
                                @foreach($typePublications as $publication)
                                    <div class="col-12">
                                        <div class="publication-list-item card">
                                            <div class="publication-list-content">
                                                <div class="publication-list-info">
                                                    <h5 class="mb-2">{{ $publication->title }}</h5>
                                                    <div class="publication-list-meta">
                                                        <i class="fas fa-calendar me-2"></i>{{ $publication->publication_date->format('F j, Y') }}
                                                        @if($publication->description)
                                                            <br><small class="text-muted">{{ Str::limit($publication->description, 120) }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="publication-list-actions">
                                                    <span class="publication-type-badge me-2">{{ $publication->year }}</span>
                                                    <a href="{{ route('publications.show', $publication->id) }}" class="btn btn-view">
                                                        <i class="fas fa-eye me-1"></i>View
                                                    </a>
                                                    <a href="{{ route('publications.download', $publication->id) }}" class="btn btn-download">
                                                        <i class="fas fa-download me-1"></i>Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="fas fa-file-alt"></i>
                                <h4>No Publications Available</h4>
                                <p>We don't have any publications to display at the moment. Please check back later or contact us for specific data requests.</p>
                                <a href="{{ route('data-request.create') }}" class="btn btn-primary">
                                    <i class="fas fa-envelope me-2"></i>Request Data
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Publications page loaded');

            const applyFiltersBtn = document.getElementById('apply-filters');
            const yearFilter = document.getElementById('year-filter');
            const typeFilter = document.getElementById('type-filter');
            const searchFilter = document.getElementById('search-filter');
            const publicationSections = document.querySelectorAll('.publication-section');
            const publicationCards = document.querySelectorAll('.publication-card');
            const publicationListItems = document.querySelectorAll('.publication-list-item');

            console.log('Found elements:', {
                publicationSections: publicationSections.length,
                publicationCards: publicationCards.length,
                publicationListItems: publicationListItems.length
            });

            // Real-time search functionality
            searchFilter.addEventListener('input', function() {
                const search = this.value.toLowerCase();
                applySearchFilter(search);
            });

            // Apply filters when button is clicked
            applyFiltersBtn.addEventListener('click', function() {
                const year = yearFilter.value;
                const type = typeFilter.value;
                const search = searchFilter.value.toLowerCase();

                applyFilters(year, type, search);
            });

            // Apply year filter on change
            yearFilter.addEventListener('change', function() {
                const year = this.value;
                const type = typeFilter.value;
                const search = searchFilter.value.toLowerCase();

                applyFilters(year, type, search);
            });

            // Apply type filter on change
            typeFilter.addEventListener('change', function() {
                const year = yearFilter.value;
                const type = this.value;
                const search = searchFilter.value.toLowerCase();

                applyFilters(year, type, search);
            });

            function applyFilters(year, type, search) {
                // Filter sections by type
                publicationSections.forEach(section => {
                    if (type === 'all' || section.id === 'section-' + type) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });

                // Filter publication cards by year and search term
                publicationCards.forEach(card => {
                    const cardYear = card.querySelector('.publication-meta .text-muted').textContent.trim();
                    const cardTitle = card.querySelector('.card-title').textContent.toLowerCase();

                    const yearMatch = year === 'all' || cardYear.includes(year);
                    const searchMatch = search === '' || cardTitle.includes(search);

                    if (yearMatch && searchMatch) {
                        card.style.display = 'block';
                        card.style.opacity = '1';
                    } else {
                        card.style.display = 'none';
                        card.style.opacity = '0';
                    }
                });

                // Filter publication list items by year and search term
                publicationListItems.forEach(item => {
                    const itemYear = item.querySelector('.publication-type-badge').textContent;
                    const itemTitle = item.querySelector('h5').textContent.toLowerCase();

                    const yearMatch = year === 'all' || itemYear === year;
                    const searchMatch = search === '' || itemTitle.includes(search);

                    if (yearMatch && searchMatch) {
                        item.style.display = 'block';
                        item.style.opacity = '1';
                    } else {
                        item.style.display = 'none';
                        item.style.opacity = '0';
                    }
                });

                // Show empty state if no results
                checkEmptyResults();
            }

            function applySearchFilter(search) {
                const year = yearFilter.value;
                const type = typeFilter.value;

                applyFilters(year, type, search);
            }

            function checkEmptyResults() {
                const visibleCards = Array.from(publicationCards).filter(card =>
                    card.style.display !== 'none' && card.style.opacity !== '0'
                );

                const visibleItems = Array.from(publicationListItems).filter(item =>
                    item.style.display !== 'none' && item.style.opacity !== '0'
                );

                const visibleSections = Array.from(publicationSections).filter(section =>
                    section.style.display !== 'none'
                );

                // If no results found, you could show a message
                if (visibleCards.length === 0 && visibleItems.length === 0 && visibleSections.length === 0) {
                    // Could add empty state handling here
                    console.log('No publications match the current filters');
                } else {
                    console.log('Found publications:', visibleCards.length, 'cards,', visibleItems.length, 'items,', visibleSections.length, 'sections');
                }
            }

            // Add smooth animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 0.6s ease-out forwards';
                    }
                });
            }, observerOptions);

            // Observe all publication cards and list items
            publicationCards.forEach(card => observer.observe(card));
            publicationListItems.forEach(item => observer.observe(item));

            // Add staggered animation delays for featured items
            document.querySelectorAll('[class*="featured-item-"]').forEach((item, index) => {
                item.style.animationDelay = `${index * 0.1}s`;
            });

            // Add enhanced CSS animation keyframes
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(50px) scale(0.9);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0) scale(1);
                    }
                }

                @keyframes slideInLeft {
                    from {
                        opacity: 0;
                        transform: translateX(-50px);
                    }
                    to {
                        opacity: 1;
                        transform: translateX(0);
                    }
                }

                @keyframes slideInRight {
                    from {
                        opacity: 0;
                        transform: translateX(50px);
                    }
                    to {
                        opacity: 1;
                        transform: translateX(0);
                    }
                }

                @keyframes bounceIn {
                    0% {
                        opacity: 0;
                        transform: scale(0.3);
                    }
                    50% {
                        opacity: 1;
                        transform: scale(1.05);
                    }
                    70% {
                        transform: scale(0.9);
                    }
                    100% {
                        opacity: 1;
                        transform: scale(1);
                    }
                }

                .publication-card {
                    opacity: 1;
                    animation: fadeInUp 0.8s ease-out forwards;
                }

                .publication-list-item {
                    opacity: 1;
                    animation: slideInLeft 0.6s ease-out forwards;
                }

                .stats-card {
                    animation: bounceIn 1s ease-out both;
                }

                .stats-card:nth-child(1) { animation-delay: 0.1s; }
                .stats-card:nth-child(2) { animation-delay: 0.2s; }
                .stats-card:nth-child(3) { animation-delay: 0.3s; }

                .filter-card {
                    animation: slideInRight 0.8s ease-out 0.4s both;
                }

                .help-card {
                    animation: slideInRight 0.8s ease-out 0.6s both;
                }

                .search-container {
                    animation: fadeInUp 0.8s ease-out 0.8s both;
                }

                /* Loading skeleton animation */
                @keyframes skeleton-loading {
                    0% { background-position: -200px 0; }
                    100% { background-position: calc(200px + 100%) 0; }
                }

                .skeleton {
                    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
                    background-size: 200px 100%;
                    animation: skeleton-loading 1.5s infinite;
                }

                /* Enhanced hover effects */
                .publication-card:hover .card-title {
                    color: var(--primary-color);
                    transition: color 0.3s ease;
                }

                .publication-list-item:hover .publication-list-info h5 {
                    color: var(--primary-color);
                    transition: color 0.3s ease;
                }

                /* Ripple effect for buttons */
                .btn {
                    position: relative;
                    overflow: hidden;
                }

                .btn::after {
                    content: '';
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    width: 0;
                    height: 0;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.3);
                    transform: translate(-50%, -50%);
                    transition: width 0.6s, height 0.6s;
                }

                .btn:active::after {
                    width: 300px;
                    height: 300px;
                }
            `;
            document.head.appendChild(style);
        });
    </script>
@endsection
