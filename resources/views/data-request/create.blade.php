@extends('layouts.app')

@section('title', 'Request Data - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">Request Hydrological Data</h1>
                    <p class="lead">Fill out the form below to request hydrological data for research, planning, or other purposes.</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Request</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <form action="{{ route('data-request.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="name" class="form-label">Your Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="data_type" class="form-label">Type of Data Requested <span class="text-danger">*</span></label>
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
                                    <label for="description" class="form-label">Detailed Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                                    <div class="form-text">Please provide specific details about the data you are requesting, including location, time period, and purpose of use.</div>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">terms and conditions</a> for data usage.
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Information Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="mb-4">Data Request Information</h2>
                    <div class="accordion" id="dataRequestInfo">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How long does it take to process a data request?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#dataRequestInfo">
                                <div class="accordion-body">
                                    Data requests are typically processed within 5-7 working days. Complex requests may take longer. You will receive an email notification once your request has been processed.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Is there a fee for requesting data?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#dataRequestInfo">
                                <div class="accordion-body">
                                    Some data requests may incur a fee, especially for commercial use or large datasets. The fee structure will be communicated to you after your request has been reviewed. Data for academic research may be provided at a reduced cost or free of charge.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    What formats are available for data delivery?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#dataRequestInfo">
                                <div class="accordion-body">
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
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions for Data Usage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>1. Data Usage</h6>
                    <p>The data provided by the Nigeria Hydrological Services Agency (NIHSA) is for the specific purpose stated in your request. Any use beyond this purpose requires additional permission.</p>
                    
                    <h6>2. Attribution</h6>
                    <p>Users must acknowledge NIHSA as the source of the data in any publications, reports, or presentations that use the data.</p>
                    
                    <h6>3. Data Sharing</h6>
                    <p>The data should not be redistributed, sold, or shared with third parties without explicit permission from NIHSA.</p>
                    
                    <h6>4. Disclaimer</h6>
                    <p>NIHSA provides the data "as is" without warranty of any kind, express or implied. NIHSA does not guarantee the accuracy, completeness, or reliability of the data.</p>
                    
                    <h6>5. Liability</h6>
                    <p>NIHSA shall not be liable for any damages arising from the use of the data.</p>
                    
                    <h6>6. Compliance with Laws</h6>
                    <p>Users must comply with all applicable laws and regulations in the use of the data.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
                </div>
            </div>
        </div>
    </div>
@endsection
