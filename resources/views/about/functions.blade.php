@extends('layouts.app')

@section('title', 'Functions of The Agency - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">Functions of The Agency</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('about') }}">About Us</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Functions of The Agency</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Functions Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="mb-4">Core Functions of NIHSA</h2>
                            
                            <p>Nigeria Hydrological Services Agency's primary function is to provide data/information on the locations of water resources in time and space, their extent, dependability, quality and the possibilities of their utilization and control on a continuous basis. 
                            Such information is provided through the following activities:</p>
                            
                            <div class="mt-4">
                                <ul class="mb-4">
                                    <li>Assessment of Water resources both surface and groundwater</li>
                                    <li>Providing information for planning, design and operation of water projects and other facilities or non-water projects consuming water</li>
                                    <li>Monitoring the impact of non-water sector activities on water resources</li>
                                    <li>Providing security for life and property against water related hazards such as floods and drought, through forecasting and related activities</li>
                                    <li>Providing information and management of trans-boundary water bodies</li>
                                    <li>Operation and maintenance of hydrological stations nation-wide for gauging of surface water points</li>
                                    <li>Groundwater exploration and monitoring</li>
                                    <li>Hydrogeoinformatics, Special Investigation and Information Dissemination</li>
                                    
                                </ul>
                                
                                
                            </div>
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
                            <a href="{{ route('about.management') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-users me-2"></i> Management
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
