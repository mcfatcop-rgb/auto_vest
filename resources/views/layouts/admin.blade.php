<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AutoVest Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #1a3c6d; /* Navy blue for trust */
            --secondary-color: #f4c430; /* Gold accent for premium feel */
            --sidebar-bg: #2d3748; /* Darker gray for sidebar */
            --sidebar-header-bg: #1f2937; /* Slightly darker for header */
            --text-color: #ffffff; /* White for sidebar text */
            --content-bg: #f5f7fa; /* Light gray for content background */
            --card-bg: #ffffff; /* White for cards */
            --border-color: #e2e8f0; /* Light border for separation */
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding-top: 60px; /* Adjusted for navbar height */
            background-color: var(--content-bg);
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1040;
            padding: 0.75rem 1rem;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-color);
        }

        .navbar .btn-dark {
            background-color: var(--sidebar-bg);
            border: none;
            padding: 0.5rem;
        }

        .navbar .nav-link {
            color: var(--text-color);
            font-weight: 500;
            padding: 0.5rem 1rem;
        }

        .navbar .dropdown-menu {
            background-color: var(--card-bg);
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
        }

        .navbar .dropdown-item {
            font-weight: 500;
            color: #2d3748;
            padding: 0.5rem 1.5rem;
            transition: background-color 0.3s ease;
        }

        .navbar .dropdown-item:hover {
            background-color: var(--content-bg);
        }

        .navbar .badge {
            font-size: 0.7rem;
            padding: 0.3em 0.6em;
        }

        .profile-img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 250px;
            height: calc(100% - 60px);
            background-color: var(--sidebar-bg);
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1030;
        }

        .sidebar.collapsed {
            transform: translateX(-250px);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .sidebar .sidebar-header {
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-color);
            background-color: var(--sidebar-header-bg);
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar a {
            color: var(--text-color);
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar a:hover,
        .sidebar .active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: var(--secondary-color);
            color: var(--secondary-color);
        }

        .sidebar a .fas {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }

        /* Content */
        .content {
            margin-left: 250px;
            padding: 1.5rem;
            transition: margin-left 0.3s ease;
            min-height: calc(100vh - 110px); /* Adjust for navbar and footer */
        }

        .content.full {
            margin-left: 0;
        }

        .main-content-card {
            background-color: var(--card-bg);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 4rem; /* Space for footer */
        }

        /* Footer */
        .footer {
            background-color: var(--primary-color);
            color: var(--text-color);
            text-align: center;
            padding: 0.75rem 0;
            font-size: 0.9rem;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1020;
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-250px);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }

            .main-content-card {
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.25rem;
            }

            .navbar .nav-link {
                font-size: 0.9rem;
            }

            .main-content-card {
                margin-bottom: 3.5rem;
            }

            .content {
                padding: 1rem;
            }
        }

        @media (min-width: 992px) {
            .sidebar {
                transform: translateX(0) !important; /* Ensure sidebar is visible on desktop */
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 250px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <button class="btn btn-dark me-2 d-lg-none" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <a class="navbar-brand" href="#">AutoVest Admin</a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    @php
                        $fraudAlerts = \App\Models\FraudLog::where('status', 'pending')->count();
                        $unreadSupport = \App\Models\SupportMessage::where('admin_read', false)->count();
                        $failedTransactions = \App\Models\Transaction::where('status', 'failed')->count();
                        $totalAlerts = $fraudAlerts + $unreadSupport + $failedTransactions;
                    @endphp
                    @if($totalAlerts > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $totalAlerts }}</span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header">Notifications</li>
                    @if($fraudAlerts > 0)
                    <li><a class="dropdown-item" href="{{ route('admin.fraud.index') }}">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                        {{ $fraudAlerts }} Fraud Alert(s)
                    </a></li>
                    @endif
                    @if($unreadSupport > 0)
                    <li><a class="dropdown-item" href="{{ route('admin.support.index') }}">
                        <i class="fas fa-headset text-warning me-2"></i>
                        {{ $unreadSupport }} Unread Support Message(s)
                    </a></li>
                    @endif
                    @if($failedTransactions > 0)
                    <li><a class="dropdown-item" href="{{ route('admin.transactions.failed') }}">
                        <i class="fas fa-credit-card text-info me-2"></i>
                        {{ $failedTransactions }} Failed Transaction(s)
                    </a></li>
                    @endif
                    @if($totalAlerts === 0)
                    <li><span class="dropdown-item-text text-muted">No new notifications</span></li>
                    @endif
                </ul>
            </li>
            <li class="nav-item dropdown ms-3">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}&background=random" class="profile-img me-2">
                    {{ auth()->user()->name ?? 'Admin' }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar" id="sidebarMenu">
    <div class="sidebar-header">Admin Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
    </a>
    <a href="{{ route('admin.companies.index') }}" class="{{ request()->routeIs('admin.companies.*') ? 'active' : '' }}">
        <i class="fas fa-car me-2"></i>Car Companies
    </a>
    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <i class="fas fa-users me-2"></i>Users
    </a>
    <a href="{{ route('admin.payouts.index') }}" class="{{ request()->routeIs('admin.payouts.*') ? 'active' : '' }}">
        <i class="fas fa-coins me-2"></i>Payouts
    </a>
    <a href="{{ route('admin.payments') }}" class="{{ request()->routeIs('admin.payments') ? 'active' : '' }}">
        <i class="fas fa-credit-card me-2"></i>Transactions
    </a>
    <a href="{{ route('admin.reports.earnings') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
        <i class="fas fa-chart-line me-2"></i>Reports
    </a>
    <a href="{{ route('admin.fraud.index') }}" class="{{ request()->routeIs('admin.fraud.*') ? 'active' : '' }}">
        <i class="fas fa-shield-alt me-2"></i>Fraud Management
    </a>
    <a href="{{ route('admin.support.index') }}" class="{{ request()->routeIs('admin.support.*') ? 'active' : '' }}">
        <i class="fas fa-headset me-2"></i>Support Messages
    </a>
    <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
        <i class="fas fa-cog me-2"></i>Settings
    </a>
</div>

<!-- Main Content -->
<main class="content" id="mainContent">
    <div class="main-content-card">
        @yield('content')
    </div>
</main>

<!-- Footer -->
<footer class="footer">
    © {{ date('Y') }} AutoVest. All rights reserved.
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebarMenu');
    const content = document.getElementById('mainContent');

    sidebarToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('full');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 991.98 && !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
            sidebar.classList.remove('show');
            sidebar.classList.add('collapsed');
            content.classList.add('full');
        }
    });
</script>
</body>
</html>