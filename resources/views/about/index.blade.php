@extends('layouts.app')

@section('title', 'About Us - Nigeria Hydrological Services Agency')

@section('styles')
<style>
    .service-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }

    .service-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        background: linear-gradient(45deg, var(--primary-color), #004494);
        color: white;
        font-size: 2rem;
        border-radius: 50%;
    }

    .section-title {
        color: var(--primary-color);
        font-weight: 700;
        position: relative;
        margin-bottom: 2rem;
        font-size: 2.5rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, var(--primary-color), #004494);
        border-radius: 2px;
    }

    .card-title {
        color: var(--primary-color);
        font-weight: 600;
    }

    .card-title i {
        font-size: 1.2rem;
    }

    .breadcrumb {
        background-color: transparent;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .breadcrumb-item {
        font-size: 0.9rem;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: var(--dark-color);
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: var(--dark-color);
        font-weight: 500;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: #6c757d;
        content: ">";
    }

    .display-5 {
        font-size: 3rem;
        font-weight: 700;
        line-height: 1.2;
        color: var(--dark-color);
    }

    .accordion-button:not(.collapsed) {
        background-color: var(--primary-color);
        color: white;
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 86, 179, 0.25);
    }

    .service-process {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 2rem 0;
    }

    .service-process::before {
        content: '';
        position: absolute;
        top: 60px;
        left: 60px;
        right: 60px;
        height: 3px;
        background: linear-gradient(to right, var(--primary-color), #004494);
        z-index: 0;
    }

    .service-process-step {
        flex: 1;
        text-align: center;
        padding: 0 15px;
        position: relative;
        z-index: 1;
    }

    .service-process-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        background: white;
        color: var(--primary-color);
        font-size: 2rem;
        border-radius: 50%;
        border: 3px solid var(--primary-color);
        position: relative;
    }

    .service-process-number {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 30px;
        height: 30px;
        background: var(--primary-color);
        color: white;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .display-5 {
            font-size: 2.5rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .service-process {
            flex-direction: column;
        }

        .service-process::before {
            display: none;
        }

        .service-process-step {
            margin-bottom: 2rem;
        }

        .service-card .card-body {
            padding: 1.5rem !important;
        }
    }

    /* AOS Animation overrides */
    [data-aos] {
        opacity: 1 !important;
    }

    [data-aos].aos-animate {
        opacity: 1 !important;
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <h1 class="display-5 fw-bold mb-4">About NIHSA</h1>
                    <p class="lead mb-4">The Nigeria Hydrological Services Agency (NIHSA) is the apex hydrological body responsible for water resources assessment, management, and development in Nigeria.</p>
                    <p>We provide essential hydrological data, flood forecasting, and water resources information to support sustainable development and disaster risk reduction across the nation.</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About Us</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <img src="{{ asset('images/nihsa-logo-placeholder.svg') }}" alt="NIHSA Logo" class="img-fluid" onerror="this.src='https://via.placeholder.com/600x400?text=NIHSA+About+Us'">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- About Content Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">Our Core Information</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 border-0 shadow-sm service-card">
                        <div class="card-body text-center">
                            <div class="service-icon mb-4">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <h5 class="card-title">Our History</h5>
                            <p class="card-text">Learn about our establishment and evolution as Nigeria's premier hydrological services agency.</p>
                            <button class="btn btn-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#historyContent">
                                <i class="fas fa-info-circle me-2"></i> Learn More
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 border-0 shadow-sm service-card">
                        <div class="card-body text-center">
                            <div class="service-icon mb-4">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <h5 class="card-title">Our Mandate</h5>
                            <p class="card-text">Discover our legal responsibilities and core functions in water resources management.</p>
                            <button class="btn btn-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#mandateContent">
                                <i class="fas fa-info-circle me-2"></i> Learn More
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 border-0 shadow-sm service-card">
                        <div class="card-body text-center">
                            <div class="service-icon mb-4">
                                <i class="fas fa-eye"></i>
                            </div>
                            <h5 class="card-title">Our Vision</h5>
                            <p class="card-text">Explore our long-term goals for sustainable water resources management in Nigeria.</p>
                            <button class="btn btn-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#visionContent">
                                <i class="fas fa-info-circle me-2"></i> Learn More
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="card h-100 border-0 shadow-sm service-card">
                        <div class="card-body text-center">
                            <div class="service-icon mb-4">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <h5 class="card-title">Our Mission</h5>
                            <p class="card-text">Understand our commitment to providing reliable hydrological data and services.</p>
                            <button class="btn btn-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#missionContent">
                                <i class="fas fa-info-circle me-2"></i> Learn More
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Collapsible Content -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="accordion" id="aboutAccordion">
                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingHistory">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#historyContent" aria-expanded="false" aria-controls="historyContent">
                                    <i class="fas fa-info-circle me-2"></i> Our History
                                </button>
                            </h2>
                            <div id="historyContent" class="accordion-collapse collapse" aria-labelledby="headingHistory" data-bs-parent="#aboutAccordion">
                                <div class="accordion-body">
                                    <p>The Nigeria Hydrological Services Agency was established by the NIHSA Act 2010 and signed into law by Mr. President on 27th August, 2010. The Act is published in the Official Gazette of the Federal Government of Nigeria No 100, Vol. 97 of 31st August, 2010.</p>
                                    <p>The Agency came into being as a result of the transformation of the former Department of Hydrology and Hydrogeology of the Federal Ministry of Water Resources. It has the statutory responsibility for water resources assessment in terms of quantity, quality, occurrence and availability in time and space.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingMandate">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mandateContent" aria-expanded="false" aria-controls="mandateContent">
                                    <i class="fas fa-bullseye me-2"></i> Our Mandate
                                </button>
                            </h2>
                            <div id="mandateContent" class="accordion-collapse collapse" aria-labelledby="headingMandate" data-bs-parent="#aboutAccordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>To provide services required for assessment of the nation's surface and groundwater resources in terms of quantity, quality, distribution and availability in time and space; for efficient and sustainable management of the resource.</li>
                                        <li>To operate and maintain hydrological stations nationwide and carry out groundwater exploration and monitoring using various scientific techniques in order to provide hydrological and hydrogeological data needed for planning, design, execution and management of water resources and allied projects</li>
                                        <li>To advise the general public, policy and decision makers and the stakeholders both in Government, public and the private sectors on all aspects of hydrology</li>
                                        <li>To provide hydrological services in operational hydrology and water resources activities and work with other sister Agencies to issue forecasts on floods, droughts, etc.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingVision">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#visionContent" aria-expanded="false" aria-controls="visionContent">
                                    <i class="fas fa-eye me-2"></i> Our Vision
                                </button>
                            </h2>
                            <div id="visionContent" class="accordion-collapse collapse" aria-labelledby="headingVision" data-bs-parent="#aboutAccordion">
                                <div class="accordion-body">
                                    <p>To create a dynamic and advanced hydrological service with capabilities of facilitating and supporting the harnessing, controlling, preserving, developing and managing Nigeria's valuable water resources in a sustainable manner.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingMission">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#missionContent" aria-expanded="false" aria-controls="missionContent">
                                    <i class="fas fa-rocket me-2"></i> Our Mission
                                </button>
                            </h2>
                            <div id="missionContent" class="accordion-collapse collapse" aria-labelledby="headingMission" data-bs-parent="#aboutAccordion">
                                <div class="accordion-body">
                                    <p>To provide information on the status and trends of the nation's water resources including its location in time and space, extent, dependability, quality and the possibilities of its utilization and control, through the provision of reliable and high quality hydrological and hydrogeological data on a continuous basis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Process Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">How We Operate</h2>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="service-process" data-aos="fade-up">
                        <div class="service-process-step">
                            <div class="service-process-icon">
                                <i class="fas fa-search"></i>
                                <div class="service-process-number">1</div>
                            </div>
                            <h4>Data Collection</h4>
                            <p>We collect comprehensive hydrological and hydrogeological data from our extensive network of monitoring stations across Nigeria.</p>
                        </div>
                        <div class="service-process-step">
                            <div class="service-process-icon">
                                <i class="fas fa-chart-line"></i>
                                <div class="service-process-number">2</div>
                            </div>
                            <h4>Analysis & Assessment</h4>
                            <p>Our expert team analyzes the collected data to assess water resources, predict trends, and evaluate environmental impacts.</p>
                        </div>
                        <div class="service-process-step">
                            <div class="service-process-icon">
                                <i class="fas fa-bullhorn"></i>
                                <div class="service-process-number">3</div>
                            </div>
                            <h4>Information Dissemination</h4>
                            <p>We provide valuable hydrological information and forecasts to government agencies, stakeholders, and the general public.</p>
                        </div>
                        <div class="service-process-step">
                            <div class="service-process-icon">
                                <i class="fas fa-shield-alt"></i>
                                <div class="service-process-number">4</div>
                            </div>
                            <h4>Disaster Management</h4>
                            <p>We support flood forecasting, drought monitoring, and disaster risk reduction efforts to protect lives and property.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <h2 class="mb-4">Learn More About NIHSA</h2>
                    <p class="lead mb-4">Explore our organizational structure, management team, and the various functions we perform to serve Nigeria's hydrological needs.</p>
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                            <a href="{{ route('about.functions') }}" class="btn btn-light btn-lg w-100">
                                <i class="fas fa-tasks me-2"></i> Functions of The Agency
                            </a>
                        </div>
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                            <a href="{{ route('about.management') }}" class="btn btn-light btn-lg w-100">
                                <i class="fas fa-users me-2"></i> Management
                            </a>
                        </div>
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                            <a href="{{ route('about.structure') }}" class="btn btn-light btn-lg w-100">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS (Animate On Scroll)
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100,
                delay: 0
            });
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add enhanced hover effects for service cards
        const serviceCards = document.querySelectorAll('.service-card');
        serviceCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Add click animation for CTA buttons
        const ctaButtons = document.querySelectorAll('.btn-light');
        ctaButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Create ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add click handlers for service cards to open accordions
        const learnMoreButtons = document.querySelectorAll('.service-card .btn-primary');
        learnMoreButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-bs-target');
                if (targetId) {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        // Close all other accordions
                        const allAccordions = document.querySelectorAll('.accordion-collapse');
                        allAccordions.forEach(accordion => {
                            if (accordion.id !== targetId.substring(1)) {
                                accordion.classList.remove('show');
                            }
                        });

                        // Toggle the target accordion
                        targetElement.classList.toggle('show');

                        // Update button text
                        const buttonText = this.querySelector('i + *') || this.querySelector('i').nextSibling;
                        if (targetElement.classList.contains('show')) {
                            if (buttonText) buttonText.textContent = ' Show Less';
                        } else {
                            if (buttonText) buttonText.textContent = ' Learn More';
                        }
                    }
                }
            });
        });

        // Add animation to process steps on scroll
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '0px 0px -50px 0px'
        };

        const processObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const steps = entry.target.querySelectorAll('.service-process-step');
                    steps.forEach((step, index) => {
                        setTimeout(() => {
                            step.style.opacity = '1';
                            step.style.transform = 'translateY(0)';
                        }, index * 200);
                    });
                }
            });
        }, observerOptions);

        const processSection = document.querySelector('.service-process');
        if (processSection) {
            processObserver.observe(processSection);

            // Initially hide process steps
            const steps = processSection.querySelectorAll('.service-process-step');
            steps.forEach(step => {
                step.style.opacity = '0';
                step.style.transform = 'translateY(30px)';
                step.style.transition = 'all 0.6s ease-out';
            });
        }
    });
</script>

<style>
    .btn-light {
        position: relative;
        overflow: hidden;
    }

    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Ensure smooth animations */
    .service-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-light {
        transition: all 0.3s ease;
    }

    .btn-light:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .service-process-step {
        transition: all 0.6s ease-out;
    }
</style>
@endsection
