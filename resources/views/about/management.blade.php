@extends('layouts.app')

@section('title', 'Management - Nigeria Hydrological Services Agency')

@section('styles')
<style>
    /* Custom styles for responsive management page */
    .management-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }

    .management-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }

    .staff-image {
        border: 4px solid #f8f9fa;
        transition: border-color 0.3s ease;
    }

    .management-card:hover .staff-image {
        border-color: var(--primary-color);
    }

    .director-general-image {
        border: 4px solid var(--primary-color);
        box-shadow: 0 4px 15px rgba(0, 86, 179, 0.2);
    }

    .table-responsive {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }

    .table th {
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        text-align: center;
        vertical-align: middle;
        padding: 1rem 0.5rem;
        font-size: 0.9rem;
        border: none;
    }

    .table td {
        padding: 0.75rem 0.5rem;
        vertical-align: middle;
        font-size: 0.85rem;
        border: 1px solid #dee2e6;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .table tbody tr:hover {
        background-color: rgba(0, 86, 179, 0.05);
    }

    /* Mobile responsive improvements */
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem !important;
        }

        .staff-image {
            width: 120px !important;
            height: 120px !important;
        }

        .director-general-image {
            width: 200px !important;
            height: auto !important;
        }

        .table th,
        .table td {
            padding: 0.5rem 0.25rem;
            font-size: 0.8rem;
        }

        .table th {
            font-size: 0.75rem;
            padding: 0.75rem 0.25rem;
        }

        .h4 {
            font-size: 1.1rem;
        }
    }

    /* Enhanced typography */
    .lead {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #495057;
    }

    .text-primary {
        color: var(--primary-color) !important;
    }

    /* CTA section improvements */
    .btn-outline-primary {
        border-width: 2px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 86, 179, 0.2);
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('about') }}">About Us</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Management</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Director General Section -->
    <section class="py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm mb-5">
                        <div class="card-body p-3 p-md-4">
                            <div class="row">
                                <div class="col-md-4 mb-4 mb-md-0 text-center">
                                    <img src="https://via.placeholder.com/300x400?text=Director+General" alt="Director General" class="img-fluid rounded director-general-image" style="max-width: 250px; height: auto;">
                                </div>
                                <div class="col-md-8">
                                    <h2 class="mb-3">Engr. John Doe</h2>
                                    <p class="lead text-primary mb-3">Director General / Chief Executive Officer</p>
                                    
                                    <p>Engr. John Doe is the Director General and Chief Executive Officer of the Nigeria Hydrological Services Agency (NIHSA). He was appointed to this position in January 2023.</p>
                                    
                                    <p>With over 25 years of experience in water resources management and hydrology, Engr. Doe has made significant contributions to the development of hydrological services in Nigeria. He holds a Ph.D. in Water Resources Engineering from the University of Lagos and is a Fellow of the Nigerian Society of Engineers.</p>
                                    
                                    <p>Prior to his appointment as Director General, he served as the Director of Hydrogeology at NIHSA and has represented Nigeria in various international forums on water resources management.</p>
                                    
                                    <p>Under his leadership, NIHSA has strengthened its flood forecasting capabilities and expanded its network of hydrological stations across the country.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Management Team Section -->
    <section class="py-5 bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-5">Management Team</h2>

                    <div class="row g-4">
                        <!-- Director of Engineering Hydrology -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm management-card">
                                <div class="card-body p-3 p-md-4">
                                    <div class="text-center mb-3">
                                        <img src="https://via.placeholder.com/150x150?text=Director" alt="Director of Engineering Hydrology" class="rounded-circle staff-image" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <h3 class="h4 text-center mb-2">Engr. Jane Smith</h3>
                                    <p class="text-primary text-center mb-3">Director of Engineering Hydrology</p>
                                    <p>Engr. Jane Smith oversees the Engineering Hydrology Department, responsible for surface water assessment, flood forecasting, and hydrological modeling. She has over 20 years of experience in hydrology and water resources engineering.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Director of Hydrogeology -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm management-card">
                                <div class="card-body p-3 p-md-4">
                                    <div class="text-center mb-3">
                                        <img src="https://via.placeholder.com/150x150?text=Director" alt="Director of Hydrogeology" class="rounded-circle staff-image" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <h3 class="h4 text-center mb-2">Dr. Michael Johnson</h3>
                                    <p class="text-primary text-center mb-3">Director of Hydrogeology</p>
                                    <p>Dr. Michael Johnson leads the Hydrogeology Department, focusing on groundwater assessment, aquifer mapping, and groundwater monitoring. He holds a Ph.D. in Hydrogeology and has published numerous research papers on groundwater resources in Nigeria.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Director of Operational Hydrology -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm management-card">
                                <div class="card-body p-3 p-md-4">
                                    <div class="text-center mb-3">
                                        <img src="https://via.placeholder.com/150x150?text=Director" alt="Director of Operational Hydrology" class="rounded-circle staff-image" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <h3 class="h4 text-center mb-2">Engr. David Williams</h3>
                                    <p class="text-primary text-center mb-3">Director of Operational Hydrology</p>
                                    <p>Engr. David Williams heads the Operational Hydrology Department, responsible for the operation and maintenance of hydrological stations nationwide. He has extensive experience in hydrological data collection and management.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Director of Planning, Research and Forecasting -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm management-card">
                                <div class="card-body p-3 p-md-4">
                                    <div class="text-center mb-3">
                                        <img src="https://via.placeholder.com/150x150?text=Director" alt="Director of Planning, Research and Forecasting" class="rounded-circle staff-image" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <h3 class="h4 text-center mb-2">Dr. Sarah Brown</h3>
                                    <p class="text-primary text-center mb-3">Director of Planning, Research and Forecasting</p>
                                    <p>Dr. Sarah Brown leads the Planning, Research and Forecasting Department, focusing on hydrological research, flood forecasting models, and strategic planning. She has a strong background in hydrological modeling and climate change impacts on water resources.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Director of Finance and Administration -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm management-card">
                                <div class="card-body p-3 p-md-4">
                                    <div class="text-center mb-3">
                                        <img src="https://via.placeholder.com/150x150?text=Director" alt="Director of Finance and Administration" class="rounded-circle staff-image" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <h3 class="h4 text-center mb-2">Mr. Robert Davis</h3>
                                    <p class="text-primary text-center mb-3">Director of Finance and Administration</p>
                                    <p>Mr. Robert Davis oversees the Finance and Administration Department, responsible for financial management, human resources, and administrative services. He has extensive experience in public sector financial management and administration.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Director of Information and Communication Technology -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm management-card">
                                <div class="card-body p-3 p-md-4">
                                    <div class="text-center mb-3">
                                        <img src="https://via.placeholder.com/150x150?text=Director" alt="Director of Information and Communication Technology" class="rounded-circle staff-image" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <h3 class="h4 text-center mb-2">Engr. James Wilson</h3>
                                    <p class="text-primary text-center mb-3">Director of Information and Communication Technology</p>
                                    <p>Engr. James Wilson leads the Information and Communication Technology Department, responsible for the development and maintenance of the agency's IT infrastructure, database management, and digital services. He has a strong background in information systems and data management.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Governing Board Section -->
    <section class="py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-5">Governing Board</h2>

                    <div class="card shadow-sm">
                        <div class="card-body p-3 p-md-4">
                            <p class="lead text-center mb-4">The Nigeria Hydrological Services Agency (NIHSA) is governed by a Board appointed by the President of the Federal Republic of Nigeria.</p>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped w-100">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Position</th>
                                            <th class="text-center">Representing</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><strong>Prof. Samuel Johnson</strong></td>
                                            <td class="text-center"><strong>Chairman</strong></td>
                                            <td class="text-center">Appointed by the President</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>Engr. John Doe</strong></td>
                                            <td class="text-center"><strong>Member/Director General</strong></td>
                                            <td class="text-center">NIHSA</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>Mrs. Elizabeth Taylor</strong></td>
                                            <td class="text-center"><strong>Member</strong></td>
                                            <td class="text-center">Federal Ministry of Water Resources</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>Dr. Richard Brown</strong></td>
                                            <td class="text-center"><strong>Member</strong></td>
                                            <td class="text-center">Federal Ministry of Environment</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>Engr. Patricia White</strong></td>
                                            <td class="text-center"><strong>Member</strong></td>
                                            <td class="text-center">Federal Ministry of Agriculture</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>Mr. Thomas Green</strong></td>
                                            <td class="text-center"><strong>Member</strong></td>
                                            <td class="text-center">Federal Ministry of Science and Technology</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>Dr. Helen Black</strong></td>
                                            <td class="text-center"><strong>Member</strong></td>
                                            <td class="text-center">Nigerian Meteorological Agency (NiMet)</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>Prof. Charles Gray</strong></td>
                                            <td class="text-center"><strong>Member</strong></td>
                                            <td class="text-center">Academia</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>Engr. Mary Blue</strong></td>
                                            <td class="text-center"><strong>Member</strong></td>
                                            <td class="text-center">Private Sector</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <p class="mt-4">The Board provides policy direction and oversight for the Agency, ensuring that it fulfills its mandate effectively and efficiently.</p>
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
                <div class="col-12 text-center">
                    <h3 class="mb-4">Learn More About NIHSA</h3>
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-4">
                            <a href="{{ route('about.functions') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-tasks me-2"></i> Functions of The Agency
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('about.structure') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-sitemap me-2"></i> Organisational Structure
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('about.offices') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-building me-2"></i> Area and Field Offices
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
