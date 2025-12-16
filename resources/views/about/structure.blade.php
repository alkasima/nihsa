@extends('layouts.app')

@section('title', 'Organisational Structure - Nigeria Hydrological Services Agency')

@section('styles')
<style>
    /* Custom styles for responsive tables */
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

    /* Responsive image improvements */
    .org-chart-container {
        background: white;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin: 1rem 0;
    }

    /* Mobile table improvements */
    @media (max-width: 768px) {
        .table th,
        .table td {
            padding: 0.5rem 0.25rem;
            font-size: 0.8rem;
        }

        .table th {
            font-size: 0.75rem;
            padding: 0.75rem 0.25rem;
        }

        .org-chart-container {
            padding: 0.5rem;
        }

        .card-body {
            padding: 1rem !important;
        }

        .accordion-button {
            font-size: 0.9rem;
            padding: 0.75rem 1rem;
        }

        .accordion-body {
            font-size: 0.85rem;
        }
    }

    /* Improve text readability */
    .card-body h3 {
        color: var(--primary-color);
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
        margin-top: 2rem;
    }

    .card-body h3:first-child {
        margin-top: 0;
    }

    .lead {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #495057;
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
                    <h1 class="mb-4">Administrative Structure</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('about') }}">About Us</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Administrative Structure</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Org Structure Section -->
    <section class="py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm mb-5">
                        <div class="card-body p-3 p-md-4">
                            <h2 class="mb-4 text-center">Administrative Structure</h2>
                        
                            
                            <p class="lead">The Federal Ministry of Water Resources is the umbrella ministry under which all water resources activities at the Federal level, including hydrological services and allied operations, are domiciled.
                                Consequently, the Honourable Minister of Water Resources sits at the top of the organizational framework of the Nigeria Hydrological Services Agency as the apex authority from whom all other responsibilities emanate by statute. The Director General oversees the day-to-day running of the Agency and reports to the Honourable Minister. 
                            </p>
                            
                            <p>There are nine (9) Departments in the Agency, five (7) Technical Departments and one (2) Department for General Services. Each of the Departments operates under the leadership of a Director and the Departments are further sub-divided into Divisions and Units for effective discharge of their responsibilities. There are various Units such as Legal, Audit, Procurement, SERVICOM, Press and Anti-corruption that function directly under the office of the Director-General.</p>

                            <!-- <h3 class="mb-4">ORGANOGRAM</h3>
                            <p>The Agency has Eight (8) Area Offices with two (2) Field Offices each fashioned, according to the eight (8) Natural Drainage Basins (Hydrological Areas) of the country.  The Agency is structured as shown in the organogram below:</p>
                            <div class="org-chart-container">
                                <img src="{{ asset('images/org-chart.png') }}" alt="Organizational Chart" class="img-fluid w-100" style="max-height: 600px; object-fit: contain;">
                            </div> -->
                            
                            <div class="mt-5">
                                <h3 class="mb-4">Departments</h3>
                                
                                <div class="accordion" id="departmentsAccordion">
                                    <!-- Department of  Operational Hydrology -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Department of Operational Hydrology
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#departmentsAccordion">
                                            <div class="accordion-body">
                                                <p><strong>Director</strong></p>
                                                <p><strong><i>Femi Stephen Begide</i></strong></p>
                                                
                                                <p><strong>Core Functions</strong></p>
                                                <p>Data Collection from hydrometric river gauging stations for real-time data collection. Conducts routine discharge measurements on major rivers and tributaries. This foundational data underpins the agency's Annual Flood Outlook (AFO) and is critical for flood and drought forecasting.</p>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Engineering Hydrology -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Engineering Hydrology
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#departmentsAccordion">
                                            <div class="accordion-body">
                                                <p><strong>Director</strong></p>
                                                <p><strong><i>Engr. John Gbadegesin (Acting)</i></strong></p>
                                                
                                                <p><strong>Core Functions</strong></p>
                                                <p>Involved in the technical design of hydrological structures, flood control measures, and the development of engineering solutions for water resource management. Maintains hydrometric river gauging stations for real-time data collection. Also conducts routine <strong>discharge measurements</strong> on major rivers and tributaries, and carries out flood Vulnerability assessments.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hydrogeology -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Hydrogeology
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#departmentsAccordion">
                                            <div class="accordion-body">
                                                <p><strong>Director</strong></p>
                                                <p><strong><i>Franka Fashe-Adam</i></strong></p>
                                                
                                                <p><strong>Core Functions</strong></p>
                                                <p>Focuses on groundwater resource assessment and management. Key projects include developing a <strong>National Hydrogeological Map</strong> to overview groundwater availability and quality. Manages a <strong>groundwater monitoring network</strong> to track water level fluctuations, detect saline intrusion, and provide early warnings of pollution.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- HydroGeophysics -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                HydroGeophysics
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#departmentsAccordion">
                                            <div class="accordion-body">
                                                <p><strong>Director</strong></p>
                                                <p><strong><i>Sunday Huseini (Acting)</i></strong></p>
                                                
                                                <p><strong>Core Functions</strong></p>
                                                <p>Uses geophysical methods to investigate subsurface water resources. Leads specific projects like the <strong>preliminary hydrogeophysical investigation of Nigeria</strong> to identify aquifers, map saline zones, and assess groundwater quality for development.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Human Resource -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                Human Resource
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#departmentsAccordion">
                                            <div class="accordion-body">
                                                <p><strong>Director</strong></p>
                                                <p><strong><i>Muhammad Amina Hassan</i></strong></p>
                                                
                                                <p><strong>Core Functions</strong></p>
                                                <p>This department is responsible for all personnel management functions within the agency.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Finance and Admin -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSix">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                Finance and Admin
                                            </button>
                                        </h2>
                                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#departmentsAccordion">
                                            <div class="accordion-body">
                                                <p><strong>Director</strong></p>
                                                <p><strong><i>Habibu Halimatu (Acting)</i></strong></p>
                                                
                                                <p><strong>Core Functions</strong></p>
                                                <p>Responsible for the agency's financial management, budgeting, and overall administration. The department is led by the <strong>Director of Admin & Finance</strong>.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Planning, Research and Statistics -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSeven">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                Planning, Research and Statistics
                                            </button>
                                        </h2>
                                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#departmentsAccordion">
                                            <div class="accordion-body">
                                                <p><strong>Director</strong></p>
                                                <p><strong><i>Awoibi Ukairo (Acting)</i></strong></p>
                                                
                                                <p><strong>Core Functions</strong></p>
                                                <p>Coordinates strategic planning, sectoral research, and statistical analysis. Represents the agency in key partnerships (e.g., with the <strong>World Bank</strong>). Manages the agency's <strong>Database Management System (DBMS)</strong> and leads initiatives like the <strong>Nationwide Sediment Transport Studies Project</strong>.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Coastal and Marine -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingEight">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                Coastal and Marine
                                            </button>
                                        </h2>
                                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#departmentsAccordion">
                                            <div class="accordion-body">
                                                <p><strong>Director</strong></p>
                                                <p><strong><i>Engr Aliyu Falal Mohammed (Acting)</i></strong></p>
                                                
                                                <p><strong>Core Functions</strong></p>
                                                <p>A newly created department. Its mandate includes <strong>monitoring and assessing coastal and marine water resources</strong>. It seeks partnerships (e.g., with the <strong>Nigerian Navy and NIMASA</strong>) to expand monitoring networks along the coast, address security and pollution concerns, and safeguard coastal hydrological stations.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- HydroGeoInformatics -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingNine">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                                HydroGeoInformatics
                                            </button>
                                        </h2>
                                        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#departmentsAccordion">
                                            <div class="accordion-body">
                                                <p><strong>Director</strong></p>
                                                <p><strong><i>Engr. Dan Amoudu</i></strong></p>
                                                
                                                <p><strong>Core Functions</strong></p>
                                                <ul>
                                                    <li><strong>Data Integration & Analysis:</strong> The Data bank of the Agency, Synthesizes surface water, groundwater, and environmental data for sustainable water resource management.</li>
                                                    <li><strong>Public & Educational Outreach:</strong> Leads initiatives like launching the <strong>NIHSA Hydro Club</strong> in secondary schools to promote water science education and flood awareness.</li>
                                                    <li><strong>Institutional Collaboration:</strong> Engages in partnerships with academic institutions (e.g., African University of Science and Technology) for research and staff training.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="mt-5">
                                <h3 class="mb-4">Staff Strength</h3>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped w-100">
                                        <thead class="table-success">
                                            <tr>
                                                <th colspan="2" class="text-center">A: Sex Distribution</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>i. Male</strong></td>
                                                <td class="text-center"><strong>144</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>ii. Female</strong></td>
                                                <td class="text-center"><strong>88</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive mt-4">
                                    <table class="table table-bordered table-striped w-100">
                                        <thead class="table-info">
                                            <tr>
                                                <th colspan="2" class="text-center">B: Staff Categories</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>i. Engineers</strong></td>
                                                <td class="text-center"><strong>-</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>ii. Geologists</strong></td>
                                                <td class="text-center"><strong>-</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>iii. Hydrologists/Hydrogeologists</strong></td>
                                                <td class="text-center"><strong>61</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>iv. Scientific Officers</strong></td>
                                                <td class="text-center"><strong>7</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>v. Surveyors</strong></td>
                                                <td class="text-center"><strong>1</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>vi. Administrative Officers</strong></td>
                                                <td class="text-center"><strong>38</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>vii. Statisticians</strong></td>
                                                <td class="text-center"><strong>2</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>viii. Driver and Mechanics</strong></td>
                                                <td class="text-center"><strong>11</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>ix. Confidential Secretaries</strong></td>
                                                <td class="text-center"><strong>5</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>x. Planning Officers</strong></td>
                                                <td class="text-center"><strong>1</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xi. Work Superintendents</strong></td>
                                                <td class="text-center"><strong>4</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xii. Clerical Officers</strong></td>
                                                <td class="text-center"><strong>14</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xiii. Environmental Mgt Officers</strong></td>
                                                <td class="text-center"><strong>8</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xiv. Statistical Officers</strong></td>
                                                <td class="text-center"><strong>1</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xv. Computer Analyst</strong></td>
                                                <td class="text-center"><strong>5</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xvi. Programme Analyst</strong></td>
                                                <td class="text-center"><strong>1</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xvii. Technical Officers</strong></td>
                                                <td class="text-center"><strong>13</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xviii. Craftsman</strong></td>
                                                <td class="text-center"><strong>1</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xix. Accountant</strong></td>
                                                <td class="text-center"><strong>12</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xx. Procurement Officers</strong></td>
                                                <td class="text-center"><strong>2</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xxi. Executive Officers (GD)</strong></td>
                                                <td class="text-center"><strong>22</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xxii. Executive Officer (account)</strong></td>
                                                <td class="text-center"><strong>10</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xxiii. Legal Officer</strong></td>
                                                <td class="text-center"><strong>3</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xxiv. Stock Verifiers</strong></td>
                                                <td class="text-center"><strong>1</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xxv. Store Officers</strong></td>
                                                <td class="text-center"><strong>3</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>xxvi. Data Processing Officers</strong></td>
                                                <td class="text-center"><strong>2</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> -->
                            
                            <!-- <div class="mt-5">
                                <h3 class="mb-4">Zonal and Field Offices</h3>
                                
                                <p>In addition to the headquarters in Abuja, NIHSA has zonal offices across the country to ensure effective coverage and service delivery. Each zonal office is responsible for coordinating hydrological activities in its zone and supervising field offices within its jurisdiction.</p>
                                
                                <p>The zonal offices are structured as follows:</p>
                                
                                <ul>
                                    <li><strong>North Central Zonal Office (Jos):</strong> Covering Plateau, Nasarawa, Benue, Kogi, Niger, and Kwara States.</li>
                                    <li><strong>North East Zonal Office (Maiduguri):</strong> Covering Borno, Yobe, Adamawa, Taraba, Gombe, and Bauchi States.</li>
                                    <li><strong>North West Zonal Office (Kano):</strong> Covering Kano, Kaduna, Katsina, Jigawa, Sokoto, Zamfara, and Kebbi States.</li>
                                    <li><strong>South East Zonal Office (Enugu):</strong> Covering Enugu, Anambra, Imo, Abia, and Ebonyi States.</li>
                                    <li><strong>South South Zonal Office (Port Harcourt):</strong> Covering Rivers, Bayelsa, Delta, Edo, Cross River, and Akwa Ibom States.</li>
                                    <li><strong>South West Zonal Office (Lagos):</strong> Covering Lagos, Ogun, Oyo, Osun, Ondo, and Ekiti States.</li>
                                </ul>
                                
                                <p>Field offices are located at strategic locations across the country, particularly at major river basins and groundwater provinces, to facilitate data collection and monitoring activities.</p>
                            </div> -->
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
