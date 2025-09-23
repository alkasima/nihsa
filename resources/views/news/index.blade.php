@extends('layouts.app')

@section('title', 'News & Media - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">News & Media</h1>
                    <p class="lead">Stay updated with the latest news and events from NIHSA</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">News & Media</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured News Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="mb-4">Featured News</h2>
            <div class="row g-4">
                @php
                    // If $news is a paginator, get the underlying items array
                    $newsItems = (is_object($news) && method_exists($news, 'items')) ? $news->items() : $news;

                    // Ensure we operate on a plain array to safely use array functions
                    $newsArray = is_array($newsItems) ? $newsItems : (is_object($newsItems) && method_exists($newsItems, 'all') ? $newsItems->all() : (array)$newsItems);

                    $featuredNews = array_filter($newsArray, function($item) {
                        // Support both arrays and Eloquent model objects
                        if (is_array($item)) {
                            return !empty($item['is_featured']);
                        }
                        if (is_object($item)) {
                            return !empty($item->is_featured);
                        }
                        return false;
                    });

                    $featuredNews = array_slice($featuredNews, 0, 3);
                @endphp
                
                @foreach($featuredNews as $item)
                    @php
                        $get = function($key) use ($item) {
                            if (is_array($item)) return $item[$key] ?? null;
                            if (is_object($item)) return $item->{$key} ?? null;
                            return null;
                        };
                    @endphp
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ $get('image') }}" class="card-img-top" alt="{{ $get('title') }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary">{{ $get('category') }}</span>
                                    <small class="text-muted">{{ date('F j, Y', strtotime($get('published_at'))) }}</small>
                                </div>
                                <h5 class="card-title">{{ $get('title') }}</h5>
                                <p class="card-text">{{ Str::limit($get('content'), 100) }}</p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="{{ route('news.show', $get('id')) }}" class="btn btn-outline-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- All News Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <!-- Filters Sidebar -->
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Filter News</h5>
                        </div>
                        <div class="card-body">
                            <form id="filter-form">
                                <div class="mb-3">
                                    <label for="category-filter" class="form-label">Category</label>
                                    <select class="form-select" id="category-filter">
                                        <option value="all" selected>All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}">{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="date-filter" class="form-label">Date Range</label>
                                    <select class="form-select" id="date-filter">
                                        <option value="all" selected>All Time</option>
                                        <option value="week">Past Week</option>
                                        <option value="month">Past Month</option>
                                        <option value="year">Past Year</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="search-filter" class="form-label">Search</label>
                                    <input type="text" class="form-control" id="search-filter" placeholder="Search news...">
                                </div>
                                
                                <button type="button" class="btn btn-primary w-100" id="apply-filters">Apply Filters</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Subscribe to Updates</h5>
                        </div>
                        <div class="card-body">
                            <p>Stay updated with the latest news and announcements from NIHSA.</p>
                            <form>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Your Email Address">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- News List -->
                <div class="col-lg-9">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Latest News</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group news-list">
                                @foreach($news as $item)
                                    @php
                                        $get = function($key) use ($item) {
                                            if (is_array($item)) return $item[$key] ?? null;
                                            if (is_object($item)) return $item->{$key} ?? null;
                                            return null;
                                        };
                                    @endphp
                                    <a href="{{ route('news.show', $get('id')) }}" class="list-group-item list-group-item-action news-item" data-category="{{ $get('category') }}">
                                        <div class="row g-0">
                                            <div class="col-md-3">
                                                <img src="{{ $get('image') }}" class="img-fluid rounded" alt="{{ $get('title') }}">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span class="badge bg-primary">{{ $get('category') }}</span>
                                                        <small class="text-muted">{{ date('F j, Y', strtotime($get('published_at'))) }}</small>
                                                    </div>
                                                    <h5 class="card-title">{{ $get('title') }}</h5>
                                                    <p class="card-text">{{ Str::limit($get('content'), 150) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            
                            <!-- Dynamic pagination -->
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $news->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Media Gallery Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="mb-4">Media Gallery</h2>
            
            <!-- Gallery Tabs -->
            <ul class="nav nav-tabs mb-4" id="mediaTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="photos-tab" data-bs-toggle="tab" data-bs-target="#photos" type="button" role="tab" aria-controls="photos" aria-selected="true">Photos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button" role="tab" aria-controls="videos" aria-selected="false">Videos</button>
                </li>
            </ul>
            
            <!-- Gallery Content -->
            <div class="tab-content" id="mediaTabContent">
                <!-- Photos Tab -->
                <div class="tab-pane fade show active" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <a href="#" class="gallery-item">
                                <img src="{{ asset('images/g-1.jpg') }}" class="img-fluid rounded" alt="Gallery Image">
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="gallery-item">
                                <img src="{{ asset('images/g-7.jpg') }}" class="img-fluid rounded" alt="Gallery Image">
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="gallery-item">
                                <img src="{{ asset('images/g-3.jpg') }}" class="img-fluid rounded" alt="Gallery Image">
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="gallery-item">
                                <img src="{{ asset('images/g-4.jpg') }}" class="img-fluid rounded" alt="Gallery Image">
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="gallery-item">
                                <img src="{{ asset('images/g-5.jpg') }}" class="img-fluid rounded" alt="Gallery Image">
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="gallery-item">
                                <img src="{{ asset('images/g-6.jpg') }}" class="img-fluid rounded" alt="Gallery Image">
                            </a>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="#" class="btn btn-outline-primary">View All Photos</a>
                    </div>
                </div>
                
                <!-- Videos Tab -->
                <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/cPh9ZHxEoho" title="NIHSA Video" allowfullscreen></iframe>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">2025 Annual Flood Outlook Launch</h5>
                                    <p class="card-text">Launch ceremony of the 2025 Annual Flood Outlook by NIHSA.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/7HL3YIqdZws" title="NIHSA Video" allowfullscreen></iframe>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">NIHSA seeks NAN partnership</h5>
                                    <p class="card-text">NIHSA seeks NAN partnership on water resources, flood management</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="#" class="btn btn-outline-primary">View All Videos</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const applyFiltersBtn = document.getElementById('apply-filters');
            const categoryFilter = document.getElementById('category-filter');
            const dateFilter = document.getElementById('date-filter');
            const searchFilter = document.getElementById('search-filter');
            const newsItems = document.querySelectorAll('.news-item');
            
            applyFiltersBtn.addEventListener('click', function() {
                const category = categoryFilter.value;
                const date = dateFilter.value;
                const search = searchFilter.value.toLowerCase();
                
                newsItems.forEach(item => {
                    const itemCategory = item.dataset.category;
                    const itemTitle = item.querySelector('.card-title').textContent.toLowerCase();
                    const itemContent = item.querySelector('.card-text').textContent.toLowerCase();
                    
                    const categoryMatch = category === 'all' || itemCategory === category;
                    const searchMatch = search === '' || itemTitle.includes(search) || itemContent.includes(search);
                    
                    // Date filtering would be more complex in a real implementation
                    const dateMatch = true;
                    
                    if (categoryMatch && dateMatch && searchMatch) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
