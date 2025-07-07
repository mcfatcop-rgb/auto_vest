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
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding-top: 56px;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .navbar {
            z-index: 1040;
        }
        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            width: 250px;
            height: calc(100% - 56px);
            background-color: #343a40;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1030;
        }
        .sidebar.collapsed {
            transform: translateX(-250px);
        }
        .sidebar .sidebar-header {
            padding: 1rem;
            font-size: 1.2rem;
            background-color: #23272b;
            text-align: center;
            font-weight: bold;
            color: #fff;
            border-bottom: 1px solid #495057;
        }
        .sidebar a {
            color: #fff;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            transition: background 0.2s, padding-left 0.2s;
        }
        .sidebar a:hover,
        .sidebar .active {
            background-color: #495057;
            padding-left: 25px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .content.full {
            margin-left: 0;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            height: 50px;
            width: 100%;
            background-color: #343a40;
            color: white;
            text-align: center;
            line-height: 50px;
            z-index: 1020;
        }
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .main-content-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 70px;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <button class="btn btn-dark me-2 d-lg-none" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <a class="navbar-brand" href="#">AutoVest Admin</a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header">Notifications</li>
                    <li><a class="dropdown-item" href="#">New user registered</a></li>
                    <li><a class="dropdown-item" href="#">New investment made</a></li>
                    <li><a class="dropdown-item" href="#">Fraud alert detected</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown ms-3">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
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
    <div class="sidebar-header">Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
    </a>
    <a href="{{ route('admin.companies.index') }}" class="{{ request()->routeIs('companies.*') ? 'active' : '' }}">
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
    &copy; {{ date('Y') }} AutoVest. All rights reserved.
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebarMenu');
    const content = document.getElementById('mainContent');

    sidebarToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('full');
    });
</script>
</body>
</html>
