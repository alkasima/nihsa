@extends('layouts.app')

@section('title', $service['name'] . ' - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Breadcrumb -->
    <section class="py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $service['name'] }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Service Detail Hero Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <div class="service-category mb-2">{{ $service['category'] }}</div>
                    <h1 class="display-5 fw-bold mb-4">{{ $service['name'] }}</h1>
                    <p class="lead mb-4">{{ $service['description'] }}</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="{{ route('contact.index') }}" class="btn btn-primary btn-lg px-4 me-md-2">
                            <i class="fas fa-envelope me-2"></i> Request This Service
                        </a>
                        <a href="#service-benefits" class="btn btn-outline-secondary btn-lg px-4">
                            <i class="fas fa-arrow-down me-2"></i> Learn More
                        </a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card border-0 shadow-lg service-icon-large">
                        <div class="card-body text-center py-5">
                            <i class="{{ $service['icon'] }}"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Benefits Section -->
    <section id="service-benefits" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Benefits</h2>
            <div class="row g-4">
                @foreach($service['benefits'] as $benefit)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="card h-100 border-0 shadow-sm benefit-card">
                            <div class="card-body">
                                <div class="benefit-icon mb-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h5 class="card-title">{{ $benefit }}</h5>
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
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Our Process</h2>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="timeline" data-aos="fade-up">
                        @foreach($service['process'] as $step)
                            <div class="timeline-item">
                                <div class="timeline-dot">
                                    <span>{{ $loop->iteration }}</span>
                                </div>
                                <div class="timeline-content">
                                    <h4>Step {{ $loop->iteration }}</h4>
                                    <p>{{ $step }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Frequently Asked Questions</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="faqAccordion" data-aos="fade-up">
                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="faqHeading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                    How can I request this service?
                                </button>
                            </h2>
                            <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can request this service by filling out our contact form or sending an email to info@nihsa.gov.ng. Our team will get back to you within 24-48 hours to discuss your specific requirements.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="faqHeading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                    How long does it take to deliver this service?
                                </button>
                            </h2>
                            <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    The delivery time depends on the scope and complexity of your requirements. Typically, our services are delivered within 2-4 weeks after the initial consultation and assessment.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="faqHeading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                    Is there a fee for this service?
                                </button>
                            </h2>
                            <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Some of our services are provided free of charge to government agencies and for public interest purposes. However, specialized services may incur a fee. Please contact us for specific pricing information based on your requirements.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Services Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Related Services</h2>
            <div class="row g-4">
                <!-- In a real implementation, we would fetch related services from the database -->
                <!-- For now, we'll just show some dummy related services -->
                @for($i = 0; $i < 3; $i++)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ ($i + 1) * 100 }}">
                        <div class="card h-100 border-0 shadow-sm service-card">
                            <div class="card-body text-center">
                                <div class="service-icon mb-4">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <h5 class="card-title">Related Service {{ $i + 1 }}</h5>
                                <p class="card-text">This is a related service that complements {{ $service['name'] }}.</p>
                                <a href="#" class="btn btn-outline-primary mt-3">
                                    <i class="fas fa-info-circle me-2"></i> Learn More
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
                    <h2 class="mb-4">Ready to Get Started?</h2>
                    <p class="lead mb-4">Contact our team to discuss how our {{ $service['name'] }} service can benefit your organization.</p>
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
    .service-category {
        display: inline-block;
        background-color: var(--primary-color);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .service-icon-large {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .service-icon-large i {
        font-size: 8rem;
        color: var(--primary-color);
    }
    
    .benefit-card {
        transition: all 0.3s ease;
        border-radius: 10px;
    }
    
    .benefit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .benefit-icon {
        font-size: 1.5rem;
        color: var(--primary-color);
    }
    
    .timeline {
        position: relative;
        padding: 0;
        list-style: none;
        margin: 0;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50px;
        width: 3px;
        background: linear-gradient(to bottom, var(--primary-color), var(--accent-color));
        margin-left: -1.5px;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 50px;
        padding-left: 100px;
    }
    
    .timeline-item:last-child {
        margin-bottom: 0;
    }
    
    .timeline-dot {
        position: absolute;
        left: 50px;
        width: 50px;
        height: 50px;
        margin-left: -25px;
        background: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.25rem;
    }
    
    .timeline-content {
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
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
    
    .accordion-button:not(.collapsed) {
        background-color: var(--primary-color);
        color: white;
    }
    
    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 86, 179, 0.25);
    }
</style>
@endsection
