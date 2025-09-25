@extends('layouts.app')

@section('title', $newsItem['title'] . ' - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Breadcrumb -->
    <section class="py-3 bg-light border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News & Media</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $newsItem['title'] }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="news-detail-hero py-5 position-relative overflow-hidden">
        <div class="hero-bg-gradient"></div>
        <div class="container position-relative">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="hero-content">
                        <!-- Hero content without breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Content Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <article class="news-article-card">
                        <div class="article-image-wrapper">
                            <img src="{{ $newsItem['image'] }}" class="article-image" alt="{{ $newsItem['title'] }}" onerror="this.src='{{ asset('images/placeholder-300x200.svg') }}'">
                            <div class="article-image-overlay">
                                <span class="badge bg-primary">{{ $newsItem['category'] }}</span>
                            </div>
                        </div>

                        <div class="article-content">
                            <div class="article-meta">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-primary">{{ $newsItem['category'] }}</span>
                                    <small class="text-muted">{{ date('F j, Y', strtotime($newsItem['published_at'])) }}</small>
                                </div>

                                <div class="d-flex align-items-center mb-4">
                                    <div class="author-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="author-info">
                                        <p class="mb-0 fw-semibold">By {{ $newsItem['user']['name'] }}</p>
                                    </div>
                                </div>
                            </div>

                            <h1 class="article-title">{{ $newsItem['title'] }}</h1>

                            <div class="article-body">
                                @php
                                    echo $newsItem->content;
                                @endphp
                            </div>

                            <div class="article-actions">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="{{ route('news.index') }}" class="btn btn-primary">
                                            <i class="fas fa-arrow-left me-2"></i> Back to News
                                        </a>
                                    </div>

                                    <div class="d-flex">
                                        <a href="#" class="btn btn-outline-secondary me-2">
                                            <i class="fas faprint me1 - show.blade.php:81"></i> Print
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="shareDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-share-alt me-1"></i> Share
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="shareDropdown">
                                                <li><a class="dropdown-item" href="#"><i class="fab fa-facebook me-2"></i> Facebook</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fab fa-twitter me-2"></i> Twitter</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fab fa-linkedin me-2"></i> LinkedIn</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i> Email</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Related News -->
                    <div class="related-news-section">
                        <div class="section-header mb-4">
                            <h3 class="fw-bold">Related News</h3>
                        </div>
                        <div class="row g-4">
                            @foreach($relatedNews as $item)
                                <div class="col-md-6">
                                    <div class="related-news-card">
                                        <div class="card-image-wrapper">
                                            <img src="{{ $item['image'] }}" class="card-img-top" alt="{{ $item['title'] }}" onerror="this.src='{{ asset('images/placeholder-200x300.svg') }}'">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item['title'] }}</h5>
                                            <p class="card-text small text-muted">{{ date('F j, Y', strtotime($item['published_at'])) }}</p>
                                            <p class="card-text">{!! Str::limit($item->content, 100) !!}</p>
                                            <a href="{{ route('news.show', $item['id']) }}" class="btn btn-primary btn-sm">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Latest News -->
                    <div class="sidebar-card">
                        <div class="card-header">
                            <h5 class="mb-0 fw-bold">Latest News</h5>
                        </div>
                        <div class="card-body">
                            <ul class="latest-news-list">
                                @php
                                    // If $relatedNews is a Collection, use ->take(); otherwise convert to array
                                    if (is_object($relatedNews) && method_exists($relatedNews, 'take')) {
                                        $latestList = $relatedNews->take(5);
                                    } else {
                                        $latestList = is_array($relatedNews) ? array_slice($relatedNews, 0, 5) : array_slice((array)$relatedNews, 0, 5);
                                    }
                                @endphp
                                @foreach($latestList as $item)
                                    <li class="latest-news-item">
                                        <a href="{{ route('news.show', $item['id']) }}" class="text-decoration-none">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="rounded" width="70" onerror="this.src='{{ asset('images/placeholder-200x300.svg') }}'">
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-1">{{ $item['title'] }}</h6>
                                                    <small class="text-muted">{{ date('F j, Y', strtotime($item['published_at'])) }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-3">
                                <a href="{{ route('news.index') }}" class="btn btn-primary w-100">View All News</a>
                            </div>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="sidebar-card">
                        <div class="card-header">
                            <h5 class="mb-0 fw-bold">Categories</h5>
                        </div>
                        <div class="card-body">
                            <div class="categories-list">
                                <a href="#" class="category-item">
                                    <span>Press Release</span>
                                    <span class="badge bg-primary rounded-pill">3</span>
                                </a>
                                <a href="#" class="category-item">
                                    <span>News</span>
                                    <span class="badge bg-primary rounded-pill">5</span>
                                </a>
                                <a href="#" class="category-item">
                                    <span>Event</span>
                                    <span class="badge bg-primary rounded-pill">2</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Subscribe -->
                    <div class="sidebar-card">
                        <div class="card-header">
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
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    /* Hero Section */
    .news-detail-hero {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
        position: relative;
        min-height: 40vh;
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

    /* Article Styles */
    .news-article-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .news-article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .article-image-wrapper {
        position: relative;
        height: 400px;
        overflow: hidden;
    }

    .article-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .news-article-card:hover .article-image {
        transform: scale(1.05);
    }

    .article-image-overlay {
        position: absolute;
        top: 1rem;
        left: 1rem;
    }

    .article-content {
        padding: 2rem;
    }

    .article-meta .badge {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
    }

    .author-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    .author-info p {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .article-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        line-height: 1.2;
        margin-bottom: 2rem;
    }

    .article-body {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #4b5563;
        margin-bottom: 2rem;
    }

    .article-body h2, .article-body h3, .article-body h4 {
        color: #1f2937;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .article-body p {
        margin-bottom: 1.5rem;
    }

    .article-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }

    .article-actions {
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }

    /* Related News */
    .related-news-section {
        margin-top: 3rem;
    }

    .related-news-section .section-header h3 {
        color: #1f2937;
        font-size: 1.75rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .related-news-section .section-header h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        border-radius: 2px;
    }

    .related-news-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .related-news-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .related-news-card .card-image-wrapper {
        height: 180px;
        overflow: hidden;
    }

    .related-news-card .card-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .related-news-card:hover .card-image-wrapper img {
        transform: scale(1.05);
    }

    /* Sidebar */
    .sidebar-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }

    .sidebar-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    .card-header {
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        color: white;
        padding: 1rem 1.5rem;
    }

    .card-header h5 {
        font-size: 1.1rem;
    }

    .latest-news-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .latest-news-item {
        padding: 1rem 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .latest-news-item:last-child {
        border-bottom: none;
    }

    .latest-news-item a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .latest-news-item a:hover {
        color: #3b82f6;
    }

    .latest-news-item h6 {
        font-size: 0.95rem;
        line-height: 1.4;
        margin-bottom: 0.25rem;
    }

    .categories-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .category-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        background: #f8fafc;
        border-radius: 8px;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
    }

    .category-item:hover {
        background: #3b82f6;
        color: white;
        transform: translateX(5px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .article-title {
            font-size: 2rem;
        }

        .article-content {
            padding: 1.5rem;
        }

        .article-image-wrapper {
            height: 250px;
        }

        .news-detail-hero {
            min-height: 30vh;
            padding: 2rem 0;
        }
    }

    /* Animation */
    .fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
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
        // Add animations
        const animatedElements = document.querySelectorAll('.news-article-card, .related-news-card, .sidebar-card');
        animatedElements.forEach((el, index) => {
            setTimeout(() => {
                el.classList.add('fade-in-up');
            }, index * 150);
        });

        // Share functionality
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const platform = this.textContent.trim();
                const url = window.location.href;
                const title = document.title;

                let shareUrl = '';

                switch(platform) {
                    case 'Facebook':
                        shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                        break;
                    case 'Twitter':
                        shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`;
                        break;
                    case 'LinkedIn':
                        shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
                        break;
                    case 'Email':
                        shareUrl = `mailto:?subject=${encodeURIComponent(title)}&body=${encodeURIComponent(url)}`;
                        break;
                }

                if (shareUrl) {
                    window.open(shareUrl, '_blank', 'width=600,height=400');
                }
            });
        });

        // Print functionality
        document.querySelector('.btn:has(.fa-print)').addEventListener('click', function(e) {
            e.preventDefault();
            window.print();
        });
    });
</script>
@endsection
