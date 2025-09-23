@extends('layouts.app')

@section('title', 'Services - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <h1 class="display-5 fw-bold mb-4">Our Services</h1>
                    <p class="lead mb-4">NIHSA provides a wide range of hydrological services to support water resources management, flood forecasting, and disaster preparedness in Nigeria.</p>
                    <p>Our expert team of hydrologists and technicians deliver high-quality services to government agencies, private organizations, communities, and other stakeholders.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <img src="{{ asset('images/services-hero.jpg') }}" alt="NIHSA Services" class="img-fluid" onerror="this.src='https://via.placeholder.com/600x400?text=NIHSA+Services'">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Services Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Our Core Services</h2>
            <div class="row g-4">
                @foreach($featuredServices as $service)
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="card h-100 border-0 shadow-sm service-card">
                            <div class="card-body text-center">
                                <div class="service-icon mb-4">
                                    <i class="{{ $service['icon'] }}"></i>
                                </div>
                                <h5 class="card-title">{{ $service['name'] }}</h5>
                                <p class="card-text">{{ $service['description'] }}</p>
                                <a href="{{ route('services.show', $service['id']) }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-info-circle me-2"></i> Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Services By Category Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Our Service Categories</h2>
            
            <div class="accordion" id="servicesAccordion" data-aos="fade-up">
                @foreach($servicesByCategory as $category => $services)
                    <div class="accordion-item mb-3 border-0 shadow-sm">
                        <h2 class="accordion-header" id="heading{{ Str::slug($category) }}">
                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ Str::slug($category) }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ Str::slug($category) }}">
                                <i class="fas fa-folder me-2"></i> {{ $category }}
                            </button>
                        </h2>
                        <div id="collapse{{ Str::slug($category) }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ Str::slug($category) }}" data-bs-parent="#servicesAccordion">
                            <div class="accordion-body">
                                <div class="row g-4">
                                    @foreach($services as $service)
                                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                                            <div class="card h-100 border-0 shadow-sm service-list-card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="service-list-icon me-3">
                                                            <i class="{{ $service['icon'] }}"></i>
                                                        </div>
                                                        <h5 class="card-title mb-0">{{ $service['name'] }}</h5>
                                                    </div>
                                                    <p class="card-text">{{ $service['description'] }}</p>
                                                    <a href="{{ route('services.show', $service['id']) }}" class="btn btn-sm btn-outline-primary mt-2">
                                                        <i class="fas fa-arrow-right me-1"></i> View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Service Process Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Our Service Process</h2>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="service-process" data-aos="fade-up">
                        <div class="service-process-step">
                            <div class="service-process-icon">
                                <i class="fas fa-comments"></i>
                                <div class="service-process-number">1</div>
                            </div>
                            <h4>Consultation</h4>
                            <p>We discuss your specific needs and requirements to understand how our services can best support your objectives.</p>
                        </div>
                        <div class="service-process-step">
                            <div class="service-process-icon">
                                <i class="fas fa-clipboard-list"></i>
                                <div class="service-process-number">2</div>
                            </div>
                            <h4>Assessment</h4>
                            <p>Our experts assess your requirements and develop a tailored service plan to address your specific needs.</p>
                        </div>
                        <div class="service-process-step">
                            <div class="service-process-icon">
                                <i class="fas fa-cogs"></i>
                                <div class="service-process-number">3</div>
                            </div>
                            <h4>Implementation</h4>
                            <p>We implement the service plan using our expertise, advanced tools, and methodologies to deliver high-quality results.</p>
                        </div>
                        <div class="service-process-step">
                            <div class="service-process-icon">
                                <i class="fas fa-chart-line"></i>
                                <div class="service-process-number">4</div>
                            </div>
                            <h4>Delivery & Support</h4>
                            <p>We deliver the final service outputs and provide ongoing support to ensure you get maximum value from our services.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <h2 class="mb-4">Ready to Work With Us?</h2>
                    <p class="lead mb-4">Contact our team to discuss how our hydrological services can support your needs.</p>
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
    .service-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    
    .service-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
        color: white;
        font-size: 2rem;
        border-radius: 50%;
    }
    
    .service-list-card {
        transition: all 0.3s ease;
        border-radius: 10px;
    }
    
    .service-list-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .service-list-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
        color: white;
        font-size: 1.25rem;
        border-radius: 10px;
    }
    
    .accordion-button:not(.collapsed) {
        background-color: var(--primary-color);
        color: white;
    }
    
    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 86, 179, 0.25);
    }
    
    .service-process {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 2rem 0;
    }
    
    .service-process::before {
        content: '';
        position: absolute;
        top: 60px;
        left: 60px;
        right: 60px;
        height: 3px;
        background: linear-gradient(to right, var(--primary-color), var(--accent-color));
        z-index: 0;
    }
    
    .service-process-step {
        flex: 1;
        text-align: center;
        padding: 0 15px;
        position: relative;
        z-index: 1;
    }
    
    .service-process-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        background: white;
        color: var(--primary-color);
        font-size: 2rem;
        border-radius: 50%;
        border: 3px solid var(--primary-color);
        position: relative;
    }
    
    .service-process-number {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 30px;
        height: 30px;
        background: var(--primary-color);
        color: white;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    @media (max-width: 768px) {
        .service-process {
            flex-direction: column;
        }
        
        .service-process::before {
            display: none;
        }
        
        .service-process-step {
            margin-bottom: 2rem;
        }
    }
</style>
@endsection
