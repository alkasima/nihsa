@extends('layouts.app')

@section('title', 'Request Data - Nigeria Hydrological Services Agency')

@section('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #0056b3 0%, #004494 100%);
        --secondary-gradient: linear-gradient(135deg, #28a745 0%, #218838 100%);
        --accent-gradient: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        --warning-gradient: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        --danger-gradient: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.1);
        --shadow-medium: 0 5px 20px rgba(0, 0, 0, 0.15);
        --shadow-heavy: 0 10px 40px rgba(0, 0, 0, 0.2);
        --border-radius: 20px;
        --border-radius-sm: 15px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .data-request-hero {
        background: var(--primary-gradient);
        color: white;
        position: relative;
        overflow: hidden;
        min-height: 400px;
        display: flex;
        align-items: center;
    }

    .data-request-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
        opacity: 0.5;
    }

    .data-request-hero::after {
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

    .data-request-hero .hero-content {
        position: relative;
        z-index: 2;
    }

    .request-form-card {
        background: white;
        border-radius: var(--border-radius-sm);
        box-shadow: var(--shadow-medium);
        border: none;
        overflow: hidden;
        position: relative;
        transform: translateZ(0);
    }

    .request-form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .form-control {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 0.75rem 1rem;
        transition: var(--transition);
        font-size: 1rem;
    }

    .form-control:focus {
        border-color: #0056b3;
        box-shadow: 0 0 0 0.2rem rgba(0, 86, 179, 0.25);
        transform: translateY(-1px);
    }

    .form-select {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 0.75rem 1rem;
        transition: var(--transition);
        font-size: 1rem;
    }

    .form-select:focus {
        border-color: #0056b3;
        box-shadow: 0 0 0 0.2rem rgba(0, 86, 179, 0.25);
        transform: translateY(-1px);
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .required-indicator {
        color: #dc3545;
        font-weight: bold;
    }

    .btn-submit {
        background: var(--primary-gradient);
        border: none;
        border-radius: 25px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        min-height: 50px;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 25px rgba(0, 86, 179, 0.4);
    }

    .info-card {
        background: white;
        border-radius: var(--border-radius-sm);
        box-shadow: var(--shadow-light);
        border: none;
        transition: var(--transition);
        overflow: hidden;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-medium);
    }

    .info-icon {
        width: 60px;
        height: 60px;
        background: var(--accent-gradient);
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

    .accordion-button {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        color: var(--primary-color);
        font-weight: 600;
        border: none;
        border-radius: 10px !important;
        transition: var(--transition);
    }

    .accordion-button:not(.collapsed) {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 2px 10px rgba(0, 86, 179, 0.3);
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 86, 179, 0.25);
    }

    .accordion-item {
        border: none;
        margin-bottom: 1rem;
        border-radius: 10px !important;
        overflow: hidden;
        box-shadow: var(--shadow-light);
    }

    .accordion-body {
        background: white;
        border-radius: 0 0 10px 10px;
        padding: 1.5rem;
    }

    .stats-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 3rem 0;
        margin: 2rem 0;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius-sm);
        padding: 2rem;
        text-align: center;
        box-shadow: var(--shadow-light);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-medium);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #6c757d;
        font-size: 1rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-help-text {
        color: #6c757d;
        font-size: 0.9rem;
        margin-top: 0.5rem;
        line-height: 1.5;
    }

    .modal-content {
        border-radius: var(--border-radius-sm);
        border: none;
        box-shadow: var(--shadow-heavy);
    }

    .modal-header {
        background: var(--primary-gradient);
        color: white;
        border-radius: var(--border-radius-sm) var(--border-radius-sm) 0 0;
        padding: 1.5rem;
    }

    .modal-title {
        font-weight: 700;
    }

    .modal-body {
        padding: 2rem;
        line-height: 1.6;
    }

    .modal-body h6 {
        color: var(--primary-color);
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .modal-body h6:first-child {
        margin-top: 0;
    }

    .modal-footer {
        border-radius: 0 0 var(--border-radius-sm) var(--border-radius-sm);
        padding: 1.5rem;
    }

    @media (max-width: 768px) {
        .data-request-hero {
            padding: 3rem 0;
            text-align: center;
        }

        .stat-card {
            margin-bottom: 1rem;
        }

        .btn-submit {
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
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
                    <li class="breadcrumb-item active" aria-current="page">Data Request</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="data-request-hero py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h1 class="display-4 fw-bold mb-4">Request Hydrological Data</h1>
                        <p class="lead mb-4">Access comprehensive hydrological data for research, planning, and analysis. Submit your request and our team will process it promptly.</p>

                        <!-- Quick Stats -->
                        <div class="row g-4 mt-5">
                            <div class="col-md-4">
                                <div class="stat-card card text-center p-4">
                                    <div class="card-body">
                                        <div class="stat-number">5-7</div>
                                        <p class="stat-label">Days Processing</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card card text-center p-4">
                                    <div class="card-body">
                                        <div class="stat-number">24/7</div>
                                        <p class="stat-label">Support Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card card text-center p-4">
                                    <div class="card-body">
                                        <div class="stat-number">50+</div>
                                        <p class="stat-label">Data Formats</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="info-card card text-center p-4">
                        <div class="card-body">
                            <div class="info-icon">
                                <i class="fas fa-database"></i>
                            </div>
                            <h5 class="card-title mb-3">Comprehensive Data</h5>
                            <p class="card-text text-muted">Access to extensive hydrological datasets covering surface water, groundwater, rainfall, and water quality information.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="request-form-card card">
                        <div class="card-body p-5">
                            <h2 class="section-title mb-4">Submit Your Request</h2>
                            <form action="{{ route('data-request.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="name" class="form-label">
                                            Your Name <span class="required-indicator">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="email" class="form-label">
                                            Email Address <span class="required-indicator">*</span>
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="phone" class="form-label">
                                        Phone Number <span class="required-indicator">*</span>
                                    </label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="data_type" class="form-label">
                                        Type of Data Requested <span class="required-indicator">*</span>
                                    </label>
                                    <select class="form-select @error('data_type') is-invalid @enderror" id="data_type" name="data_type" required>
                                        <option value="" selected disabled>Select data type</option>
                                        <option value="Surface Water Data" {{ old('data_type') == 'Surface Water Data' ? 'selected' : '' }}>Surface Water Data</option>
                                        <option value="Groundwater Data" {{ old('data_type') == 'Groundwater Data' ? 'selected' : '' }}>Groundwater Data</option>
                                        <option value="Rainfall Data" {{ old('data_type') == 'Rainfall Data' ? 'selected' : '' }}>Rainfall Data</option>
                                        <option value="Flood Data" {{ old('data_type') == 'Flood Data' ? 'selected' : '' }}>Flood Data</option>
                                        <option value="Water Quality Data" {{ old('data_type') == 'Water Quality Data' ? 'selected' : '' }}>Water Quality Data</option>
                                        <option value="Other" {{ old('data_type') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('data_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="form-label">
                                        Detailed Description <span class="required-indicator">*</span>
                                    </label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" required>{{ old('description') }}</textarea>
                                    <div class="form-help-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Please provide specific details about the data you are requesting, including location, time period, and purpose of use.
                                    </div>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal" class="text-decoration-underline">terms and conditions</a> for data usage.
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-submit">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Request
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Information Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title mb-4">Data Request Information</h2>
                    <div class="accordion" id="dataRequestInfo">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-clock me-2"></i>How long does it take to process a data request?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#dataRequestInfo">
                                <div class="accordion-body">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    Data requests are typically processed within 5-7 working days. Complex requests may take longer. You will receive an email notification once your request has been processed.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-dollar-sign me-2"></i>Is there a fee for requesting data?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#dataRequestInfo">
                                <div class="accordion-body">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    Some data requests may incur a fee, especially for commercial use or large datasets. The fee structure will be communicated to you after your request has been reviewed. Data for academic research may be provided at a reduced cost or free of charge.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-file-export me-2"></i>What formats are available for data delivery?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#dataRequestInfo">
                                <div class="accordion-body">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    Data can be provided in various formats including CSV, Excel, PDF, or GIS formats (Shapefile, GeoJSON). Please specify your preferred format in the description field.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Terms and Conditions Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">
                        <i class="fas fa-file-contract me-2"></i>Terms and Conditions for Data Usage
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-gavel text-primary me-2"></i>
                            <h6 class="mb-0">1. Data Usage</h6>
                        </div>
                        <p>The data provided by the Nigeria Hydrological Services Agency (NIHSA) is for the specific purpose stated in your request. Any use beyond this purpose requires additional permission.</p>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-quote-right text-primary me-2"></i>
                            <h6 class="mb-0">2. Attribution</h6>
                        </div>
                        <p>Users must acknowledge NIHSA as the source of the data in any publications, reports, or presentations that use the data.</p>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-share-alt text-primary me-2"></i>
                            <h6 class="mb-0">3. Data Sharing</h6>
                        </div>
                        <p>The data should not be redistributed, sold, or shared with third parties without explicit permission from NIHSA.</p>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-exclamation-triangle text-primary me-2"></i>
                            <h6 class="mb-0">4. Disclaimer</h6>
                        </div>
                        <p>NIHSA provides the data "as is" without warranty of any kind, express or implied. NIHSA does not guarantee the accuracy, completeness, or reliability of the data.</p>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-shield-alt text-primary me-2"></i>
                            <h6 class="mb-0">5. Liability</h6>
                        </div>
                        <p>NIHSA shall not be liable for any damages arising from the use of the data.</p>
                    </div>

                    <div class="mb-0">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-balance-scale text-primary me-2"></i>
                            <h6 class="mb-0">6. Compliance with Laws</h6>
                        </div>
                        <p>Users must comply with all applicable laws and regulations in the use of the data.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">
                        <i class="fas fa-check me-2"></i>I Understand
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
