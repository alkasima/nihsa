@extends('layouts.app')

@section('title', 'News & Media - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Breadcrumb -->
    <section class="py-3 bg-light border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">News & Media</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="news-hero py-5 position-relative overflow-hidden">
        <div class="hero-bg-gradient"></div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="hero-content">
                        <h1 class="display-4 fw-bold mb-4 text-white">News & Media</h1>
                        <p class="lead mb-4 text-white-50">Stay updated with the latest news, events, and announcements from NIHSA</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured News Section -->
    <section class="py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Featured News</h2>
                <p class="lead text-muted">Stay informed with our latest featured stories and announcements</p>
            </div>

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
                        <div class="card h-100 shadow-sm news-card">
                            <div class="card-img-wrapper">
                                <img src="{{ $get('image') }}" class="card-img-top" alt="{{ $get('title') }}">
                                <div class="card-img-overlay d-flex align-items-end">
                                    <span class="badge bg-primary">{{ $get('category') }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">{{ date('F j, Y', strtotime($get('published_at'))) }}</small>
                                </div>
                                <h5 class="card-title fw-bold">{{ $get('title') }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($get('content'), 120) }}</p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="{{ route('news.show', $get('id')) }}" class="btn btn-primary w-100">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- All News Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Filters Sidebar -->
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="card shadow-sm mb-4 filter-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 fw-bold">Filter News</h5>
                        </div>
                        <div class="card-body">
                            <form id="filter-form">
                                <div class="mb-3">
                                    <label for="category-filter" class="form-label fw-semibold">Category</label>
                                    <select class="form-select" id="category-filter">
                                        <option value="all" selected>All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}">{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="date-filter" class="form-label fw-semibold">Date Range</label>
                                    <select class="form-select" id="date-filter">
                                        <option value="all" selected>All Time</option>
                                        <option value="week">Past Week</option>
                                        <option value="month">Past Month</option>
                                        <option value="year">Past Year</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="search-filter" class="form-label fw-semibold">Search</label>
                                    <input type="text" class="form-control" id="search-filter" placeholder="Search news...">
                                </div>

                                <button type="button" class="btn btn-primary w-100" id="apply-filters">Apply Filters</button>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow-sm subscribe-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 fw-bold">Subscribe to Updates</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Stay updated with the latest news and announcements from NIHSA.</p>
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
                    <div class="card shadow-sm news-list-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 fw-bold">Latest News</h5>
                        </div>
                        <div class="card-body">
                            <div class="news-list">
                                @foreach($news as $item)
                                    @php
                                        $get = function($key) use ($item) {
                                            if (is_array($item)) return $item[$key] ?? null;
                                            if (is_object($item)) return $item->{$key} ?? null;
                                            return null;
                                        };
                                    @endphp
                                    <a href="{{ route('news.show', $get('id')) }}" class="news-item-card" data-category="{{ $get('category') }}">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <div class="news-image-wrapper">
                                                    <img src="{{ $get('image') }}" class="img-fluid rounded" alt="{{ $get('title') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="news-content">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span class="badge bg-primary">{{ $get('category') }}</span>
                                                        <small class="text-muted">{{ date('F j, Y', strtotime($get('published_at'))) }}</small>
                                                    </div>
                                                    <h5 class="news-title">{{ $get('title') }}</h5>
                                                    <p class="news-excerpt">{{ Str::limit($get('content'), 150) }}</p>
                                                    <div class="news-meta">
                                                        <small class="text-muted">Read more →</small>
                                                    </div>
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
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Media Gallery</h2>
                <p class="lead text-muted">Explore our photo and video collections</p>
            </div>

            <!-- Gallery Tabs -->
            <ul class="nav nav-tabs justify-content-center mb-5" id="mediaTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="photos-tab" data-bs-toggle="tab" data-bs-target="#photos" type="button" role="tab" aria-controls="photos" aria-selected="true">
                        <i class="fas fa-images me-2"></i>Photos
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button" role="tab" aria-controls="videos" aria-selected="false">
                        <i class="fas fa-video me-2"></i>Videos
                    </button>
                </li>
            </ul>

            <!-- Gallery Content -->
            <div class="tab-content" id="mediaTabContent">
                <!-- Photos Tab -->
                <div class="tab-pane fade show active" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="gallery-item">
                                <img src="{{ asset('images/g-1.jpg') }}" class="img-fluid rounded" alt="Gallery Image">
                                <div class="gallery-overlay">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="gallery-item">
                                <img src="{{ asset('images/g-7.jpg') }}" class="img-fluid rounded" alt="Gallery Image">
                                <div class="gallery-overlay">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="gallery-item">
                                <img src="{{ asset('images/g-3.jpg') }}" class="img-fluid rounded" alt="Gallery Image">
                                <div class="gallery-overlay">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="gallery-item">
                                <img src="{{ asset('images/g-4.jpg') }}" class="img-fluid rounded" alt="Gallery Image">
                                <div class="gallery-overlay">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="gallery-item">
                                <img src="{{ asset('images/g-5.jpg') }}" class="img-fluid rounded" alt="Gallery Image">
                                <div class="gallery-overlay">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="gallery-item">
                                <img src="{{ asset('images/g-6.jpg') }}" class="img-fluid rounded" alt="Gallery Image">
                                <div class="gallery-overlay">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <a href="#" class="btn btn-primary btn-lg">View All Photos</a>
                    </div>
                </div>

                <!-- Videos Tab -->
                <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card video-card">
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
                            <div class="card video-card">
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

                    <div class="text-center mt-5">
                        <a href="#" class="btn btn-primary btn-lg">View All Videos</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    /* Hero Section */
    .news-hero {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
        position: relative;
        min-height: 60vh;
        display: flex;
        align-items: center;
    }

    .hero-bg-gradient {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(30, 64, 175, 0.9) 0%, rgba(59, 130, 246, 0.8) 50%, rgba(96, 165, 250, 0.9) 100%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 700;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        margin-bottom: 1.5rem;
    }

    .hero-content p {
        font-size: 1.25rem;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }

    /* Section Headers */
    .section-header h2 {
        color: #1f2937;
        font-weight: 700;
        position: relative;
    }

    .section-header h2::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        margin: 1rem auto 0;
        border-radius: 2px;
    }

    /* News Cards */
    .news-card {
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .card-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 200px;
    }

    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .news-card:hover .card-img-wrapper img {
        transform: scale(1.05);
    }

    .card-img-overlay {
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .news-card:hover .card-img-overlay {
        opacity: 1;
    }

    /* Filter Cards */
    .filter-card, .subscribe-card {
        border: none;
        transition: all 0.3s ease;
    }

    .filter-card:hover, .subscribe-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* News List Cards */
    .news-list-card {
        border: none;
    }

    .news-item-card {
        display: block;
        padding: 1.5rem;
        margin-bottom: 1rem;
        background: white;
        border-radius: 12px;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
    }

    .news-item-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        text-decoration: none;
        color: inherit;
    }

    .news-image-wrapper {
        height: 150px;
        overflow: hidden;
        border-radius: 8px;
    }

    .news-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .news-item-card:hover .news-image-wrapper img {
        transform: scale(1.05);
    }

    .news-content {
        padding: 0 1rem;
    }

    .news-title {
        color: #1f2937;
        font-weight: 600;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .news-excerpt {
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .news-meta {
        font-weight: 500;
        color: #3b82f6;
    }

    /* Gallery Items */
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(59, 130, 246, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-overlay i {
        color: white;
        font-size: 2rem;
    }

    /* Video Cards */
    .video-card {
        border: none;
        transition: all 0.3s ease;
    }

    .video-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.5rem;
        }

        .hero-content p {
            font-size: 1.1rem;
        }

        .news-hero {
            min-height: 50vh;
            padding: 3rem 0;
        }

        .section-header h2 {
            font-size: 2rem;
        }
    }

    /* Animation Classes */
    .fade-in {
        animation: fadeIn 0.6s ease forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add fade-in animation to elements
        const animatedElements = document.querySelectorAll('.news-card, .filter-card, .subscribe-card, .news-item-card, .gallery-item, .video-card');
        animatedElements.forEach((el, index) => {
            setTimeout(() => {
                el.classList.add('fade-in');
            }, index * 100);
        });

        // Enhanced filter functionality
        const applyFiltersBtn = document.getElementById('apply-filters');
        const categoryFilter = document.getElementById('category-filter');
        const dateFilter = document.getElementById('date-filter');
        const searchFilter = document.getElementById('search-filter');
        const newsItems = document.querySelectorAll('.news-item-card');

        applyFiltersBtn.addEventListener('click', function() {
            const category = categoryFilter.value;
            const date = dateFilter.value;
            const search = searchFilter.value.toLowerCase();

            newsItems.forEach(item => {
                const itemCategory = item.dataset.category;
                const itemTitle = item.querySelector('.news-title').textContent.toLowerCase();
                const itemContent = item.querySelector('.news-excerpt').textContent.toLowerCase();

                const categoryMatch = category === 'all' || itemCategory === category;
                const searchMatch = search === '' || itemTitle.includes(search) || itemContent.includes(search);

                // Date filtering would be more complex in a real implementation
                const dateMatch = true;

                if (categoryMatch && dateMatch && searchMatch) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeIn 0.5s ease forwards';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Real-time search
        searchFilter.addEventListener('input', function() {
            if (this.value === '') {
                applyFiltersBtn.click();
            }
        });

        // Gallery lightbox functionality (placeholder)
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                // Add lightbox functionality here
                console.log('Gallery item clicked');
            });
        });
    });
</script>
@endsection
