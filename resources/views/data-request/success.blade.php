@extends('layouts.app')

@section('title', 'Request Submitted - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Success Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success fa-5x"></i>
                    </div>
                    <h1 class="mb-4">Request Submitted Successfully!</h1>
                    <p class="lead mb-4">Thank you for submitting your data request. We have received your request and will process it as soon as possible.</p>
                    <p class="mb-5">You will receive an email notification once your request has been processed. If you have any questions, please contact our support team.</p>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('home') }}" class="btn btn-primary">Return to Homepage</a>
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- What's Next Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-center mb-5">What Happens Next?</h2>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px;">
                                        <i class="fas fa-clipboard-check fa-2x"></i>
                                    </div>
                                    <h5 class="card-title">Review</h5>
                                    <p class="card-text">Our team will review your request to ensure we can provide the data you need.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px;">
                                        <i class="fas fa-envelope fa-2x"></i>
                                    </div>
                                    <h5 class="card-title">Notification</h5>
                                    <p class="card-text">You'll receive an email notification about the status of your request.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px;">
                                        <i class="fas fa-database fa-2x"></i>
                                    </div>
                                    <h5 class="card-title">Delivery</h5>
                                    <p class="card-text">If approved, the requested data will be delivered to you via email or download link.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
