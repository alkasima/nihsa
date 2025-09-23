@extends('layouts.app')

@section('title', 'Search Results - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Search Header Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="fade-up">
                    <h1 class="section-title text-center">Search Results</h1>
                    <p class="lead mb-4">Showing results for: <strong>{{ $query }}</strong></p>
                    
                    <form action="{{ route('search') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" placeholder="Search for hydrological data, publications, or news..." name="query" value="{{ $query }}">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search me-2"></i> Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Results Section -->
    <section class="py-5 bg-white">
        <div class="container">
            @if(count($results) > 0)
                <div class="row mb-4">
                    <div class="col-12">
                        <p class="text-muted">Found {{ count($results) }} results</p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8">
                        @foreach($results as $result)
                            <div class="card mb-4 border-0 shadow-sm" data-aos="fade-up">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        @if($result['type'] == 'News')
                                            <span class="badge bg-primary me-2">News</span>
                                        @elseif($result['type'] == 'Publication')
                                            <span class="badge bg-success me-2">Publication</span>
                                        @elseif($result['type'] == 'Page')
                                            <span class="badge bg-info me-2">Page</span>
                                        @endif
                                        
                                        @if($result['date'])
                                            <span class="small text-muted"><i class="far fa-calendar-alt me-1"></i> {{ $result['date'] }}</span>
                                        @endif
                                    </div>
                                    
                                    <h3 class="h5 mb-2">
                                        <a href="{{ $result['url'] }}" class="text-decoration-none">{{ $result['title'] }}</a>
                                    </h3>
                                    
                                    <p class="mb-2">{{ $result['description'] }}</p>
                                    
                                    <a href="{{ $result['url'] }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-arrow-right me-1"></i> View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm mb-4" data-aos="fade-up">
                            <div class="card-body">
                                <h4 class="h5 mb-3">Filter Results</h4>
                                
                                <form action="{{ route('search') }}" method="GET">
                                    <input type="hidden" name="query" value="{{ $query }}">
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Content Type</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="news" id="newsCheck" checked>
                                            <label class="form-check-label" for="newsCheck">
                                                News
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="publications" id="publicationsCheck" checked>
                                            <label class="form-check-label" for="publicationsCheck">
                                                Publications
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="pages" id="pagesCheck" checked>
                                            <label class="form-check-label" for="pagesCheck">
                                                Pages
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Date Range</label>
                                        <select class="form-select">
                                            <option selected>All Time</option>
                                            <option>Last Year</option>
                                            <option>Last Month</option>
                                            <option>Last Week</option>
                                        </select>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="card border-0 shadow-sm" data-aos="fade-up">
                            <div class="card-body">
                                <h4 class="h5 mb-3">Popular Searches</h4>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('search', ['query' => 'flood forecast']) }}" class="btn btn-sm btn-outline-secondary">Flood Forecast</a>
                                    <a href="{{ route('search', ['query' => 'annual outlook']) }}" class="btn btn-sm btn-outline-secondary">Annual Outlook</a>
                                    <a href="{{ route('search', ['query' => 'hydrological data']) }}" class="btn btn-sm btn-outline-secondary">Hydrological Data</a>
                                    <a href="{{ route('search', ['query' => 'rainfall']) }}" class="btn btn-sm btn-outline-secondary">Rainfall</a>
                                    <a href="{{ route('search', ['query' => 'water resources']) }}" class="btn btn-sm btn-outline-secondary">Water Resources</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center" data-aos="fade-up">
                        <div class="card border-0 shadow-sm p-5">
                            <div class="mb-4">
                                <i class="fas fa-search fa-4x text-muted"></i>
                            </div>
                            <h3>No Results Found</h3>
                            <p class="mb-4">We couldn't find any results matching your search query. Please try again with different keywords.</p>
                            
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h5 class="mb-3">Try searching for:</h5>
                                    <div class="d-flex flex-wrap justify-content-center gap-2">
                                        <a href="{{ route('search', ['query' => 'flood forecast']) }}" class="btn btn-sm btn-outline-primary">Flood Forecast</a>
                                        <a href="{{ route('search', ['query' => 'annual outlook']) }}" class="btn btn-sm btn-outline-primary">Annual Outlook</a>
                                        <a href="{{ route('search', ['query' => 'hydrological data']) }}" class="btn btn-sm btn-outline-primary">Hydrological Data</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
