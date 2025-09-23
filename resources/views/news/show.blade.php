@extends('layouts.app')

@section('title', $newsItem['title'] . ' - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News & Media</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $newsItem['title'] }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- News Content Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <article class="card shadow-sm mb-4">
                        <img src="{{ $newsItem['image'] }}" class="card-img-top" alt="{{ $newsItem['title'] }}">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-primary">{{ $newsItem['category'] }}</span>
                                <small class="text-muted">{{ date('F j, Y', strtotime($newsItem['published_at'])) }}</small>
                            </div>
                            
                            <h1 class="card-title h2 mb-3">{{ $newsItem['title'] }}</h1>
                            
                            <div class="d-flex align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0">By {{ $newsItem['user']['name'] }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="news-content mb-4">
                                {!! $newsItem['content'] !!}
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                                <div>
                                    <a href="{{ route('news.index') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-arrow-left me-2"></i> Back to News
                                    </a>
                                </div>
                                
                                <div class="d-flex">
                                    <a href="#" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-print me-1"></i> Print
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
                    </article>
                    
                    <!-- Related News -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Related News</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                @foreach($relatedNews as $item)
                                    <div class="col-md-6">
                                        <div class="card h-100">
                                            <img src="{{ $item['image'] }}" class="card-img-top" alt="{{ $item['title'] }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item['title'] }}</h5>
                                                <p class="card-text small text-muted">{{ date('F j, Y', strtotime($item['published_at'])) }}</p>
                                                <p class="card-text">{{ Str::limit($item['content'], 100) }}</p>
                                                <a href="{{ route('news.show', $item['id']) }}" class="btn btn-sm btn-outline-primary">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Latest News -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Latest News</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @php
                                    // If $relatedNews is a Collection, use ->take(); otherwise convert to array
                                    if (is_object($relatedNews) && method_exists($relatedNews, 'take')) {
                                        $latestList = $relatedNews->take(5);
                                    } else {
                                        $latestList = is_array($relatedNews) ? array_slice($relatedNews, 0, 5) : array_slice((array)$relatedNews, 0, 5);
                                    }
                                @endphp
                                @foreach($latestList as $item)
                                    <li class="list-group-item px-0">
                                        <a href="{{ route('news.show', $item['id']) }}" class="text-decoration-none">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="rounded" width="70">
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
                                <a href="{{ route('news.index') }}" class="btn btn-outline-primary w-100">View All News</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Categories -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Categories</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Press Release
                                    <span class="badge bg-primary rounded-pill">3</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    News
                                    <span class="badge bg-primary rounded-pill">5</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Event
                                    <span class="badge bg-primary rounded-pill">2</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Subscribe -->
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
            </div>
        </div>
    </section>
@endsection
