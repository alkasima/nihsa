@extends('layouts.app')

@section('title', 'Contact Us - Nigeria Hydrological Services Agency')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        #map {
            height: 500px;
            width: 100%;
            border-radius: 8px;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">Get In Touch</h1>
                    <p class="lead">We're here to help and answer any questions you might have</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h2 class="h4 mb-4">Headquarters</h2>
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-primary fa-2x me-3"></i>
                                </div>
                                <div>
                                    <h5 class="h6 mb-1">Address</h5>
                                    <p class="mb-0">Plot 222, Foundation Plaza,<br>Shettima Ali Monguno Crescent,<br>Utako, Abuja, Nigeria</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-phone text-primary fa-2x me-3"></i>
                                </div>
                                <div>
                                    <h5 class="h6 mb-1">Phone</h5>
                                    <p class="mb-0">+234 801 234 5678</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-envelope text-primary fa-2x me-3"></i>
                                </div>
                                <div>
                                    <h5 class="h6 mb-1">Email</h5>
                                    <p class="mb-0">info@nihsa.gov.ng</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-clock text-primary fa-2x me-3"></i>
                                </div>
                                <div>
                                    <h5 class="h6 mb-1">Office Hours</h5>
                                    <p class="mb-0">Monday - Friday: 8:00 AM - 4:00 PM<br>Saturday - Sunday: Closed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="h4 mb-4">Send Us a Message</h2>
                            
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your Name" value="{{ old('name') }}" required>
                                            <label for="name">Your Name</label>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
                                            <label for="email">Your Email</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
                                            <label for="subject">Subject</label>
                                            @error('subject')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" placeholder="Your Message" style="height: 150px" required>{{ old('message') }}</textarea>
                                            <label for="message">Your Message</label>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4 text-center">
                    <h2>Our Locations</h2>
                    <p class="lead">NIHSA has zonal offices across Nigeria to serve you better</p>
                </div>
                
                <div class="col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Zonal Offices Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4 text-center">
                    <h2>Zonal Offices</h2>
                    <p class="lead">Contact our zonal offices for regional inquiries</p>
                </div>
                
                <div class="col-12">
                    <div class="row g-4">
                        @foreach($zonalOffices as $office)
                            @if($office['id'] != 1) {{-- Skip headquarters as it's already shown above --}}
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body">
                                            <h3 class="h5 mb-3">{{ $office['name'] }}</h3>
                                            <p class="mb-1"><i class="fas fa-map-marker-alt text-primary me-2"></i> {{ $office['address'] }}</p>
                                            <p class="mb-1"><i class="fas fa-phone text-primary me-2"></i> {{ $office['phone'] }}</p>
                                            <p class="mb-1"><i class="fas fa-envelope text-primary me-2"></i> {{ $office['email'] }}</p>
                                            <p class="mb-0"><i class="fas fa-globe text-primary me-2"></i> States covered: {{ $office['states_covered'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-center mb-4">Frequently Asked Questions</h2>
                    
                    <div class="accordion" id="contactFaq">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How can I request hydrological data?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#contactFaq">
                                <div class="accordion-body">
                                    You can request hydrological data by filling out our <a href="{{ route('data-request.create') }}">data request form</a>. Please provide specific details about the data you need, including location, time period, and purpose of use.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How can I report a flood in my area?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#contactFaq">
                                <div class="accordion-body">
                                    To report a flood in your area, please contact our emergency hotline at +234 800 FLOOD HELP (800 356 6343) or send an email to emergencies@nihsa.gov.ng with details about the location and severity of the flooding.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How can I subscribe to flood alerts?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#contactFaq">
                                <div class="accordion-body">
                                    You can subscribe to our flood alerts by filling out the subscription form on our homepage or by sending an email to alerts@nihsa.gov.ng with your name, location, and contact information.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    How can I arrange a visit to NIHSA?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#contactFaq">
                                <div class="accordion-body">
                                    To arrange a visit to NIHSA, please send an email to visits@nihsa.gov.ng with your preferred date, time, purpose of visit, and number of visitors. We require at least one week's notice for all visits.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the map
            var map = L.map('map').setView([9.0820, 8.6753], 6); // Nigeria's coordinates
            
            // Add the OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
            }).addTo(map);
            
            // Add markers for each zonal office
            var offices = @json($zonalOffices);
            
            offices.forEach(function(office) {
                var marker = L.marker([office.latitude, office.longitude]).addTo(map);
                
                marker.bindPopup(
                    '<strong>' + office.name + '</strong><br>' +
                    office.address + '<br>' +
                    'Phone: ' + office.phone + '<br>' +
                    'Email: ' + office.email
                );
            });
        });
    </script>
@endsection
