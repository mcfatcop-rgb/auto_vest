<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AutoVest Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
            padding-top: 56px;
        }
        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            bottom: 0;
            width: 250px;
            background-color: #343a40;
            color: #fff;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            z-index: 1050;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar a:hover,
        .sidebar .active {
            background-color: #495057;
            padding-left: 25px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            min-height: calc(100vh - 56px);
            transition: margin-left 0.3s ease-in-out;
        }
        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 15px 0;
            text-align: center;
            margin-left: 250px;
            transition: margin-left 0.3s ease-in-out;
        }
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .notification-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }
        .notification-item:hover {
            background-color: #f8f9fa;
        }
        .notification-item.unread {
            background-color: #f8f9fa;
            font-weight: 500;
        }
        .notification-dropdown {
            width: 350px;
            max-height: 400px;
            overflow-y: auto;
        }
        @media (max-width: 767.98px) {
            .sidebar {
                transform: translateX(-100%);
                width: 250px;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .content, .footer {
                margin-left: 0;
            }
            #sidebarToggle {
                display: inline-block;
            }
            .notification-dropdown {
                width: 280px;
            }
        }
        #sidebarToggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #000;
        }
        .main-content-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="d-md-none me-3" id="sidebarToggle"><i class="fas fa-bars"></i></button>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <!-- Notification Dropdown -->
                    <li class="nav-item dropdown me-2">
                        <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell fs-5"></i>
                            <span class="notification-badge">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="notificationDropdown">
                            <li class="dropdown-header d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Notifications</span>
                                <small><a href="#" class="text-primary">Mark all as read</a></small>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a href="#" class="notification-item unread">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="fas fa-user-plus text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0">New user registered</h6>
                                            <small class="text-muted">John Doe just registered</small>
                                            <small class="text-muted d-block">2 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="notification-item unread">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="fas fa-check-circle text-success"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0">Investment completed</h6>
                                            <small class="text-muted">New investment has been made</small>
                                            <small class="text-muted d-block">1 hour ago</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="notification-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="fas fa-exclamation-triangle text-warning"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0">Fraud alert</h6>
                                            <small class="text-muted">Potential fraud detected</small>
                                            <small class="text-muted d-block">5 hours ago</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li class="text-center">
                                <a href="#" class="dropdown-item">View all notifications</a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- User Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}&background=random" class="profile-img me-2">
                            {{ auth()->user()->name ?? 'Admin' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <div class="d-flex align-items-center px-3 py-2">
                                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}&background=random" class="profile-img me-2">
                                    <div>
                                        <h6 class="mb-0">{{ auth()->user()->name ?? 'Admin' }}</h6>
                                        <small class="text-muted">{{ auth()->user()->email ?? 'admin@example.com' }}</small>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="#" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-content pt-3">
            <h4 class="text-center mb-4">Admin Panel</h4>
            <hr class="bg-secondary">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i>Users
            </a>
            <a href="{{ route('admin.companies') }}" class="{{ request()->routeIs('admin.companies') ? 'active' : '' }}">
                <i class="fas fa-building me-2"></i>Companies
            </a>
            <a href="{{ route('admin.investments') }}" class="{{ request()->routeIs('admin.investments') ? 'active' : '' }}">
                <i class="fas fa-chart-line me-2"></i>Investments
            </a>
            <a href="{{ route('admin.payouts') }}" class="{{ request()->routeIs('admin.payouts') ? 'active' : '' }}">
                <i class="fas fa-money-bill-wave me-2"></i>Payments
            </a>
            <a href="{{ route('admin.fraud') }}" class="{{ request()->routeIs('admin.fraud') ? 'active' : '' }}">
                <i class="fas fa-exclamation-triangle me-2"></i>Fraud Logs
            </a>
            <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <i class="fas fa-cog me-2"></i>Settings
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="content">
        <div class="main-content-card">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-md-start">
                    &copy; {{ date('Y') }} AutoVest. All rights reserved.
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="me-3">v1.0.0</span>
                    <a href="#" class="text-white me-3">Privacy Policy</a>
                    <a href="#" class="text-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebarMenu').classList.toggle('show');
        });
    </script>
</body>
</html>