@extends('layouts.app')

@section('title', 'Publications - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">Publications</h1>
                    <p class="lead">Access our reports, bulletins, and other publications</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Publications Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Filters Sidebar -->
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Filter Publications</h5>
                        </div>
                        <div class="card-body">
                            <form id="filter-form">
                                <div class="mb-3">
                                    <label for="year-filter" class="form-label">Year</label>
                                    <select class="form-select" id="year-filter">
                                        <option value="all" selected>All Years</option>
                                        @foreach($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="type-filter" class="form-label">Publication Type</label>
                                    <select class="form-select" id="type-filter">
                                        <option value="all" selected>All Types</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="search-filter" class="form-label">Search</label>
                                    <input type="text" class="form-control" id="search-filter" placeholder="Search publications...">
                                </div>
                                
                                <button type="button" class="btn btn-primary w-100" id="apply-filters">Apply Filters</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Need Help?</h5>
                        </div>
                        <div class="card-body">
                            <p>Can't find what you're looking for? Request specific data or publications.</p>
                            <a href="{{ route('data-request.create') }}" class="btn btn-outline-primary w-100">Request Data</a>
                        </div>
                    </div>
                </div>
                
                <!-- Publications List -->
                <div class="col-lg-9">
                    <!-- Featured Publications -->
                    <div class="mb-5">
                        <h2 class="mb-4">Featured Publications</h2>
                        <div class="row g-4">
                            @php
                                $featuredPublications = $publications->filter(function($pub) {
                                    return $pub->is_featured;
                                });
                            @endphp
                            
                            @foreach($featuredPublications as $publication)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <i class="far fa-file-pdf fa-4x text-danger"></i>
                                            </div>
                                            <h5 class="card-title">{{ $publication->title }}</h5>
                                            <p class="card-text small text-muted">{{ $publication->publication_date->format('F j, Y') }}</p>
                                            <p class="card-text">{{ $publication->description }}</p>
                                        </div>
                                        <div class="card-footer bg-transparent border-top-0">
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('publications.show', $publication->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                                <a href="{{ route('publications.download', $publication->id) }}" class="btn btn-sm btn-outline-success">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Publications by Type -->
                    @foreach($publicationsByType as $type => $typePublications)
                        <div class="mb-5 publication-section" id="section-{{ $type }}">
                            <h2 class="mb-4">{{ $type }}</h2>
                            <div class="list-group">
                                @foreach($typePublications as $publication)
                                    <a href="{{ route('publications.show', $publication->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-1">{{ $publication->title }}</h5>
                                            <p class="mb-1 text-muted small">{{ $publication->publication_date->format('F j, Y') }}</p>
                                        </div>
                                        <div>
                                            <span class="badge bg-primary rounded-pill">{{ $publication->year }}</span>
                                            <a href="{{ route('publications.download', $publication->id) }}" class="btn btn-sm btn-outline-success ms-2">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const applyFiltersBtn = document.getElementById('apply-filters');
            const yearFilter = document.getElementById('year-filter');
            const typeFilter = document.getElementById('type-filter');
            const searchFilter = document.getElementById('search-filter');
            const publicationSections = document.querySelectorAll('.publication-section');
            const listItems = document.querySelectorAll('.list-group-item');
            
            applyFiltersBtn.addEventListener('click', function() {
                const year = yearFilter.value;
                const type = typeFilter.value;
                const search = searchFilter.value.toLowerCase();
                
                // Filter sections by type
                publicationSections.forEach(section => {
                    if (type === 'all' || section.id === 'section-' + type) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
                
                // Filter list items by year and search term
                listItems.forEach(item => {
                    const itemYear = item.querySelector('.badge').textContent;
                    const itemTitle = item.querySelector('h5').textContent.toLowerCase();
                    
                    const yearMatch = year === 'all' || itemYear === year;
                    const searchMatch = search === '' || itemTitle.includes(search);
                    
                    if (yearMatch && searchMatch) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
