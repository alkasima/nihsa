@extends('layouts.app')

@section('title', 'About Us - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">About NIHSA</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Who We Are Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="mb-4">Who We Are</h2>
                    <p class="lead">
                        The Nigeria Hydrological Services Agency was established by the NIHSA Act 2010 and signed into law by Mr. President on 27th August, 2010. The Act is published in the Official Gazette of the Federal Government of Nigeria No 100, Vol. 97 of 31st August, 2010.
                        The Agency came into being as a result of the transformation of the former Department of Hydrology and Hydrogeology of the Federal Ministry of Water Resources. It has the statutory responsibility for water resources assessment in terms of quantity, quality, occurrence and availability in time and space. This leads to generation of hydrological and hydrogeological parametric data needed for the implementation of programs and execution of projects relating to water resources development such as construction of boreholes, dams, weirs, for water supply, irrigation, power generation, mining, agriculture, etc.
                        NIHSA is now fully established via the Establishment Act of 2010 Vol. 97 No. 100 to, among other functions, advise the general public, policy and decision makers and the stakeholders both in Government, public and the private sectors on all aspects of hydrology, provide hydrological services in operational hydrology and water resources activities and work with other sister Agencies to issue forecasts on floods, droughts, etc.

                    </p>
                    
                    
                    <h3 class="mt-5 mb-4">Mandate</h3>
                    <ul>
                        <li>To provide services required for assessment of the nation's surface and groundwater resources in terms of quantity, quality, distribution and availability in time and space; for efficient and sustainable management of the resource.</li>
                        <li>To operate and maintain hydrological stations nationwide and carry out groundwater exploration and monitoring using various scientific techniques in order to provide hydrological and hydrogeological data needed for planning, design, execution and management of water resources and allied projects</li>
                    </ul>
                    
                    <h3 class="mt-5 mb-4">Vision</h3>
                    <p>To create a dynamic and advanced hydrological service with capabilities of facilitating and supporting the harnessing, controlling, preserving, developing and managing Nigeria's valuable water resources in a sustainable manner</p>
                    
                    <h3 class="mt-5 mb-4">Mission</h3>
                    <p>To provide information on the status and trends of the nation's water resources including its location in time and space, extent, dependability, quality and the possibilities of its utilization and control, through the provision of reliable and high quality hydrological and hydrogeological data on a continuous basis</p>
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
