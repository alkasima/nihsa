@extends('layouts.app')

@section('title', 'Products - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <h1 class="display-5 fw-bold mb-4">Our Products</h1>
                    <p class="lead mb-4">NIHSA offers a wide range of hydrological products to support water resources management, flood forecasting, and disaster preparedness in Nigeria.</p>
                    <p>Our products are developed by expert hydrologists and are based on comprehensive data collection and analysis. They provide valuable information for government agencies, researchers, communities, and other stakeholders.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <img src="{{ asset('images/products-hero.jpg') }}" alt="NIHSA Products" class="img-fluid" onerror="this.src='https://via.placeholder.com/600x400?text=NIHSA+Products'">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Featured Products</h2>
            <div class="row g-4">
                @foreach($featuredProducts as $product)
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="card h-100 border-0 shadow-sm product-card">
                            <div class="position-relative">
                                <img src="{{ asset($product['image']) }}" class="card-img-top" alt="{{ $product['name'] }}" onerror="this.src='https://via.placeholder.com/300x200?text={{ urlencode($product['name']) }}'">
                                <div class="product-category-badge">{{ $product['category'] }}</div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product['name'] }}</h5>
                                <p class="card-text flex-grow-1">{{ $product['description'] }}</p>
                                <a href="{{ route('products.show', $product['id']) }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-info-circle me-2"></i> Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Products By Category Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Our Product Categories</h2>
            
            <ul class="nav nav-pills mb-4 justify-content-center" id="products-tab" role="tablist" data-aos="fade-up">
                @foreach($productsByCategory as $category => $products)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                id="{{ Str::slug($category) }}-tab" 
                                data-bs-toggle="pill" 
                                data-bs-target="#{{ Str::slug($category) }}" 
                                type="button" 
                                role="tab" 
                                aria-controls="{{ Str::slug($category) }}" 
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $category }}
                        </button>
                    </li>
                @endforeach
            </ul>
            
            <div class="tab-content" id="products-tabContent">
                @foreach($productsByCategory as $category => $products)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                         id="{{ Str::slug($category) }}" 
                         role="tabpanel" 
                         aria-labelledby="{{ Str::slug($category) }}-tab">
                        
                        <div class="row g-4">
                            @foreach($products as $product)
                                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                                    <div class="card h-100 border-0 shadow-sm product-card">
                                        <div class="position-relative">
                                            <img src="{{ asset($product['image']) }}" class="card-img-top" alt="{{ $product['name'] }}" onerror="this.src='https://via.placeholder.com/300x200?text={{ urlencode($product['name']) }}'">
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $product['name'] }}</h5>
                                            <p class="card-text flex-grow-1">{{ $product['description'] }}</p>
                                            <a href="{{ route('products.show', $product['id']) }}" class="btn btn-outline-primary mt-3">
                                                <i class="fas fa-info-circle me-2"></i> View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <h2 class="mb-4">Need Customized Hydrological Data?</h2>
                    <p class="lead mb-4">We can provide customized hydrological data and products tailored to your specific needs.</p>
                    <a href="{{ route('data-request.create') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-file-alt me-2"></i> Request Data
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .product-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    
    .product-category-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: var(--primary-color);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .nav-pills .nav-link {
        margin: 0 5px;
        border-radius: 20px;
        padding: 8px 20px;
        color: var(--dark-color);
        font-weight: 500;
    }
    
    .nav-pills .nav-link.active {
        background-color: var(--primary-color);
        color: white;
    }
</style>
@endsection
