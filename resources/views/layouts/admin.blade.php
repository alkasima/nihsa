<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Dashboard - Nigeria Hydrological Services Agency">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - NIHSA</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700|Roboto:400,500,700" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Fix for shaking issue -->
    <link rel="stylesheet" href="{{ asset('css/fix-shaking.css') }}">

    <!-- Additional Styles -->
    <style>
        :root {
            --primary-color: #0056b3;
            --secondary-color: #28a745;
            --accent-color: #17a2b8;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
        }

        .admin-header {
            background-color: var(--dark-color);
            color: white;
            padding: 1rem 0;
        }

        .admin-sidebar {
            background-color: var(--dark-color);
            color: white;
            min-height: calc(100vh - 56px);
            position: sticky;
            top: 56px;
        }

        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 0.75rem 1rem;
            border-left: 3px solid transparent;
        }

        .admin-sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .admin-sidebar .nav-link.active {
            color: white;
            border-left-color: var(--primary-color);
            background-color: rgba(0, 0, 0, 0.2);
        }

        .admin-sidebar .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }

        .admin-content {
            padding: 2rem;
        }

        .card-dashboard {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-dashboard:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .card-dashboard .card-body {
            padding: 1.5rem;
        }

        .card-dashboard .icon {
            font-size: 2.5rem;
            color: var(--primary-color);
        }

        .card-dashboard .count {
            font-size: 2rem;
            font-weight: 700;
        }

        .card-dashboard .title {
            font-size: 1rem;
            color: #6c757d;
        }

        .table-admin th {
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .btn-icon {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .dropdown-menu {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: none;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
        }
    </style>

    @yield('styles')
</head>
<body>
    <div id="app">
        <!-- Admin Header -->
        <header class="admin-header">
            <nav class="navbar navbar-expand-md navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> NIHSA Admin
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="adminNavbar">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}" target="_blank">
                                    <i class="fas fa-external-link-alt me-1"></i> View Site
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name ?? 'Guest' }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user me-2"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-cog me-2"></i> Settings
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container-fluid">
            <div class="row">
                <!-- Admin Sidebar -->
                <nav class="col-md-3 col-lg-2 d-md-block admin-sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.news*') ? 'active' : '' }}" href="{{ route('admin.news.index') }}">
                                    <i class="fas fa-newspaper"></i> News Management
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.publications*') ? 'active' : '' }}" href="{{ route('admin.publications.index') }}">
                                    <i class="fas fa-file-alt"></i> Publications
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.flood-data*') ? 'active' : '' }}" href="{{ route('admin.flood-data.index') }}">
                                    <i class="fas fa-water"></i> Flood Data
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.data-requests*') ? 'active' : '' }}" href="{{ route('admin.data-requests.index') }}">
                                    <i class="fas fa-clipboard-list"></i> Data Requests
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                                    <i class="fas fa-envelope"></i> Contact Messages
                                    @if($unreadContacts ?? false)
                                        <span class="badge bg-danger ms-1">{{ $unreadContacts }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.zonal-offices*') ? 'active' : '' }}" href="{{ route('admin.zonal-offices.index') }}">
                                    <i class="fas fa-building"></i> Zonal Offices
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.partners*') ? 'active' : '' }}" href="{{ route('admin.partners.index') }}">
                                    <i class="fas fa-handshake"></i> Partners
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                    <i class="fas fa-users"></i> User Management
                                </a>
                            </li>
                            {{-- Settings menu hidden as requested --}}
                            {{-- <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}" href="{{ route('admin.settings.general') }}">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                            </li> --}}
                        </ul>

                        {{-- Reports section hidden as requested --}}
                        {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Reports</span>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.reports.analytics') ? 'active' : '' }}" href="{{ route('admin.reports.analytics') }}">
                                    <i class="fas fa-chart-bar"></i> Website Analytics
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.reports.flood-data') ? 'active' : '' }}" href="{{ route('admin.reports.flood-data') }}">
                                    <i class="fas fa-water"></i> Flood Data Visualization
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.reports.downloads') ? 'active' : '' }}" href="{{ route('admin.reports.downloads') }}">
                                    <i class="fas fa-download"></i> Downloadable Reports
                                </a>
                            </li>
                        </ul> --}}
                    </div>
                </nav>

                <!-- Main Content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 admin-content">
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

                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
