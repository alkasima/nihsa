@extends('layouts.app')

@section('title', 'Request Submitted - Nigeria Hydrological Services Agency')

@section('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #0056b3 0%, #004494 100%);
        --secondary-gradient: linear-gradient(135deg, #28a745 0%, #218838 100%);
        --accent-gradient: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        --success-gradient: linear-gradient(135deg, #28a745 0%, #218838 100%);
        --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.1);
        --shadow-medium: 0 5px 20px rgba(0, 0, 0, 0.15);
        --shadow-heavy: 0 10px 40px rgba(0, 0, 0, 0.2);
        --border-radius: 20px;
        --border-radius-sm: 15px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .success-hero {
        background: var(--success-gradient);
        color: white;
        position: relative;
        overflow: hidden;
        min-height: 400px;
        display: flex;
        align-items: center;
    }

    .success-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
        opacity: 0.5;
    }

    .success-hero::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .success-hero .hero-content {
        position: relative;
        z-index: 2;
    }

    .success-icon {
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        color: white;
        font-size: 3rem;
        position: relative;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .success-card {
        background: white;
        border-radius: var(--border-radius-sm);
        box-shadow: var(--shadow-medium);
        border: none;
        overflow: hidden;
        position: relative;
        transform: translateZ(0);
    }

    .success-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--success-gradient);
    }

    .btn-primary-custom {
        background: var(--primary-gradient);
        border: none;
        border-radius: 25px;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        font-weight: 600;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-primary-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-primary-custom:hover::before {
        left: 100%;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 25px rgba(0, 86, 179, 0.4);
    }

    .btn-outline-custom {
        background: transparent;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        border-radius: 25px;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        font-weight: 600;
        transition: var(--transition);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-outline-custom:hover {
        background: var(--primary-gradient);
        border-color: transparent;
        color: white;
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 25px rgba(0, 86, 179, 0.3);
    }

    .process-card {
        background: white;
        border-radius: var(--border-radius-sm);
        box-shadow: var(--shadow-light);
        border: none;
        transition: var(--transition);
        overflow: hidden;
        height: 100%;
    }

    .process-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-medium);
    }

    .process-icon {
        width: 60px;
        height: 60px;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.5rem;
    }

    .section-title {
        color: var(--primary-color);
        font-weight: 700;
        position: relative;
        margin-bottom: 2rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, var(--primary-color), #004494);
        border-radius: 2px;
    }

    .success-message {
        background: rgba(40, 167, 69, 0.1);
        border: 1px solid rgba(40, 167, 69, 0.2);
        border-radius: 10px;
        padding: 1.5rem;
        margin: 2rem 0;
    }

    .success-message i {
        color: #28a745;
        margin-right: 0.5rem;
    }

    @media (max-width: 768px) {
        .success-hero {
            padding: 3rem 0;
            text-align: center;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }

        .btn-primary-custom, .btn-outline-custom {
            padding: 0.6rem 1.5rem;
            font-size: 0.9rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <section class="py-3 bg-light border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-request.create') }}">Data Request</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Success</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Success Hero Section -->
    <section class="success-hero py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="hero-content">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h1 class="display-4 fw-bold mb-4">Request Submitted Successfully!</h1>
                        <p class="lead mb-4">Thank you for submitting your data request. We have received your request and will process it as soon as possible.</p>

                        <div class="success-message">
                            <i class="fas fa-info-circle"></i>
                            <strong>Next Steps:</strong> You will receive an email notification once your request has been processed. If you have any questions, please contact our support team.
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary-custom">
                                <i class="fas fa-home me-2"></i>Return to Homepage
                            </a>
                            <a href="{{ route('contact.index') }}" class="btn btn-outline-custom">
                                <i class="fas fa-phone me-2"></i>Contact Us
                            </a>
                        </div>
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
                    <h2 class="section-title text-center mb-4">What Happens Next?</h2>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="process-card card h-100">
                                <div class="card-body text-center p-4">
                                    <div class="process-icon">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <h5 class="card-title">Review</h5>
                                    <p class="card-text">Our team will review your request to ensure we can provide the data you need.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="process-card card h-100">
                                <div class="card-body text-center p-4">
                                    <div class="process-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <h5 class="card-title">Notification</h5>
                                    <p class="card-text">You'll receive an email notification about the status of your request.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="process-card card h-100">
                                <div class="card-body text-center p-4">
                                    <div class="process-icon">
                                        <i class="fas fa-database"></i>
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
