<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Nigeria Hydrological Services Agency - Water Resources Data for Sustainable Development">
    <meta name="keywords" content="NIHSA, hydrology, water resources, flood forecast, Nigeria">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'NIHSA'))</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700|Roboto:400,500,700" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Animate On Scroll Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Fix for shaking issue -->
    <link rel="stylesheet" href="{{ asset('css/fix-shaking.css') }}">

    <!-- Custom NIHSA Redesign Styles -->
    <link rel="stylesheet" href="{{ asset('css/nihsa-redesign.css') }}">

    <!-- Additional Styles -->
    <style>
        :root {
            --primary-color: #0056b3;
            --secondary-color: #28a745;
            --accent-color: #17a2b8;
            --dark-color: #212529;
            --light-color: #f8f9fa;
            --text-color: #333333;
            --bg-color: #ffffff;
            --border-color: #dee2e6;
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text-color);
            background-color: var(--bg-color);
            line-height: 1.6;
        }

        /* Skip to main content link for screen readers */
        .skip-link {
            position: absolute;
            top: -40px;
            left: 6px;
            background: var(--primary-color);
            color: white;
            padding: 8px;
            text-decoration: none;
            border-radius: 4px;
            z-index: 1000;
            font-weight: 600;
        }

        .skip-link:focus {
            top: 6px;
        }

        /* Focus styles for better keyboard navigation */
        .nav-link:focus,
        .btn:focus,
        .form-control:focus,
        .dropdown-item:focus {
            outline: 3px solid #4A90E2;
            outline-offset: 2px;
        }

        /* High contrast improvements */
        .text-muted {
            color: #495057 !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        /* Ensure sufficient color contrast */
        .navbar-nav .nav-link {
            color: var(--dark-color) !important;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link:focus,
        .navbar-nav .nav-link.active {
            color: var(--primary-color) !important;
        }

        .navbar-nav .nav-link.active {
            font-weight: 600;
        }

        .navbar-brand img {
            max-height: 60px;
            width: auto;
        }

        .top-bar {
            background-color: var(--primary-color);
            color: white;
            padding: 5px 0;
            font-size: 0.9rem;
        }

        .top-bar a {
            color: white;
            margin-right: 15px;
        }

        .main-navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            padding: 0.5rem 0.6rem;
            transition: color 0.3s;
            white-space: nowrap;
            font-size: 0.9rem;
        }

        .nav-link:hover,
        .nav-link:focus {
            color: var(--primary-color) !important;
        }

        .nav-link.dropdown-toggle {
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.5rem 0.6rem;
        }

        .nav-link.dropdown-toggle:hover,
        .nav-link.dropdown-toggle:focus {
            color: var(--primary-color) !important;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 0.5rem 0;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            transition: background-color 0.3s;
        }

        .dropdown-item:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 0;
        }

        .footer h5 {
            color: var(--light-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .footer-links {
            list-style: none;
            padding-left: 0;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .copyright {
            background-color: rgba(0,0,0,0.2);
            padding: 1rem 0;
            color: rgba(255,255,255,0.7);
        }

        .social-icons a {
            color: white;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        /* Custom button styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #004494;
            border-color: #004494;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 86, 179, 0.3);
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #218838;
            border-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .btn-outline-light {
            border-color: rgba(255, 255, 255, 0.8);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background-color: white;
            border-color: white;
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 86, 179, 0.2);
        }

        .btn-outline-secondary {
            border-color: var(--secondary-color);
            color: var(--secondary-color);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);
        }

        /* CTA Button specific styles */
        .cta-btn {
            font-size: 1.1rem;
            padding: 1rem 2rem;
            border-radius: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .cta-btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #004494);
            border: none;
        }

        .cta-btn-success {
            background: linear-gradient(135deg, var(--secondary-color), #218838);
            border: none;
        }

        /* Hero section */
        .hero-section {
            background-size: cover;
            background-position: center;
            color: white;
            padding: 5rem 0;
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        /* Card styles */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Breadcrumbs styling */
        .breadcrumbs-section {
            border-bottom: 1px solid #e9ecef;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item {
            font-size: 0.875rem;
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
            content: ">";
            color: #6c757d;
        }

        /* Accessibility improvements */
        .visually-hidden {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .navbar-nav .nav-link {
                color: #000000 !important;
                font-weight: 600;
            }

            .navbar-nav .nav-link:hover,
            .navbar-nav .nav-link:focus {
                color: #0000ff !important;
                background-color: #ffffff;
            }

            .btn-primary {
                background-color: #0000ff !important;
                border-color: #0000ff !important;
                color: #ffffff !important;
            }

            .btn-outline-primary {
                border-color: #0000ff !important;
                color: #0000ff !important;
            }

            .btn-outline-primary:hover {
                background-color: #0000ff !important;
                color: #ffffff !important;
            }

            .text-muted {
                color: #000000 !important;
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* RTL Support for Arabic script languages */
        [dir="rtl"] {
            text-align: right;
        }

        [dir="rtl"] .navbar-nav {
            margin-right: 0;
            margin-left: auto;
        }

        [dir="rtl"] .dropdown-menu {
            right: 0;
            left: auto;
            text-align: right;
        }

        [dir="rtl"] .breadcrumb-item + .breadcrumb-item::before {
            content: "<";
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        [dir="rtl"] .me-2 {
            margin-left: 0.5rem !important;
            margin-right: 0 !important;
        }

        [dir="rtl"] .me-3 {
            margin-left: 1rem !important;
            margin-right: 0 !important;
        }

        [dir="rtl"] .text-start {
            text-align: right !important;
        }

        [dir="rtl"] .text-end {
            text-align: left !important;
        }

        /* Language-specific font support */
        [lang="ha"] {
            font-family: 'Noto Sans Arabic', 'Arial Unicode MS', Arial, sans-serif;
        }

        [lang="ha"][dir="rtl"] {
            direction: rtl;
            text-align: right;
        }

        /* Language Switcher Container Fix */
        .navbar .dropdown {
            max-width: 280px;
        }

        /* Ensure language switcher stays within navbar bounds */
        .navbar-nav.ms-auto .nav-item:last-child {
            margin-right: 0;
        }

        .navbar-nav.ms-auto .dropdown {
            margin-left: auto;
            margin-right: 0;
        }

        .navbar .dropdown-toggle {
            max-width: 90px;
            min-width: 70px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding-left: 0.4rem;
            padding-right: 0.4rem;
            font-size: 0.85rem;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            font-weight: 500;
        }

        .navbar .dropdown-toggle:hover,
        .navbar .dropdown-toggle:focus {
            background-color: rgba(0, 86, 179, 0.1);
            border-color: var(--primary-color);
        }

        .navbar .dropdown-toggle i {
            font-size: 0.8rem;
            margin-right: 0.25rem;
        }

        .navbar .dropdown-menu {
            min-width: 200px;
            max-width: 280px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .navbar .dropdown-item {
            padding: 0.5rem 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .navbar .dropdown-item:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .navbar .dropdown-item:hover small {
            color: rgba(255, 255, 255, 0.8);
        }

        /* Ensure dropdown stays within viewport */
        .navbar .dropdown-menu {
            position: absolute;
            right: 0;
            left: auto;
        }

        @media (max-width: 768px) {
            .navbar .dropdown-menu {
                max-width: 250px;
                right: 0;
                left: auto;
            }

            .navbar .dropdown-toggle {
                max-width: 80px;
                min-width: 60px;
                padding-left: 0.3rem;
                padding-right: 0.3rem;
                font-size: 0.8rem;
                height: 32px;
                border-radius: 16px;
            }

            .navbar .dropdown-toggle i {
                font-size: 0.75rem;
                margin-right: 0.2rem;
            }
        }

    </style>

    @yield('styles')
</head>
<body>
    <!-- Skip to main content link for accessibility -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <div id="app">
        <!-- Top Bar -->
        <div class="top-bar d-none d-md-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <a href="mailto:info@nihsa.gov.ng"><i class="fas fa-envelope me-1"></i> info@nihsa.gov.ng</a>
                        <a href="tel:+2348012345678"><i class="fas fa-phone me-1"></i> +234 801 234 5678</a>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('search') }}"><i class="fas fa-search me-1"></i> {{ __('messages.nav.search') }}</a>
                        <a href="{{ route('login') }}"><i class="fas fa-user me-1"></i> {{ __('messages.nav.login') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="navbar navbar-expand-md main-navbar" role="navigation" aria-label="Main navigation">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" aria-label="NIHSA Home">
                    <img src="{{ asset('images/logo.png') }}" alt="Nigeria Hydrological Services Agency Logo" onerror="this.src='{{ asset('images/nihsa-logo-placeholder.svg') }}'">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Main Navigation Links -->
                    <ul class="navbar-nav me-auto" role="menubar">
                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" role="menuitem" aria-label="{{ __('messages.nav.home') }}">{{ __('messages.nav.home') }}</a>
                        </li>

                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('flood-forecast-dashboard') ? 'active' : '' }}" href="{{ route('flood-forecast-dashboard') }}" role="menuitem" aria-label="{{ __('messages.nav.flood_dashboard') }}">{{ __('messages.nav.flood_dashboard') }}</a>
                        </li>

                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('publications.index') ? 'active' : '' }}" href="{{ route('publications.index') }}" role="menuitem" aria-label="{{ __('messages.nav.publications') }}">{{ __('messages.nav.publications') }}</a>
                        </li>

                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('procurements.index') ? 'active' : '' }}" href="{{ route('procurements.index') }}" role="menuitem" aria-label="Procurements">Procurements</a>
                        </li>

                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('data-request.*') ? 'active' : '' }}" href="{{ route('data-request.create') }}" role="menuitem" aria-label="{{ __('messages.nav.data_request') }}">{{ __('messages.nav.data_request') }}</a>
                        </li>

                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('news.index') ? 'active' : '' }}" href="{{ route('news.index') }}" role="menuitem" aria-label="{{ __('messages.nav.news') }}">{{ __('messages.nav.news') }}</a>
                        </li>

                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('admin.flood-data.index') ? 'active' : '' }}" href="{{ route('admin.flood-data.index') }}" role="menuitem" aria-label="{{ __('messages.nav.flood_data') }}">{{ __('messages.nav.flood_data') }}</a>
                        </li>

                        <li class="nav-item dropdown" role="none">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('about*') ? 'active' : '' }}" href="#" id="aboutDropdown" role="menuitem" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown" aria-label="{{ __('messages.nav.about') }}">
                                {{ __('messages.nav.about') }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown" role="menu">
                                <li role="none"><a class="dropdown-item" href="{{ route('about') }}" role="menuitem">{{ __('messages.nav.functions') }}</a></li>
                                <li role="none"><a class="dropdown-item" href="{{ route('about.management') }}" role="menuitem">{{ __('messages.nav.management') }}</a></li>
                                <li role="none"><a class="dropdown-item" href="{{ route('about.structure') }}" role="menuitem">{{ __('messages.nav.structure') }}</a></li>
                                <li role="none"><a class="dropdown-item" href="{{ route('about.offices') }}" role="menuitem">{{ __('messages.nav.offices') }}</a></li>
                                <li role="none"><a class="dropdown-item" href="{{ route('about.history') }}" role="menuitem">{{ __('messages.nav.history') }}</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown" role="none">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('products.*') || request()->routeIs('services.*') ? 'active' : '' }}" href="#" id="servicesDropdown" role="menuitem" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown" aria-label="{{ __('messages.nav.services') }}">
                                {{ __('messages.nav.services') }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="servicesDropdown" role="menu">
                                <li role="none"><a class="dropdown-item {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}" role="menuitem">{{ __('messages.nav.products') }}</a></li>
                                <li role="none"><a class="dropdown-item {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}" role="menuitem">{{ __('messages.nav.services') }}</a></li>
                            </ul>
                        </li>

                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('contact.index') ? 'active' : '' }}" href="{{ route('contact.index') }}" role="menuitem" aria-label="{{ __('messages.nav.contact') }}">{{ __('messages.nav.contact') }}</a>
                        </li>
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Language Switcher -->
                        <li class="nav-item me-2">
                            <x-language-switcher />
                        </li>

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item d-md-none">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('messages.nav.login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item d-md-none">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i> {{ __('Dashboard') }}
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Breadcrumbs -->
        @if(!request()->routeIs('home'))
        <div class="breadcrumbs-section bg-light py-2" role="complementary" aria-label="Breadcrumb navigation">
            <div class="container">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="{{ route('home') }}" itemprop="item">
                                <span itemprop="name">{{ __('messages.nav.home') }}</span>
                            </a>
                            <meta itemprop="position" content="1" />
                        </li>
                        @yield('breadcrumbs')
                    </ol>
                </nav>
            </div>
        </div>
        @endif

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Main Content -->
        <main id="main-content" role="main">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5>Nigeria Hydrological Services Agency</h5>
                        <p class="mb-3">Water Resources Data for Sustainable Development</p>
                        <p class="mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i> Plot 222, Foundation Plaza,<br>
                            Shettima Ali Monguno Crescent,<br>
                            Utako, Abuja, Nigeria
                        </p>
                        <p class="mb-3">
                            <i class="fas fa-phone me-2"></i> +234 801 234 5678
                        </p>
                        <p>
                            <i class="fas fa-envelope me-2"></i> info@nihsa.gov.ng
                        </p>
                    </div>

                    <div class="col-md-2 mb-4 mb-md-0">
                        <h5>Quick Links</h5>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}">{{ __('messages.nav.home') }}</a></li>
                            <li><a href="{{ route('about') }}">{{ __('messages.nav.about') }}</a></li>
                            <li><a href="{{ route('publications.index') }}">{{ __('messages.nav.publications') }}</a></li>
                            <li><a href="{{ route('procurements.index') }}">Procurements</a></li>
                            <li><a href="{{ route('news.index') }}">{{ __('messages.nav.news') }}</a></li>
                            <li><a href="{{ route('flood-forecast-dashboard') }}">{{ __('messages.nav.flood_dashboard') }}</a></li>
                            <li><a href="{{ route('contact.index') }}">{{ __('messages.nav.contact') }}</a></li>
                        </ul>
                    </div>

                    <div class="col-md-3 mb-4 mb-md-0">
                        <h5>Resources</h5>
                        <ul class="footer-links">
                            <li><a href="#">Annual Flood Outlook</a></li>
                            <li><a href="#">Flood and Drought Bulletins</a></li>
                            <li><a href="#">Hydrological Data</a></li>
                            <li><a href="{{ route('data-request.create') }}">Request Data</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <h5>Connect With Us</h5>
                        <div class="social-icons mb-3">
                            <a href="https://facebook.com/NIHSA.NG" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/nihsa_ng" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)"><i class="fab fa-twitter"></i></a>
                            <a href="https://instagram.com/nihsa_ng" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                        <p>Subscribe to our newsletter for updates</p>
                        <form>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Your Email" aria-label="Your Email">
                                <button class="btn btn-primary" type="button">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="copyright mt-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-md-0">Copyright © {{ date('Y') }} NIHSA | Powered by NIHSA</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <a href="#" class="text-white-50 me-3">Privacy Policy</a>
                            <a href="#" class="text-white-50">Terms of Use</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Animate On Scroll Library -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- Custom NIHSA Redesign Scripts -->
    <script src="{{ asset('js/nihsa-redesign.js') }}"></script>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </a>

    @yield('scripts')
</body>
</html>
