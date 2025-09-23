@extends('layouts.app')

@section('title', 'Area and Field Offices - Nigeria Hydrological Services Agency')

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
                    <h1 class="mb-4">Area and Field Offices</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('about') }}">About Us</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Area and Field Offices</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card shadow-sm mb-5">
                        <div class="card-body p-4">
                            <h2 class="mb-4 text-center">NIHSA Offices Across Nigeria</h2>
                            
                            <p class="lead text-center mb-4">The Nigeria Hydrological Services Agency (NIHSA) has offices across the country to ensure effective coverage and service delivery.</p>
                            
                            <div id="map" class="mb-4"></div>
                            
                            <p class="text-center">Click on the markers to view office details.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Zonal Offices Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h2 class="text-center mb-5">Zonal Offices</h2>
                    
                    <div class="row g-4">
                        <!-- Headquarters -->
                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="h5 mb-0">Headquarters</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>Location:</strong> Abuja</p>
                                    <p><strong>Address:</strong> Plot 222, Foundation Plaza, Shettima Ali Monguno Crescent, Utako, Abuja, Nigeria</p>
                                    <p><strong>Phone:</strong> +234 801 234 5678</p>
                                    <p><strong>Email:</strong> info@nihsa.gov.ng</p>
                                    <p><strong>States Covered:</strong> Federal Capital Territory</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- North Central Zonal Office -->
                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="h5 mb-0">North Central Zonal Office</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>Location:</strong> Jos</p>
                                    <p><strong>Address:</strong> 123 Plateau Road, Jos, Plateau State, Nigeria</p>
                                    <p><strong>Phone:</strong> +234 802 345 6789</p>
                                    <p><strong>Email:</strong> northcentral@nihsa.gov.ng</p>
                                    <p><strong>States Covered:</strong> Plateau, Nasarawa, Benue, Kogi, Niger, Kwara</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- North East Zonal Office -->
                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="h5 mb-0">North East Zonal Office</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>Location:</strong> Maiduguri</p>
                                    <p><strong>Address:</strong> 456 Borno Way, Maiduguri, Borno State, Nigeria</p>
                                    <p><strong>Phone:</strong> +234 803 456 7890</p>
                                    <p><strong>Email:</strong> northeast@nihsa.gov.ng</p>
                                    <p><strong>States Covered:</strong> Borno, Yobe, Adamawa, Taraba, Gombe, Bauchi</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- North West Zonal Office -->
                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="h5 mb-0">North West Zonal Office</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>Location:</strong> Kano</p>
                                    <p><strong>Address:</strong> 789 Kano Road, Kano, Kano State, Nigeria</p>
                                    <p><strong>Phone:</strong> +234 804 567 8901</p>
                                    <p><strong>Email:</strong> northwest@nihsa.gov.ng</p>
                                    <p><strong>States Covered:</strong> Kano, Kaduna, Katsina, Jigawa, Sokoto, Zamfara, Kebbi</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- South East Zonal Office -->
                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="h5 mb-0">South East Zonal Office</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>Location:</strong> Enugu</p>
                                    <p><strong>Address:</strong> 101 Enugu Street, Enugu, Enugu State, Nigeria</p>
                                    <p><strong>Phone:</strong> +234 805 678 9012</p>
                                    <p><strong>Email:</strong> southeast@nihsa.gov.ng</p>
                                    <p><strong>States Covered:</strong> Enugu, Anambra, Imo, Abia, Ebonyi</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- South South Zonal Office -->
                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="h5 mb-0">South South Zonal Office</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>Location:</strong> Port Harcourt</p>
                                    <p><strong>Address:</strong> 202 Rivers Road, Port Harcourt, Rivers State, Nigeria</p>
                                    <p><strong>Phone:</strong> +234 806 789 0123</p>
                                    <p><strong>Email:</strong> southsouth@nihsa.gov.ng</p>
                                    <p><strong>States Covered:</strong> Rivers, Bayelsa, Delta, Edo, Cross River, Akwa Ibom</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- South West Zonal Office -->
                        <div class="col-md-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="h5 mb-0">South West Zonal Office</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>Location:</strong> Lagos</p>
                                    <p><strong>Address:</strong> 303 Lagos Avenue, Lagos, Lagos State, Nigeria</p>
                                    <p><strong>Phone:</strong> +234 807 890 1234</p>
                                    <p><strong>Email:</strong> southwest@nihsa.gov.ng</p>
                                    <p><strong>States Covered:</strong> Lagos, Ogun, Oyo, Osun, Ondo, Ekiti</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Field Offices Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h2 class="text-center mb-5">Field Offices</h2>
                    
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <p class="lead text-center mb-4">NIHSA has field offices at strategic locations across the country, particularly at major river basins and groundwater provinces, to facilitate data collection and monitoring activities.</p>
                            
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Location</th>
                                            <th>State</th>
                                            <th>Zone</th>
                                            <th>Focus Area</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Lokoja</td>
                                            <td>Kogi</td>
                                            <td>North Central</td>
                                            <td>Niger-Benue Confluence Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Makurdi</td>
                                            <td>Benue</td>
                                            <td>North Central</td>
                                            <td>River Benue Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Minna</td>
                                            <td>Niger</td>
                                            <td>North Central</td>
                                            <td>Kaduna River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Ilorin</td>
                                            <td>Kwara</td>
                                            <td>North Central</td>
                                            <td>Niger River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Damaturu</td>
                                            <td>Yobe</td>
                                            <td>North East</td>
                                            <td>Yobe River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Jalingo</td>
                                            <td>Taraba</td>
                                            <td>North East</td>
                                            <td>Benue River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Gombe</td>
                                            <td>Gombe</td>
                                            <td>North East</td>
                                            <td>Gongola River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Kaduna</td>
                                            <td>Kaduna</td>
                                            <td>North West</td>
                                            <td>Kaduna River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Sokoto</td>
                                            <td>Sokoto</td>
                                            <td>North West</td>
                                            <td>Sokoto-Rima River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Katsina</td>
                                            <td>Katsina</td>
                                            <td>North West</td>
                                            <td>Groundwater Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Owerri</td>
                                            <td>Imo</td>
                                            <td>South East</td>
                                            <td>Imo River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Abakaliki</td>
                                            <td>Ebonyi</td>
                                            <td>South East</td>
                                            <td>Cross River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Calabar</td>
                                            <td>Cross River</td>
                                            <td>South South</td>
                                            <td>Cross River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Benin</td>
                                            <td>Edo</td>
                                            <td>South South</td>
                                            <td>Osse-Ossiomo River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Warri</td>
                                            <td>Delta</td>
                                            <td>South South</td>
                                            <td>Niger Delta Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Ibadan</td>
                                            <td>Oyo</td>
                                            <td>South West</td>
                                            <td>Ogun-Osun River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Akure</td>
                                            <td>Ondo</td>
                                            <td>South West</td>
                                            <td>Owena River Basin Monitoring</td>
                                        </tr>
                                        <tr>
                                            <td>Abeokuta</td>
                                            <td>Ogun</td>
                                            <td>South West</td>
                                            <td>Ogun River Basin Monitoring</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <p class="mt-4 text-center">Each field office is equipped with the necessary facilities and equipment for hydrological data collection and monitoring.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h3 class="mb-4">Learn More About NIHSA</h3>
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-4">
                            <a href="{{ route('about.functions') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-tasks me-2"></i> Functions of The Agency
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('about.management') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-users me-2"></i> Management
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('about.structure') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-sitemap me-2"></i> Organisational Structure
                            </a>
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
            
            // Define office locations
            var offices = [
                {
                    name: 'Headquarters',
                    location: 'Abuja',
                    address: 'Plot 222, Foundation Plaza, Shettima Ali Monguno Crescent, Utako, Abuja, Nigeria',
                    phone: '+234 801 234 5678',
                    email: 'info@nihsa.gov.ng',
                    lat: 9.0765,
                    lng: 7.3986,
                    type: 'Headquarters'
                },
                {
                    name: 'North Central Zonal Office',
                    location: 'Jos',
                    address: '123 Plateau Road, Jos, Plateau State, Nigeria',
                    phone: '+234 802 345 6789',
                    email: 'northcentral@nihsa.gov.ng',
                    lat: 9.8965,
                    lng: 8.8583,
                    type: 'Zonal Office'
                },
                {
                    name: 'North East Zonal Office',
                    location: 'Maiduguri',
                    address: '456 Borno Way, Maiduguri, Borno State, Nigeria',
                    phone: '+234 803 456 7890',
                    email: 'northeast@nihsa.gov.ng',
                    lat: 11.8333,
                    lng: 13.1500,
                    type: 'Zonal Office'
                },
                {
                    name: 'North West Zonal Office',
                    location: 'Kano',
                    address: '789 Kano Road, Kano, Kano State, Nigeria',
                    phone: '+234 804 567 8901',
                    email: 'northwest@nihsa.gov.ng',
                    lat: 12.0000,
                    lng: 8.5167,
                    type: 'Zonal Office'
                },
                {
                    name: 'South East Zonal Office',
                    location: 'Enugu',
                    address: '101 Enugu Street, Enugu, Enugu State, Nigeria',
                    phone: '+234 805 678 9012',
                    email: 'southeast@nihsa.gov.ng',
                    lat: 6.4500,
                    lng: 7.5000,
                    type: 'Zonal Office'
                },
                {
                    name: 'South South Zonal Office',
                    location: 'Port Harcourt',
                    address: '202 Rivers Road, Port Harcourt, Rivers State, Nigeria',
                    phone: '+234 806 789 0123',
                    email: 'southsouth@nihsa.gov.ng',
                    lat: 4.8156,
                    lng: 7.0498,
                    type: 'Zonal Office'
                },
                {
                    name: 'South West Zonal Office',
                    location: 'Lagos',
                    address: '303 Lagos Avenue, Lagos, Lagos State, Nigeria',
                    phone: '+234 807 890 1234',
                    email: 'southwest@nihsa.gov.ng',
                    lat: 6.4550,
                    lng: 3.3841,
                    type: 'Zonal Office'
                }
            ];
            
            // Add markers for each office
            offices.forEach(function(office) {
                var markerColor = office.type === 'Headquarters' ? 'red' : 'blue';
                
                var marker = L.marker([office.lat, office.lng]).addTo(map);
                
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
