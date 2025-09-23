@extends('layouts.app')

@section('title', 'History - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">History</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('about') }}">About Us</a></li>
                            <li class="breadcrumb-item active" aria-current="page">History</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- History Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="mb-4">History of NIHSA</h2>
                            
                            <p class="lead">The Nigeria Hydrological Services Agency (NIHSA) was established as a response to the growing need for comprehensive hydrological data and services in Nigeria.</p>
                            
                            <div class="mt-5">
                                <h3 class="mb-4">Early Beginnings</h3>
                                
                                <p>Hydrological services in Nigeria date back to the colonial era when basic hydrological data collection was carried out by the Public Works Department (PWD). After independence, these responsibilities were transferred to the Federal Ministry of Works and later to the Federal Ministry of Water Resources.</p>
                                
                                <p>In the 1970s and 1980s, hydrological data collection and management were primarily handled by the Hydrology Division of the Federal Department of Water Resources. This division was responsible for establishing and maintaining hydrological stations across the country and collecting data on surface and groundwater resources.</p>
                                
                                <div class="text-center my-4">
                                    <img src="https://via.placeholder.com/600x400?text=Historical+Photo" alt="Historical Photo of Hydrological Services" class="img-fluid rounded">
                                    <p class="text-muted mt-2">Early hydrological data collection in Nigeria</p>
                                </div>
                                
                                <p>As Nigeria's water resources development expanded, the need for a dedicated agency to provide comprehensive hydrological services became increasingly apparent. This was particularly highlighted by recurring flood events and the challenges of managing transboundary water resources.</p>
                            </div>
                            
                            <div class="mt-5">
                                <h3 class="mb-4">Establishment of NIHSA</h3>
                                
                                <p>The Nigeria Hydrological Services Agency (NIHSA) was established by the NIHSA Establishment Act, which was signed into law by the President of the Federal Republic of Nigeria on the 27th day of August, 2010. The Agency was created as a parastatal under the Federal Ministry of Water Resources.</p>
                                
                                <p>The establishment of NIHSA was a significant milestone in Nigeria's efforts to improve water resources management and mitigate water-related hazards. It represented a recognition of the importance of hydrological data and services for sustainable development and disaster risk reduction.</p>
                                
                                <div class="text-center my-4">
                                    <img src="https://via.placeholder.com/600x400?text=NIHSA+Establishment" alt="NIHSA Establishment" class="img-fluid rounded">
                                    <p class="text-muted mt-2">Signing of the NIHSA Establishment Act, 2010</p>
                                </div>
                                
                                <p>The Agency was mandated to provide services required for assessment of the nation's surface and groundwater resources in terms of quantity, quality, distribution and availability in time and space. It was also tasked with operating and maintaining hydrological stations nationwide and carrying out groundwater exploration and monitoring.</p>
                            </div>
                            
                            <div class="mt-5">
                                <h3 class="mb-4">Growth and Development</h3>
                                
                                <p>Since its establishment, NIHSA has grown significantly in terms of capacity, coverage, and services. The Agency has expanded its network of hydrological stations, improved its data collection and management systems, and enhanced its flood forecasting capabilities.</p>
                                
                                <p>In 2013, NIHSA introduced the Annual Flood Outlook (AFO), a comprehensive forecast of flood scenarios across Nigeria. The AFO has become a key tool for flood management in the country, providing stakeholders with information on potential flood risks and recommendations for mitigation measures.</p>
                                
                                <div class="text-center my-4">
                                    <img src="https://via.placeholder.com/600x400?text=Annual+Flood+Outlook" alt="Annual Flood Outlook Launch" class="img-fluid rounded">
                                    <p class="text-muted mt-2">Launch of the Annual Flood Outlook</p>
                                </div>
                                
                                <p>NIHSA has also strengthened its collaboration with national and international organizations, including the World Meteorological Organization (WMO), the Niger Basin Authority (NBA), and the Lake Chad Basin Commission (LCBC). These partnerships have enhanced the Agency's capacity to provide hydrological services and manage transboundary water resources.</p>
                                
                                <p>In recent years, NIHSA has embraced modern technologies, including remote sensing, geographic information systems (GIS), and advanced hydrological models, to improve its data collection, analysis, and forecasting capabilities. The Agency has also invested in capacity building, training its staff in the latest hydrological techniques and methodologies.</p>
                            </div>
                            
                            <div class="mt-5">
                                <h3 class="mb-4">Recent Developments</h3>
                                
                                <p>In the past decade, NIHSA has continued to evolve and adapt to the changing hydrological landscape in Nigeria. The Agency has expanded its services to include more comprehensive flood forecasting, groundwater assessment, and water resources monitoring.</p>
                                
                                <p>NIHSA has also played a crucial role in Nigeria's response to major flood events, providing early warnings and technical support to affected communities and government agencies. The Agency's flood forecasts have helped to reduce the impact of floods on lives and property.</p>
                                
                                <div class="text-center my-4">
                                    <img src="https://via.placeholder.com/600x400?text=Modern+NIHSA" alt="Modern NIHSA Operations" class="img-fluid rounded">
                                    <p class="text-muted mt-2">Modern hydrological monitoring at NIHSA</p>
                                </div>
                                
                                <p>Today, NIHSA continues to fulfill its mandate of providing hydrological services for sustainable water resources management and development in Nigeria. The Agency remains committed to improving its services and contributing to the nation's efforts to achieve water security and resilience to water-related hazards.</p>
                            </div>
                            
                            <div class="mt-5">
                                <h3 class="mb-4">Timeline of Key Events</h3>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Year</th>
                                                <th>Event</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2010</td>
                                                <td>Establishment of NIHSA through the signing of the NIHSA Establishment Act</td>
                                            </tr>
                                            <tr>
                                                <td>2011</td>
                                                <td>Appointment of the first Director General and management team</td>
                                            </tr>
                                            <tr>
                                                <td>2012</td>
                                                <td>Establishment of zonal offices across the country</td>
                                            </tr>
                                            <tr>
                                                <td>2013</td>
                                                <td>Introduction of the Annual Flood Outlook (AFO)</td>
                                            </tr>
                                            <tr>
                                                <td>2014</td>
                                                <td>Expansion of the hydrological stations network</td>
                                            </tr>
                                            <tr>
                                                <td>2015</td>
                                                <td>Development of the National Hydrological Database</td>
                                            </tr>
                                            <tr>
                                                <td>2016</td>
                                                <td>Introduction of advanced flood forecasting models</td>
                                            </tr>
                                            <tr>
                                                <td>2017</td>
                                                <td>Enhancement of groundwater monitoring capabilities</td>
                                            </tr>
                                            <tr>
                                                <td>2018</td>
                                                <td>Implementation of the Hydrological Data Management System</td>
                                            </tr>
                                            <tr>
                                                <td>2019</td>
                                                <td>Launch of the Flood Early Warning System</td>
                                            </tr>
                                            <tr>
                                                <td>2020</td>
                                                <td>Celebration of 10 years of NIHSA</td>
                                            </tr>
                                            <tr>
                                                <td>2021</td>
                                                <td>Introduction of the Drought Monitoring System</td>
                                            </tr>
                                            <tr>
                                                <td>2022</td>
                                                <td>Enhancement of the Annual Flood Outlook with climate change projections</td>
                                            </tr>
                                            <tr>
                                                <td>2023</td>
                                                <td>Implementation of the Integrated Water Resources Management System</td>
                                            </tr>
                                            <tr>
                                                <td>2024</td>
                                                <td>Launch of the Digital Hydrological Services Platform</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
