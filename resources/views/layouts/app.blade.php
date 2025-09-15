<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'AutoVest Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom Modern UI CSS -->
    <link href="{{ asset('css/modern-ui.css') }}" rel="stylesheet">

<style>
        :root {
            --primary-color: #667eea; /* Modern purple-blue for trust and professionalism */
            --secondary-color: #764ba2; /* Complementary purple for premium feel */
            --background-color: #f5f7fa; /* Light gray background */
            --text-color: #2d3748; /* Dark gray for text */
            --sidebar-bg: #ffffff; /* White sidebar for clean look */
            --border-color: #e2e8f0; /* Light border for subtle separation */
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
        line-height: 1.6;
    }

    /* Navbar Styling */
    .navbar {
        background-color: var(--primary-color);
        padding: 1rem 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        background: linear-gradient(135deg, #ffffff, #f0f0f0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        border-radius: 8px;
        margin: 0 0.25rem;
        position: relative;
        overflow: hidden;
    }

    .navbar-nav .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .navbar-nav .nav-link:hover::before {
        left: 100%;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 8px;
    }

    .dropdown-item {
        font-weight: 500;
        padding: 0.5rem 1.5rem;
        transition: background-color 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: var(--background-color);
    }

    /* Sidebar Styling */
    .sidebar-nav {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border-right: 1px solid var(--glass-border);
        padding: 1rem 0;
        box-shadow: 2px 0 20px rgba(0, 0, 0, 0.05);
    }

    .sidebar-nav a {
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        color: var(--text-color) !important;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
        margin: 0.25rem 1rem;
        border-radius: 12px;
        position: relative;
        overflow: hidden;
        opacity: 1 !important;
    }

    .sidebar-nav a::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: var(--gradient-primary);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: -1;
    }

    .sidebar-nav a:hover::before,
    .sidebar-nav a.active::before {
        left: 0;
        opacity: 0.1;
    }

    .sidebar-nav a:hover,
    .sidebar-nav a.active {
        background: rgba(102, 126, 234, 0.05);
        color: var(--primary-color) !important;
        border-left-color: var(--primary-color);
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    }

    .sidebar-nav a.active {
        background: var(--gradient-primary);
        color: #ffffff !important;
        border-left-color: #ffffff;
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
    }

    .sidebar-nav .fa-icon {
        margin-right: 0.75rem;
        width: 20px;
        text-align: center;
        font-size: 1.1rem;
        color: var(--text-color);
    }

    .sidebar-nav a:hover .fa-icon,
    .sidebar-nav a.active .fa-icon {
        color: var(--primary-color); /* Match icon color with text on hover/active */
    }

    /* Mobile Sidebar Specific Fixes */
    .mobile-sidebar {
        background-color: var(--sidebar-bg);
        border-top: 1px solid var(--border-color);
    }

    .mobile-sidebar .sidebar-nav a {
        color: var(--text-color) !important; /* Override any inherited navbar styles */
        opacity: 1 !important; /* Prevent fade-out or hidden text */
    }

    .mobile-sidebar .sidebar-nav a:hover,
    .mobile-sidebar .sidebar-nav a.active {
        color: var(--primary-color) !important;
        background-color: var(--background-color);
    }

    /* Main Content */
    main {
        padding: 2rem 0;
    }

    .container {
        max-width: 1400px; /* Wider container for desktop */
    }

    /* Alerts */
    .alert {
        border-radius: 8px;
        padding: 1rem 1.5rem;
        font-weight: 500;
    }

    .alert-success {
        background-color: #e6ffed;
        color: #2d7d46;
        border: 1px solid #2d7d46;
    }

    .alert-danger {
        background-color: #ffe6e6;
        color: #d32f2f;
        border: 1px solid #d32f2f;
    }

    /* Professional Footer */
    footer {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 3rem 0 1rem;
        margin-top: auto;
        position: relative;
        overflow: hidden;
    }

    footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-primary);
    }

    footer::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(102, 126, 234, 0.05) 0%, transparent 70%);
        animation: rotate 30s linear infinite;
        pointer-events: none;
    }

    .footer-content {
        position: relative;
        z-index: 2;
    }

    .footer-section h5 {
        color: white;
        font-weight: 700;
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-section ul li {
        margin-bottom: 0.75rem;
    }

    .footer-section ul li a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    .footer-section ul li a:hover {
        color: white;
        transform: translateX(5px);
    }

    .footer-section ul li a i {
        margin-right: 0.5rem;
        width: 16px;
        text-align: center;
    }

    .footer-brand {
        text-align: center;
        margin-bottom: 2rem;
    }

    .footer-logo {
        font-size: 2rem;
        font-weight: 800;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1rem;
    }

    .footer-description {
        color: rgba(255, 255, 255, 0.7);
        max-width: 400px;
        margin: 0 auto 2rem;
        line-height: 1.6;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .social-link {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .social-link:hover {
        background: var(--gradient-primary);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 2rem;
        margin-top: 2rem;
        text-align: center;
    }

    .footer-bottom p {
        color: rgba(255, 255, 255, 0.6);
        margin: 0;
        font-size: 0.9rem;
    }

    .footer-bottom a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-bottom a:hover {
        color: white;
    }

    .newsletter-signup {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .newsletter-signup h5 {
        color: white;
        margin-bottom: 1rem;
        text-align: center;
    }

    .newsletter-form {
        display: flex;
        gap: 1rem;
        max-width: 400px;
        margin: 0 auto;
    }

    .newsletter-form input {
        flex: 1;
        padding: 0.75rem 1rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        backdrop-filter: blur(10px);
    }

    .newsletter-form input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .newsletter-form input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .newsletter-form button {
        background: var(--gradient-primary);
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .newsletter-form button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .contact-info {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .contact-item:last-child {
        margin-bottom: 0;
    }

    .contact-item i {
        margin-right: 1rem;
        width: 20px;
        color: var(--primary-color);
    }

    @media (max-width: 768px) {
        footer {
            padding: 2rem 0 1rem;
        }

        .footer-section {
            margin-bottom: 2rem;
            text-align: center;
        }

        .footer-section h5 {
            margin-bottom: 1rem;
        }

        .social-links {
            justify-content: center;
            flex-wrap: wrap;
        }

        .newsletter-form {
            flex-direction: column;
        }

        .newsletter-form button {
            width: 100%;
        }

        .contact-info {
            text-align: center;
        }

        .contact-item {
            justify-content: center;
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .mobile-sidebar {
            background-color: var(--sidebar-bg);
            border-top: 1px solid var(--border-color);
        }

        .sidebar-nav a {
            padding: 0.75rem 1rem;
        }
    }

    @media (min-width: 992px) {
        .mobile-sidebar {
            display: none !important;
        }

        .navbar-nav.ms-auto {
            gap: 0.5rem;
        }
    }
</style>
    @yield('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('regular_user.dashboard') }}">AutoVest</a>

            <!-- Mobile Sidebar Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <!-- Mobile Sidebar -->
                <div class="mobile-sidebar w-100 d-lg-none">
                    <ul class="navbar-nav sidebar-nav py-3">
                        <li><a class="nav-link {{ request()->routeIs('regular_user.dashboard') ? 'active' : '' }}" href="{{ route('regular_user.dashboard') }}"><i class="fas fa-home fa-icon"></i>Dashboard</a></li>
                        <li><a class="nav-link {{ request()->routeIs('regular_user.portfolio.*') ? 'active' : '' }}" href="{{ route('regular_user.portfolio.index') }}"><i class="fas fa-chart-line fa-icon"></i>Portfolio</a></li>
                        <li><a class="nav-link {{ request()->routeIs('regular_user.balance') ? 'active' : '' }}" href="{{ route('regular_user.balance') }}"><i class="fas fa-wallet fa-icon"></i>Balance</a></li>
                        <li><a class="nav-link {{ request()->routeIs('regular_user.transactions.*') ? 'active' : '' }}" href="{{ route('regular_user.transactions.index') }}"><i class="fas fa-exchange-alt fa-icon"></i>Transactions</a></li>
                        <li><a class="nav-link {{ request()->routeIs('regular_user.payouts.*') ? 'active' : '' }}" href="{{ route('regular_user.payouts.index') }}"><i class="fas fa-money-check-alt fa-icon"></i>Payouts</a></li>
                        <li><a class="nav-link {{ request()->routeIs('regular_user.referrals') ? 'active' : '' }}" href="{{ route('regular_user.referrals') }}"><i class="fas fa-user-friends fa-icon"></i>Referrals</a></li>
                        <li><a class="nav-link {{ request()->routeIs('regular_user.help') ? 'active' : '' }}" href="{{ route('regular_user.help') }}"><i class="fas fa-question-circle fa-icon"></i>Help</a></li>
                        <li><a class="nav-link {{ request()->routeIs('regular_user.settings') ? 'active' : '' }}" href="{{ route('regular_user.settings') }}"><i class="fas fa-cog fa-icon"></i>Settings</a></li>
                        <li><hr class="my-2"></li>
                        <li>
                            <form method="POST" action="{{ route('regular_user.logout') }}">
                                @csrf
                                <button class="nav-link text-danger w-100 text-start border-0 bg-transparent"><i class="fas fa-sign-out-alt fa-icon"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- Desktop Nav Links -->
                <ul class="navbar-nav ms-auto d-none d-lg-flex align-items-center">
                    <li><a class="nav-link {{ request()->routeIs('regular_user.dashboard') ? 'active' : '' }}" href="{{ route('regular_user.dashboard') }}"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('regular_user.portfolio.*') ? 'active' : '' }}" href="{{ route('regular_user.portfolio.index') }}">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('regular_user.balance') ? 'active' : '' }}" href="{{ route('regular_user.balance') }}">Balance</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('regular_user.transactions.*') ? 'active' : '' }}" href="{{ route('regular_user.transactions.index') }}">Transactions</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('regular_user.payouts.*') ? 'active' : '' }}" href="{{ route('regular_user.payouts.index') }}">Payouts</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('regular_user.referrals') ? 'active' : '' }}" href="{{ route('regular_user.referrals') }}">Referrals</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('regular_user.help') ? 'active' : '' }}" href="{{ route('regular_user.help') }}">Help</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2"></i> {{ auth('regular_user')->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('regular_user.settings') }}"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('regular_user.logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="container mt-4">
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
    </div>

    <!-- Main Content -->
    <main class="flex-grow-1 py-5">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Professional Footer -->
    <footer>
        <div class="container footer-content">
            <!-- Brand Section -->
            <div class="footer-brand">
                <div class="footer-logo">AutoVest</div>
                <p class="footer-description">
                    Your trusted partner in digital investment. We provide secure, transparent, and profitable investment opportunities for everyone.
                </p>
                
                <!-- Social Media Links -->
                <div class="social-links">
                    <a href="#" class="social-link" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="social-link" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="social-link" title="Telegram">
                        <i class="fab fa-telegram-plane"></i>
                    </a>
                </div>
            </div>

            <!-- Footer Sections -->
            <div class="row">
                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5>Quick Links</h5>
                        <ul>
                            <li><a href="{{ route('regular_user.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                            <li><a href="{{ route('regular_user.portfolio.index') }}"><i class="fas fa-chart-line"></i> Portfolio</a></li>
                            <li><a href="{{ route('regular_user.transactions.index') }}"><i class="fas fa-exchange-alt"></i> Transactions</a></li>
                            <li><a href="{{ route('regular_user.balance') }}"><i class="fas fa-wallet"></i> Balance</a></li>
                            <li><a href="{{ route('regular_user.settings') }}"><i class="fas fa-cog"></i> Settings</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Investment -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5>Investment</h5>
                        <ul>
                            <li><a href="#"><i class="fas fa-chart-pie"></i> Investment Plans</a></li>
                            <li><a href="#"><i class="fas fa-percentage"></i> Interest Rates</a></li>
                            <li><a href="#"><i class="fas fa-calculator"></i> ROI Calculator</a></li>
                            <li><a href="#"><i class="fas fa-shield-alt"></i> Security</a></li>
                            <li><a href="#"><i class="fas fa-file-contract"></i> Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Support -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5>Support</h5>
                        <ul>
                            <li><a href="{{ route('regular_user.help') }}"><i class="fas fa-question-circle"></i> Help Center</a></li>
                            <li><a href="#"><i class="fas fa-comments"></i> Live Chat</a></li>
                            <li><a href="#"><i class="fas fa-envelope"></i> Contact Us</a></li>
                            <li><a href="#"><i class="fas fa-file-alt"></i> Documentation</a></li>
                            <li><a href="#"><i class="fas fa-bug"></i> Report Issue</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Company -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5>Company</h5>
                        <ul>
                            <li><a href="#"><i class="fas fa-info-circle"></i> About Us</a></li>
                            <li><a href="#"><i class="fas fa-users"></i> Our Team</a></li>
                            <li><a href="#"><i class="fas fa-newspaper"></i> News & Updates</a></li>
                            <li><a href="#"><i class="fas fa-briefcase"></i> Careers</a></li>
                            <li><a href="#"><i class="fas fa-handshake"></i> Partnerships</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Newsletter Signup -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="newsletter-signup">
                        <h5><i class="fas fa-envelope me-2"></i>Stay Updated</h5>
                        <p class="text-center mb-3">Subscribe to our newsletter for the latest investment opportunities and market insights.</p>
                        <form class="newsletter-form" action="#" method="POST">
                            @csrf
                            <input type="email" name="email" placeholder="Enter your email address" required>
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-info">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>123 Investment Street<br>Financial District, Nairobi</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <span>+254 700 000 000<br>+254 20 000 000</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>info@autovest.co.ke<br>support@autovest.co.ke</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p>&copy; {{ date('Y') }} AutoVest. All rights reserved. | Licensed by Capital Markets Authority</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-0">
                            <a href="#">Privacy Policy</a> | 
                            <a href="#">Terms of Service</a> | 
                            <a href="#">Cookie Policy</a> | 
                            <a href="#">GDPR Compliance</a>
                        </p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="small mb-0">
                            <i class="fas fa-shield-alt me-1"></i>
                            Your investments are protected by industry-standard security measures and regulatory compliance.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom Modern UI JavaScript -->
        <script src="{{ asset('js/modern-ui.js') }}" defer></script>
        @yield('scripts')
</body>
</html>