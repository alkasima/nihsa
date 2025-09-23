@extends('layouts.app')

@section('title', $product['name'] . ' - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Breadcrumb -->
    <section class="py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product['name'] }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Product Detail Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="img-fluid" onerror="this.src='https://via.placeholder.com/600x400?text={{ urlencode($product['name']) }}'">
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="product-category mb-2">{{ $product['category'] }}</div>
                    <h1 class="display-5 fw-bold mb-3">{{ $product['name'] }}</h1>
                    <p class="lead mb-4">{{ $product['description'] }}</p>
                    
                    <div class="row mb-4">
                        <div class="col-12">
                            <h4 class="mb-3">Product Details</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach($product['details'] as $key => $value)
                                            <tr>
                                                <th class="bg-light">{{ $key }}</th>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
                        <a href="{{ route('data-request.create') }}" class="btn btn-primary btn-lg px-4 me-md-2">
                            <i class="fas fa-download me-2"></i> Request This Product
                        </a>
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                            <i class="fas fa-question-circle me-2"></i> Ask Questions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Key Features</h2>
            <div class="row g-4">
                @foreach($product['features'] as $feature)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="feature-icon mb-3">
                                    <i class="fas fa-check-circle text-primary"></i>
                                </div>
                                <h5 class="card-title">{{ $feature }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Related Products Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Related Products</h2>
            <div class="row g-4">
                <!-- In a real implementation, we would fetch related products from the database -->
                <!-- For now, we'll just show some dummy related products -->
                @for($i = 0; $i < 3; $i++)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ ($i + 1) * 100 }}">
                        <div class="card h-100 border-0 shadow-sm product-card">
                            <div class="position-relative">
                                <img src="https://via.placeholder.com/300x200?text=Related+Product+{{ $i + 1 }}" class="card-img-top" alt="Related Product {{ $i + 1 }}">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Related Product {{ $i + 1 }}</h5>
                                <p class="card-text flex-grow-1">This is a related product that complements {{ $product['name'] }}.</p>
                                <a href="#" class="btn btn-outline-primary mt-3">
                                    <i class="fas fa-info-circle me-2"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <h2 class="mb-4">Need More Information?</h2>
                    <p class="lead mb-4">Contact our team for more information about our products and how they can benefit your organization.</p>
                    <a href="{{ route('contact.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-envelope me-2"></i> Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .product-category {
        display: inline-block;
        background-color: var(--primary-color);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .feature-icon {
        font-size: 1.5rem;
    }
    
    .product-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection
