@extends('layouts.app')

@section('title', 'Home - Nigeria Hydrological Services Agency')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="background-image: url('https://images.unsplash.com/photo-1541675154750-0444c7d51e8e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');" role="banner" aria-label="Welcome to NIHSA">
        <div class="container hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <h1 class="hero-title text-white">{{ __('messages.hero.title') }}</h1>
                    <p class="hero-subtitle">{{ __('messages.hero.subtitle') }}</p>

                    <div class="mb-4">
                        <form action="{{ route('search') }}" method="GET" class="mb-4" role="search" aria-label="Hero section search">
                            <div class="input-group">
                                <label for="hero-search" class="visually-hidden">{{ __('messages.hero.search_placeholder') }}</label>
                                <input type="text" id="hero-search" class="form-control hero-search" placeholder="{{ __('messages.hero.search_placeholder') }}" name="query" aria-label="{{ __('messages.hero.search_placeholder') }}" required>
                                <button class="btn btn-light" type="submit" aria-label="{{ __('messages.common.search') }}">
                                    <i class="fas fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Prominent Alert Subscription Form -->
                    <div class="hero-subscription mb-4">
                        <div class="alert alert-info p-3 border-0 rounded-lg" style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-bell text-warning me-2 fa-lg"></i>
                                <h5 class="mb-0 text-white">{{ __('messages.hero.alert_subscription_title') }}</h5>
                            </div>
                            <p class="mb-3 text-white-50">{{ __('messages.hero.alert_subscription_desc') }}</p>
                            <form class="hero-subscription-form" id="hero-subscription-form" novalidate>
                                <div class="input-group">
                                    <label for="hero-subscription-email" class="visually-hidden">{{ __('messages.cta.email_label') }}</label>
                                    <input type="email" class="form-control" id="hero-subscription-email" placeholder="{{ __('messages.cta.email_placeholder') }}" aria-label="{{ __('messages.cta.email_label') }}" required>
                                    <button type="submit" class="btn btn-warning" aria-label="{{ __('messages.cta.subscribe_button') }}">
                                        <i class="fas fa-bell me-1"></i> {{ __('messages.cta.subscribe_button') }}
                                    </button>
                                </div>
                                <small class="text-white-50 mt-1 d-block">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    {{ __('messages.cta.subscription_help') }}
                                </small>
                            </form>
                        </div>
                    </div>

                    <div class="hero-buttons">
                        <a href="{{ route('flood-forecast-dashboard') }}" class="btn cta-btn cta-btn-primary btn-lg me-3">
                            <i class="fas fa-chart-line me-2"></i> {{ __('messages.hero.view_dashboard') }}
                        </a>
                        <a href="{{ route('data-request.create') }}" class="btn cta-btn cta-btn-success btn-lg">
                            <i class="fas fa-download me-2"></i> {{ __('messages.hero.request_data') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <div class="services-intro text-center">
                <h2 class="section-title text-center mb-3" data-aos="fade-up">{{ __('messages.services.title') }}</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-8" data-aos="fade-up">
                        <p>{{ __('messages.services.subtitle') }}</p>
                    </div>
                </div>
            </div>

            <div class="services-grid">
                <div class="row g-4">
                    <div class="col-md-4" data-aos="fade-up">
                        <div class="service-card">
                            <div class="card-body">
                                <div class="service-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>

                                <h3 class="card-title">{{ __('messages.services.flood_prediction') }}</h3>

                                <div class="service-features">
                                    <div class="service-feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="service-feature-text">{{ __('Annual Flood Outlook Reports') }}</span>
                                    </div>
                                    <div class="service-feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="service-feature-text">{{ __('Real-time Monitoring Systems') }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('flood-forecast-dashboard') }}" class="btn cta-btn cta-btn-primary">
                                    <i class="fas fa-chart-bar me-1"></i> {{ __('messages.services.view_dashboard') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" data-aos="fade-up">
                        <div class="service-card">
                            <div class="card-body">
                                <div class="service-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>

                                <h3 class="card-title">{{ __('messages.services.publications') }}</h3>

                                <div class="service-features">
                                    <div class="service-feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="service-feature-text">{{ __('Research Papers & Reports') }}</span>
                                    </div>
                                    <div class="service-feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="service-feature-text">{{ __('Monthly Hydrological Bulletins') }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('publications.index') }}" class="btn cta-btn cta-btn-primary">
                                    <i class="fas fa-book me-1"></i> {{ __('messages.services.browse_publications') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" data-aos="fade-up">
                        <div class="service-card">
                            <div class="card-body">
                                <div class="service-icon">
                                    <i class="fas fa-database"></i>
                                </div>

                                <h3 class="card-title">{{ __('messages.services.data_request') }}</h3>

                                <p class="service-description">{{ __('messages.services.data_request_description') }}</p>

                                <div class="service-features">
                                    <div class="service-feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="service-feature-text">{{ __('Historical Hydrological Data') }}</span>
                                    </div>
                                    <div class="service-feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="service-feature-text">{{ __('Water Resource Information') }}</span>
                                    </div>
                                </div>

                                <!-- Step-by-step process -->
                                <div class="service-process">
                                    <div class="process-step">
                                        <span class="step-number">1</span>
                                        <span class="step-text">{{ __('messages.services.data_request_step1') }}</span>
                                    </div>
                                    <div class="process-step">
                                        <span class="step-number">2</span>
                                        <span class="step-text">{{ __('messages.services.data_request_step2') }}</span>
                                    </div>
                                    <div class="process-step">
                                        <span class="step-number">3</span>
                                        <span class="step-text">{{ __('messages.services.data_request_step3') }}</span>
                                    </div>
                                </div>

                                <div class="service-details">
                                    <div class="service-detail">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ __('messages.services.data_request_response_time') }}</span>
                                    </div>
                                    <div class="service-detail">
                                        <i class="fas fa-file-alt"></i>
                                        <span>{{ __('messages.services.data_request_formats') }}</span>
                                    </div>
                                </div>

                                <div class="service-engagement">
                                    <p class="engagement-text">{{ __('messages.services.data_request_engagement') }}</p>
                                </div>

                                <a href="{{ route('data-request.create') }}" class="btn cta-btn cta-btn-success">
                                    <i class="fas fa-download me-1"></i> {{ __('messages.services.request_data') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" data-aos="fade-up">
                        <div class="service-card">
                            <div class="card-body">
                                <div class="service-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>

                                <h3 class="card-title">{{ __('messages.services.flood_mitigation') }}</h3>

                                <p class="service-description">{{ __('messages.services.flood_mitigation_description') }}</p>

                                <div class="service-features">
                                    <div class="service-feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="service-feature-text">{{ __('Risk Assessment & Analysis') }}</span>
                                    </div>
                                    <div class="service-feature">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="service-feature-text">{{ __('Customized Mitigation Plans') }}</span>
                                    </div>
                                </div>

                                <!-- Step-by-step process -->
                                <div class="service-process">
                                    <div class="process-step">
                                        <span class="step-number">1</span>
                                        <span class="step-text">{{ __('messages.services.flood_mitigation_step1') }}</span>
                                    </div>
                                    <div class="process-step">
                                        <span class="step-number">2</span>
                                        <span class="step-text">{{ __('messages.services.flood_mitigation_step2') }}</span>
                                    </div>
                                    <div class="process-step">
                                        <span class="step-number">3</span>
                                        <span class="step-text">{{ __('messages.services.flood_mitigation_step3') }}</span>
                                    </div>
                                </div>

                                <div class="service-details">
                                    <div class="service-detail">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ __('messages.services.flood_mitigation_response_time') }}</span>
                                    </div>
                                    <div class="service-detail">
                                        <i class="fas fa-file-alt"></i>
                                        <span>{{ __('messages.services.flood_mitigation_formats') }}</span>
                                    </div>
                                </div>

                                <div class="service-engagement">
                                    <p class="engagement-text">{{ __('messages.services.flood_mitigation_engagement') }}</p>
                                </div>

                                <a href="{{ route('contact.index') }}" class="btn cta-btn cta-btn-primary">
                                    <i class="fas fa-phone me-1"></i> {{ __('messages.services.get_started') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <h2 class="section-title">{{ __('messages.about.title') }}</h2>
                    <p class="lead">{{ __('messages.about.subtitle') }}</p>
                    <p>{{ __('messages.about.description') }}</p>

                    <div class="row mt-4 mb-4">
                        <div class="col-6 col-md-3 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-water fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="h5 mb-0">Water Resources</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-chart-bar fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="h5 mb-0">Data Analysis</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-cloud-rain fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="h5 mb-0">Flood Forecast</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-map-marked-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="h5 mb-0">Mapping</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap mt-4">
                        <a href="{{ route('about') }}" class="btn cta-btn cta-btn-primary me-3 mb-2">
                            <i class="fas fa-info-circle me-2"></i> {{ __('messages.about.learn_more') }}
                        </a>
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary mb-2">
                            <i class="fas fa-envelope me-2"></i> {{ __('messages.about.contact_us') }}
                        </a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/cPh9ZHxEoho" title="NIHSA Video" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="section-title" data-aos="fade-up">{{ __('Latest News & Updates') }}</h2>
                <a href="{{ route('news.index') }}" class="btn btn-outline-primary" data-aos="fade-up">
                    <i class="fas fa-newspaper me-2"></i> {{ __('View All News') }}
                </a>
            </div>
            <div class="row g-4">
                @forelse($latestNews as $index => $news)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="news-card">
                        <img src="{{ $news->image ? asset('storage/' . $news->image) : asset('images/placeholder-300x200.svg') }}"
                             alt="{{ $news->title }}" class="card-img-top" loading="lazy">
                        <div class="card-body">
                            <span class="news-category">{{ $news->category ?? 'News' }}</span>
                            <h5 class="card-title">{{ Str::limit($news->title, 50) }}</h5>
                            <span class="news-date">
                                <i class="far fa-calendar-alt me-2"></i>
                                {{ $news->published_at ? $news->published_at->format('M j, Y') : now()->format('M j, Y') }}
                            </span>
                            <p class="card-text">{{ Str::limit(strip_tags($news->content), 100) }}</p>
                            <a href="{{ route('news.show', $news) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-arrow-right me-2"></i> {{ __('messages.common.read_more') }}
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">{{ __('No news articles available') }}</h5>
                        <p class="text-muted">{{ __('Check back later for the latest updates from NIHSA.') }}</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Flood Forecast Dashboard Section -->
    <section class="dashboard-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">
                    <div class="dashboard-content">
                        <h2 class="dashboard-title">{{ __('Flood Forecast Dashboard') }}</h2>
                        <p class="dashboard-subtitle">{{ __('Access real-time flood forecasting data and risk assessments for all states in Nigeria.') }}</p>

                        <!-- Dashboard Stats -->
                        <div class="dashboard-stats">
                            <div class="dashboard-stat" data-aos="fade-up" data-aos-delay="100">
                                <div class="dashboard-stat-value">36</div>
                                <div class="dashboard-stat-label">{{ __('States Covered') }}</div>
                            </div>
                            <div class="dashboard-stat" data-aos="fade-up" data-aos-delay="200">
                                <div class="dashboard-stat-value">250+</div>
                                <div class="dashboard-stat-label">{{ __('Monitoring Stations') }}</div>
                            </div>
                            <div class="dashboard-stat" data-aos="fade-up" data-aos-delay="300">
                                <div class="dashboard-stat-value">24/7</div>
                                <div class="dashboard-stat-label">{{ __('Real-time Updates') }}</div>
                            </div>
                        </div>

                        <!-- Dashboard Features -->
                        <div class="dashboard-features">
                            <div class="dashboard-feature" data-aos="fade-up" data-aos-delay="100">
                                <div class="dashboard-feature-icon">
                                    <i class="fas fa-map-marked"></i>
                                </div>
                                <div class="dashboard-feature-content">
                                    <h4 class="dashboard-feature-title">{{ __('Interactive Maps') }}</h4>
                                    <p class="dashboard-feature-description">{{ __('Visualize flood risk areas with color-coded maps showing current and projected flood levels across Nigeria.') }}</p>
                                </div>
                            </div>

                            <div class="dashboard-feature" data-aos="fade-up" data-aos-delay="200">
                                <div class="dashboard-feature-icon">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <div class="dashboard-feature-content">
                                    <h4 class="dashboard-feature-title">{{ __('Early Warning System') }}</h4>
                                    <p class="dashboard-feature-description">{{ __('Receive timely alerts and notifications about potential flood risks in your area.') }}</p>
                                </div>
                            </div>

                            <div class="dashboard-feature" data-aos="fade-up" data-aos-delay="300">
                                <div class="dashboard-feature-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="dashboard-feature-content">
                                    <h4 class="dashboard-feature-title">{{ __('Data Analytics') }}</h4>
                                    <p class="dashboard-feature-description">{{ __('Access historical data and trend analysis to better understand flood patterns and improve preparedness.') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="dashboard-cta" data-aos="fade-up">
                            <a href="{{ route('flood-forecast-dashboard') }}" class="btn cta-btn cta-btn-primary btn-lg">
                                <i class="fas fa-chart-line me-2"></i> {{ __('Access Dashboard') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left">
                    <div class="dashboard-preview">
                        <!-- Water Animation -->
                        <div class="water-animation">
                            <!-- Water Ripple Effect -->
                            <div class="water-ripple"></div>

                            <!-- Water Drops -->
                            <div class="water-drop"></div>
                            <div class="water-drop"></div>
                            <div class="water-drop"></div>
                            <div class="water-drop"></div>

                            <!-- Splash Effect -->
                            <div class="splash">
                                <div class="splash-ripple"></div>
                                <div class="splash-ripple"></div>
                                <div class="splash-ripple"></div>
                                <div class="splash-ripple"></div>
                            </div>

                            <!-- Dashboard Data Visualization -->
                            <div class="dashboard-data">
                                <h3>Nigeria Flood Risk Monitoring</h3>
                                <div class="dashboard-data-chart">
                                    <div class="dashboard-data-bar" style="--height: 60%"></div>
                                    <div class="dashboard-data-bar" style="--height: 40%"></div>
                                    <div class="dashboard-data-bar" style="--height: 70%"></div>
                                    <div class="dashboard-data-bar" style="--height: 50%"></div>
                                    <div class="dashboard-data-bar" style="--height: 80%"></div>
                                    <div class="dashboard-data-bar" style="--height: 65%"></div>
                                    <div class="dashboard-data-bar" style="--height: 45%"></div>
                                    <div class="dashboard-data-bar" style="--height: 75%"></div>
                                    <div class="dashboard-data-bar" style="--height: 55%"></div>
                                </div>

                                <a href="{{ route('flood-forecast-dashboard') }}" class="dashboard-preview-btn">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="card border-0 shadow-sm p-3 h-100">
                                <div class="d-flex align-items-center">
                                    <div class="me-3 text-primary">
                                        <i class="fas fa-mobile-alt fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="h6 mb-1">{{ __('Mobile Friendly') }}</h5>
                                        <p class="small mb-0 text-muted">{{ __('Access anywhere') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="card border-0 shadow-sm p-3 h-100">
                                <div class="d-flex align-items-center">
                                    <div class="me-3 text-primary">
                                        <i class="fas fa-download fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="h6 mb-1">{{ __('Exportable') }}</h5>
                                        <p class="small mb-0 text-muted">{{ __('Multiple formats') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="card border-0 shadow-sm p-3 h-100">
                                <div class="d-flex align-items-center">
                                    <div class="me-3 text-primary">
                                        <i class="fas fa-sync-alt fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="h6 mb-1">{{ __('Real-time') }}</h5>
                                        <p class="small mb-0 text-muted">{{ __('Live updates') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Preview Section -->
    <section class="dashboard-preview-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">{{ __('messages.dashboard_preview.title') }}</h2>
                    <p class="lead">{{ __('messages.dashboard_preview.subtitle') }}</p>
                </div>
            </div>

            <!-- Interactive Map Preview -->
            <div class="row g-4 mb-5">
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="preview-card map-card">
                        <div class="preview-header">
                            <div class="preview-icon">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <div class="preview-title">
                                <h4>{{ __('messages.dashboard_preview.flood_risk_map') }}</h4>
                                <p>{{ __('messages.dashboard_preview.flood_risk_map_desc') }}</p>
                            </div>
                        </div>
                        <div class="preview-content">
                            <div class="map-preview-enhanced">
                                <!-- Map Controls -->
                                <div class="map-controls">
                                    <div class="control-group">
                                        <button class="map-control-btn" title="{{ __('messages.dashboard_preview.zoom_in') }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button class="map-control-btn" title="{{ __('messages.dashboard_preview.zoom_out') }}">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <div class="control-group">
                                        <select class="form-select map-filter" id="stateFilter">
                                            <option value="all">{{ __('messages.dashboard_preview.show_all_states') }}</option>
                                            <option value="lagos">Lagos</option>
                                            <option value="rivers">Rivers</option>
                                            <option value="delta">Delta</option>
                                            <option value="bayelsa">Bayelsa</option>
                                        </select>
                                        <select class="form-select map-filter" id="riskFilter">
                                            <option value="all">All Risk Levels</option>
                                            <option value="low">Low Risk</option>
                                            <option value="medium">Medium Risk</option>
                                            <option value="high">High Risk</option>
                                            <option value="critical">Critical Risk</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Interactive Map -->
                                <div class="interactive-map">
                                    <div class="map-container">
                                        <!-- Nigeria Map Silhouette -->
                                        <div class="nigeria-map">
                                            <!-- Rivers -->
                                            <div class="river river-niger" data-tooltip="{{ __('messages.dashboard_preview.tooltip_rivers') }}"></div>
                                            <div class="river river-benue" data-tooltip="{{ __('messages.dashboard_preview.tooltip_rivers') }}"></div>

                                            <!-- States with Risk Levels -->
                                            <div class="state lagos high-risk" data-state="lagos" data-risk="high" data-tooltip="Lagos - High Risk&#10;Water Level: 2.3m&#10;Last Updated: 5 min ago"></div>
                                            <div class="state rivers critical-risk" data-state="rivers" data-risk="critical" data-tooltip="Rivers - Critical Risk&#10;Water Level: 3.1m&#10;Last Updated: 2 min ago"></div>
                                            <div class="state delta high-risk" data-state="delta" data-risk="high" data-tooltip="Delta - High Risk&#10;Water Level: 2.7m&#10;Last Updated: 8 min ago"></div>
                                            <div class="state bayelsa medium-risk" data-state="bayelsa" data-risk="medium" data-tooltip="Bayelsa - Medium Risk&#10;Water Level: 1.8m&#10;Last Updated: 12 min ago"></div>
                                            <div class="state kano low-risk" data-state="kano" data-risk="low" data-tooltip="Kano - Low Risk&#10;Water Level: 0.8m&#10;Last Updated: 15 min ago"></div>
                                            <div class="state kaduna low-risk" data-state="kaduna" data-risk="low" data-tooltip="Kaduna - Low Risk&#10;Water Level: 1.2m&#10;Last Updated: 10 min ago"></div>

                                            <!-- Dams -->
                                            <div class="dam" data-tooltip="{{ __('messages.dashboard_preview.tooltip_dams') }}"></div>
                                            <div class="dam dam-2" data-tooltip="{{ __('messages.dashboard_preview.tooltip_dams') }}"></div>

                                            <!-- Flood Zones -->
                                            <div class="flood-zone" data-tooltip="{{ __('messages.dashboard_preview.tooltip_flood_zones') }}"></div>
                                        </div>

                                        <!-- Map Legend -->
                                        <div class="map-legend">
                                            <h6>{{ __('messages.dashboard_preview.risk_levels') }}</h6>
                                            <div class="legend-item">
                                                <span class="legend-color low-risk"></span>
                                                <span class="legend-text">{{ __('messages.dashboard_preview.low_risk') }}</span>
                                            </div>
                                            <div class="legend-item">
                                                <span class="legend-color medium-risk"></span>
                                                <span class="legend-text">{{ __('messages.dashboard_preview.medium_risk') }}</span>
                                            </div>
                                            <div class="legend-item">
                                                <span class="legend-color high-risk"></span>
                                                <span class="legend-text">{{ __('messages.dashboard_preview.high_risk') }}</span>
                                            </div>
                                            <div class="legend-item">
                                                <span class="legend-color critical-risk"></span>
                                                <span class="legend-text">{{ __('messages.dashboard_preview.critical_risk') }}</span>
                                            </div>
                                        </div>

                                        <!-- Tooltip -->
                                        <div class="map-tooltip" id="mapTooltip"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="preview-card">
                        <div class="preview-header">
                            <div class="preview-icon">
                                <i class="fas fa-broadcast-tower"></i>
                            </div>
                            <div class="preview-title">
                                <h4>{{ __('messages.dashboard_preview.monitoring_stations') }}</h4>
                                <p>{{ __('messages.dashboard_preview.monitoring_stations_desc') }}</p>
                            </div>
                        </div>
                        <div class="preview-content">
                            <div class="stations-preview-enhanced">
                                <div class="station-status">
                                    <div class="status-indicator active"></div>
                                    <span>{{ __('messages.dashboard_preview.real_time_data') }}</span>
                                    <small class="d-block">{{ __('messages.dashboard_preview.last_updated') }}: 2 min ago</small>
                                </div>
                                <div class="station-stats">
                                    <div class="stat-item">
                                        <div class="stat-number active-count">247</div>
                                        <div class="stat-label">{{ __('messages.dashboard_preview.active_stations') }}</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number inactive-count">3</div>
                                        <div class="stat-label">{{ __('messages.dashboard_preview.inactive_stations') }}</div>
                                    </div>
                                </div>
                                <div class="station-pulse">
                                    <div class="pulse-dot"></div>
                                    <div class="pulse-dot"></div>
                                    <div class="pulse-dot"></div>
                                    <div class="pulse-dot"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Analytics Section -->
            <div class="row g-4 mb-5">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="preview-card">
                        <div class="preview-header">
                            <div class="preview-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="preview-title">
                                <h4>{{ __('messages.dashboard_preview.data_analytics') }}</h4>
                                <p>{{ __('messages.dashboard_preview.data_analytics_desc') }}</p>
                            </div>
                        </div>
                        <div class="preview-content">
                            <div class="analytics-preview">
                                <!-- Historical Trends Chart -->
                                <div class="chart-container">
                                    <h6>{{ __('messages.dashboard_preview.historical_trends') }}</h6>
                                    <div class="trend-chart">
                                        <div class="chart-line">
                                            <svg viewBox="0 0 300 150" class="trend-svg">
                                                <polyline points="0,120 50,100 100,80 150,60 200,70 250,40 300,30"
                                                          fill="none" stroke="#0056b3" stroke-width="3" stroke-linecap="round"/>
                                                <circle cx="50" cy="100" r="4" fill="#0056b3"/>
                                                <circle cx="150" cy="60" r="4" fill="#0056b3"/>
                                                <circle cx="250" cy="40" r="4" fill="#0056b3"/>
                                            </svg>
                                        </div>
                                        <div class="chart-labels">
                                            <span class="chart-label">Jan</span>
                                            <span class="chart-label">Mar</span>
                                            <span class="chart-label">May</span>
                                            <span class="chart-label">Jul</span>
                                            <span class="chart-label">Sep</span>
                                            <span class="chart-label">Nov</span>
                                        </div>
                                    </div>
                                    <p class="chart-description">{{ __('messages.dashboard_preview.flood_occurrences') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="preview-card">
                        <div class="preview-header">
                            <div class="preview-icon">
                                <i class="fas fa-water"></i>
                            </div>
                            <div class="preview-title">
                                <h4>{{ __('messages.dashboard_preview.water_levels') }}</h4>
                                <p>{{ __('messages.dashboard_preview.rainfall_data') }}</p>
                            </div>
                        </div>
                        <div class="preview-content">
                            <div class="water-levels-preview">
                                <div class="level-indicator">
                                    <div class="level-bar">
                                        <div class="level-fill" style="height: 65%"></div>
                                        <div class="level-markers">
                                            <span class="marker" style="bottom: 80%">3.0m</span>
                                            <span class="marker" style="bottom: 50%">2.0m</span>
                                            <span class="marker" style="bottom: 20%">1.0m</span>
                                        </div>
                                    </div>
                                    <div class="level-info">
                                        <h5>Current: 2.3m</h5>
                                        <p class="status-text">Above Normal</p>
                                    </div>
                                </div>
                                <div class="rainfall-widget">
                                    <div class="rainfall-icon">
                                        <i class="fas fa-cloud-rain"></i>
                                    </div>
                                    <div class="rainfall-data">
                                        <h5>45mm</h5>
                                        <p>Last 24 hours</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert System Preview -->
            <div class="row g-4">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="preview-card">
                        <div class="preview-header">
                            <div class="preview-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="preview-title">
                                <h4>{{ __('messages.dashboard_preview.alert_system') }}</h4>
                                <p>{{ __('messages.dashboard_preview.alert_system_desc') }}</p>
                            </div>
                        </div>
                        <div class="preview-content">
                            <div class="alert-system-preview">
                                <div class="alert-timeline">
                                    <div class="alert-item critical">
                                        <div class="alert-icon">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="alert-content">
                                            <h6>Flood Warning - Critical Risk</h6>
                                            <p>Rivers State - Immediate evacuation recommended</p>
                                            <small>2 minutes ago</small>
                                        </div>
                                    </div>
                                    <div class="alert-item high">
                                        <div class="alert-icon">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                        <div class="alert-content">
                                            <h6>Flood Watch - High Risk</h6>
                                            <p>Lagos & Delta States - Monitor water levels</p>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                    <div class="alert-item medium">
                                        <div class="alert-icon">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div class="alert-content">
                                            <h6>Weather Advisory</h6>
                                            <p>Heavy rainfall expected in Bayelsa</p>
                                            <small>1 hour ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="preview-card">
                        <div class="preview-header">
                            <div class="preview-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div class="preview-title">
                                <h4>{{ __('messages.dashboard_preview.interactive_features') }}</h4>
                                <p>{{ __('messages.dashboard_preview.interactive_features') }}</p>
                            </div>
                        </div>
                        <div class="preview-content">
                            <div class="features-list">
                                <div class="feature-item">
                                    <i class="fas fa-mouse-pointer"></i>
                                    <span>{{ __('messages.dashboard_preview.hover_tooltips') }}</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-hand-pointer"></i>
                                    <span>{{ __('messages.dashboard_preview.click_regions') }}</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-filter"></i>
                                    <span>{{ __('messages.dashboard_preview.filter_options') }}</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                    <span>Zoom and pan controls</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-sync-alt"></i>
                                    <span>Real-time data updates</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-mobile-alt"></i>
                                    <span>Mobile responsive design</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 text-center" data-aos="fade-up">
                    <a href="{{ route('flood-forecast-dashboard') }}" class="btn cta-btn cta-btn-primary btn-lg">
                        <i class="fas fa-chart-line me-2"></i> {{ __('messages.dashboard_preview.view_full_dashboard') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">{{ __('messages.faq.title') }}</h2>
                    <p class="lead">{{ __('messages.faq.subtitle') }}</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion" id="faqAccordion">

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    {{ __('messages.faq.flood_risk_interpretation') }}
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ __('messages.faq.flood_risk_interpretation_answer') }}
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    {{ __('messages.faq.researcher_data') }}
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ __('messages.faq.researcher_data_answer') }}
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    {{ __('messages.faq.subscription_costs') }}
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ __('messages.faq.subscription_costs_answer') }}
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    {{ __('messages.faq.alert_frequency') }}
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ __('messages.faq.alert_frequency_answer') }}
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="500">
                            <h2 class="accordion-header" id="faq5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    {{ __('messages.faq.unsubscribe_process') }}
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ __('messages.faq.unsubscribe_process_answer') }}
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="600">
                            <h2 class="accordion-header" id="faq6">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    {{ __('messages.faq.data_accuracy') }}
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="faq6" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ __('messages.faq.data_accuracy_answer') }}
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="700">
                            <h2 class="accordion-header" id="faq7">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                    {{ __('messages.faq.emergency_contact') }}
                                </button>
                            </h2>
                            <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="faq7" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ __('messages.faq.emergency_contact_answer') }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Publications Section -->
    <section class="publications-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title" data-aos="fade-up">{{ __('Featured Publications') }}</h2>
                <a href="{{ route('publications.index') }}" class="btn btn-outline-primary" data-aos="fade-up">
                    <i class="fas fa-book me-2"></i> {{ __('View All Publications') }}
                </a>
            </div>

            <div class="row mb-4">
                <div class="col-lg-8" data-aos="fade-up">
                    <p>{{ __('Access our latest research, reports, and guidelines to stay informed about hydrological developments and flood management strategies.') }}</p>
                </div>
            </div>

            <div class="publication-grid">
                <div class="row g-4">
                    @forelse($featuredPublications as $index => $publication)
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="publication-item">
                            <div class="publication-icon-wrapper">
                                <div class="publication-icon">
                                    <i class="far fa-file-pdf"></i>
                                </div>
                            </div>

                            <div class="publication-content">
                                <div class="publication-badges">
                                    @if($publication->is_featured)
                                        <span class="publication-badge publication-badge-new">Featured</span>
                                    @endif
                                </div>

                                <h5 class="publication-title">{{ Str::limit($publication->title, 40) }}</h5>

                                <div class="publication-date">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $publication->created_at->format('M Y') }}
                                </div>

                                <p class="publication-description">
                                    {{ Str::limit($publication->description ?? 'No description available', 80) }}
                                </p>

                                <div class="publication-footer">
                                    <a href="{{ route('publications.show', $publication) }}" class="publication-btn">
                                        <i class="fas fa-download"></i> {{ __('View Details') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">{{ __('No publications available') }}</h5>
                            <p class="text-muted">{{ __('Check back later for the latest research and reports from NIHSA.') }}</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">{{ __('Our Partners & Collaborators') }}</h2>

            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                    <p class="lead">{{ __('We collaborate with various national and international organizations to enhance our hydrological services and flood forecasting capabilities.') }}</p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse($partners as $index => $partner)
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="partner-logo">
                        <img src="{{ $partner->logo ? asset('storage/' . $partner->logo) : asset('images/nihsa-logo-placeholder.svg') }}"
                             alt="{{ $partner->name }} logo" class="img-fluid" style="max-height: 80px; object-fit: contain;" loading="lazy">
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-handshake fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">{{ __('No partners available') }}</h5>
                        <p class="text-muted">{{ __('Our partner organizations will be displayed here.') }}</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Testimonial -->
            <div class="row mt-5 pt-4">
                <div class="col-lg-8 mx-auto" data-aos="fade-up">
                    <div class="card border-0 shadow-lg p-4">
                        <div class="card-body text-center">
                            <i class="fas fa-quote-left fa-3x text-primary opacity-25 mb-3"></i>
                            <p class="lead mb-4">NIHSA's flood forecasting data has been instrumental in our disaster preparedness planning. Their accurate and timely information has helped us save lives and property.</p>
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="me-3">
                                    <img src="{{ asset('images/nihsa-logo-placeholder.svg') }}" alt="Dr. John Smith, Director of National Emergency Management Agency" class="rounded-circle" width="60">
                                </div>
                                <div class="text-start">
                                    <h5 class="mb-1">Dr. John Smith</h5>
                                    <p class="small text-muted mb-0">Director, National Emergency Management Agency</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 cta-content" data-aos="fade-up">
                    <h2 class="cta-title">{{ __('messages.cta.title') }}</h2>
                    <p class="lead mb-4">{{ __('messages.cta.subtitle') }}</p>

                    <div class="row mb-4">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="d-flex flex-column align-items-center">
                                <div class="mb-3">
                                    <i class="fas fa-bell fa-2x"></i>
                                </div>
                                <h5 class="h6">{{ __('messages.cta.instant_alerts') }}</h5>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="d-flex flex-column align-items-center">
                                <div class="mb-3">
                                    <i class="fas fa-map-marked-alt fa-2x"></i>
                                </div>
                                <h5 class="h6">{{ __('messages.cta.location_based') }}</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex flex-column align-items-center">
                                <div class="mb-3">
                                    <i class="fas fa-mobile-alt fa-2x"></i>
                                </div>
                                <h5 class="h6">{{ __('messages.cta.sms_email') }}</h5>
                            </div>
                        </div>
                    </div>

                    <div id="subscription-form-container">
                        <form class="cta-form" id="subscription-form" novalidate aria-label="{{ __('messages.cta.form_label') }}">
                            <div class="input-group">
                                <label for="subscription-email" class="visually-hidden">{{ __('messages.cta.email_label') }}</label>
                                <input type="email" class="form-control" id="subscription-email" placeholder="{{ __('messages.cta.email_placeholder') }}" aria-label="{{ __('messages.cta.email_label') }}" required aria-describedby="subscription-help">
                                <button type="submit" class="btn" aria-label="{{ __('messages.cta.subscribe_button') }}">{{ __('messages.cta.subscribe_button') }}</button>
                            </div>
                        </form>

                        <div class="subscription-details mt-3">
                            <div class="subscription-info">
                                <div class="info-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>{{ __('messages.faq.subscription_costs_answer') }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ __('messages.faq.alert_frequency_answer') }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-times-circle"></i>
                                    <span>{{ __('messages.faq.unsubscribe_process_answer') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="subscription-success" class="d-none">
                        <div class="alert alert-success p-4 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-check-circle fa-3x"></i>
                                </div>
                                <div class="text-start">
                                    <h5 class="mb-1">{{ __('messages.cta.success_title') }}</h5>
                                    <p class="mb-0">{{ __('messages.cta.success_message') }}</p>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-outline-light" id="subscribe-another">
                            <i class="fas fa-plus-circle me-2"></i> {{ __('messages.cta.subscribe_another') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle subscription form submission
        const subscriptionForm = document.getElementById('subscription-form');
        const subscriptionFormContainer = document.getElementById('subscription-form-container');
        const subscriptionSuccess = document.getElementById('subscription-success');
        const subscribeAnother = document.getElementById('subscribe-another');

        if (subscriptionForm) {
            subscriptionForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const emailInput = document.getElementById('subscription-email');
                const email = emailInput.value.trim();

                if (email) {
                    // This is just a mock for demo purposes
                    // In a real implementation, you would send an AJAX request to the server

                    // Show success message after a short delay to simulate server processing
                    setTimeout(function() {
                        subscriptionFormContainer.classList.add('d-none');
                        subscriptionSuccess.classList.remove('d-none');

                        // Log the email to console (for demo purposes)
                        console.log('Subscribed email:', email);
                    }, 1000);
                }
            });
        }

        if (subscribeAnother) {
            subscribeAnother.addEventListener('click', function() {
                subscriptionSuccess.classList.add('d-none');
                subscriptionFormContainer.classList.remove('d-none');
                document.getElementById('subscription-email').value = '';
            });
        }

        // Handle hero subscription form
        const heroSubscriptionForm = document.getElementById('hero-subscription-form');
        if (heroSubscriptionForm) {
            heroSubscriptionForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const emailInput = document.getElementById('hero-subscription-email');
                const email = emailInput.value.trim();

                if (email) {
                    // This is just a mock for demo purposes
                    // In a real implementation, you would send an AJAX request to the server

                    // Show success message after a short delay to simulate server processing
                    setTimeout(function() {
                        // Hide the hero form and show success
                        const heroForm = document.querySelector('.hero-subscription');
                        const successAlert = document.createElement('div');
                        successAlert.className = 'alert alert-success mt-3';
                        successAlert.innerHTML = `
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">{{ __('messages.cta.success_title') }}</h6>
                                    <p class="mb-0">{{ __('messages.cta.success_message') }}</p>
                                </div>
                            </div>
                        `;

                        heroForm.parentNode.replaceChild(successAlert, heroForm);

                        // Log the email to console (for demo purposes)
                        console.log('Hero subscribed email:', email);
                    }, 1000);
                }
            });
        }

        // Enhanced Interactive Map Features
        initializeInteractiveMap();
    });

    function initializeInteractiveMap() {
        const mapTooltip = document.getElementById('mapTooltip');
        const stateFilter = document.getElementById('stateFilter');
        const riskFilter = document.getElementById('riskFilter');
        const states = document.querySelectorAll('.state');
        const zoomInBtn = document.querySelector('.map-control-btn[title*="Zoom In"]');
        const zoomOutBtn = document.querySelector('.map-control-btn[title*="Zoom Out"]');

        let currentZoom = 1;
        let currentStateFilter = 'all';
        let currentRiskFilter = 'all';

        // State hover tooltips
        states.forEach(state => {
            state.addEventListener('mouseenter', function(e) {
                const tooltip = this.getAttribute('data-tooltip');
                if (tooltip && mapTooltip) {
                    mapTooltip.textContent = tooltip;
                    mapTooltip.style.display = 'block';
                    mapTooltip.style.left = e.pageX + 10 + 'px';
                    mapTooltip.style.top = e.pageY - 10 + 'px';
                }
            });

            state.addEventListener('mouseleave', function() {
                if (mapTooltip) {
                    mapTooltip.style.display = 'none';
                }
            });

            state.addEventListener('click', function() {
                const stateName = this.getAttribute('data-state');
                // Simulate state selection
                console.log('Selected state:', stateName);
                // Add visual feedback
                states.forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // Map controls
        if (zoomInBtn) {
            zoomInBtn.addEventListener('click', function() {
                if (currentZoom < 2) {
                    currentZoom += 0.2;
                    updateMapZoom();
                }
            });
        }

        if (zoomOutBtn) {
            zoomOutBtn.addEventListener('click', function() {
                if (currentZoom > 0.6) {
                    currentZoom -= 0.2;
                    updateMapZoom();
                }
            });
        }

        function updateMapZoom() {
            const mapContainer = document.querySelector('.nigeria-map');
            if (mapContainer) {
                mapContainer.style.transform = `scale(${currentZoom})`;
                mapContainer.style.transition = 'transform 0.3s ease';
            }
        }

        // Filter functionality
        if (stateFilter) {
            stateFilter.addEventListener('change', function() {
                currentStateFilter = this.value;
                applyFilters();
            });
        }

        if (riskFilter) {
            riskFilter.addEventListener('change', function() {
                currentRiskFilter = this.value;
                applyFilters();
            });
        }

        function applyFilters() {
            states.forEach(state => {
                const stateName = state.getAttribute('data-state');
                const riskLevel = state.getAttribute('data-risk');
                let showState = true;

                if (currentStateFilter !== 'all' && stateName !== currentStateFilter) {
                    showState = false;
                }

                if (currentRiskFilter !== 'all' && riskLevel !== currentRiskFilter) {
                    showState = false;
                }

                if (showState) {
                    state.style.display = 'block';
                    state.style.opacity = '1';
                } else {
                    state.style.display = 'none';
                    state.style.opacity = '0.3';
                }
            });
        }

        // Animate chart on load
        const trendSvg = document.querySelector('.trend-svg');
        if (trendSvg) {
            const polyline = trendSvg.querySelector('polyline');
            if (polyline) {
                const length = polyline.getTotalLength();
                polyline.style.strokeDasharray = length;
                polyline.style.strokeDashoffset = length;

                setTimeout(() => {
                    polyline.style.transition = 'stroke-dashoffset 2s ease-in-out';
                    polyline.style.strokeDashoffset = '0';
                }, 500);
            }
        }

        // Pulse animation for station indicators
        const pulseDots = document.querySelectorAll('.pulse-dot');
        pulseDots.forEach((dot, index) => {
            setTimeout(() => {
                dot.style.animation = 'pulse 2s infinite';
            }, index * 500);
        });

        // Water level animation
        const levelFill = document.querySelector('.level-fill');
        if (levelFill) {
            setTimeout(() => {
                levelFill.style.transition = 'height 1.5s ease-in-out';
                levelFill.style.height = '65%';
            }, 1000);
        }
    }
</script>
@endsection
