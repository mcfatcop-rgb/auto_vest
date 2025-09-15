@extends('layouts.app')

@section('styles')
<style>
    .settings-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .settings-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .settings-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .settings-grid {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 2rem;
        align-items: start;
    }

    .settings-sidebar {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: sticky;
        top: 2rem;
    }

    .profile-card {
        text-align: center;
        margin-bottom: 2rem;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 2.5rem;
        color: white;
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .profile-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .profile-email {
        color: #6c757d;
        font-weight: 500;
    }

    .settings-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .settings-nav li {
        margin-bottom: 0.5rem;
    }

    .settings-nav a {
        display: flex;
        align-items: center;
        padding: 1rem 1.5rem;
        color: #6c757d;
        text-decoration: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .settings-nav a:hover {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        transform: translateX(5px);
    }

    .settings-nav a.active {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .settings-nav a i {
        margin-right: 0.75rem;
        width: 20px;
    }

    .settings-content {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .section-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(102, 126, 234, 0.1);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .section-subtitle {
        color: #6c757d;
        font-weight: 500;
    }

    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-floating .form-control {
        height: 60px;
        padding: 1rem 1rem 0.5rem;
        border: 2px solid rgba(102, 126, 234, 0.1);
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .form-floating .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        background: rgba(255, 255, 255, 0.95);
    }

    .form-floating label {
        padding: 1rem;
        color: #6c757d;
        font-weight: 500;
    }

    .form-floating .form-control:focus ~ label,
    .form-floating .form-control:not(:placeholder-shown) ~ label {
        color: #667eea;
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }

    .password-section {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid rgba(102, 126, 234, 0.1);
    }

    .btn-save {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        border-radius: 15px;
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1.1rem;
        color: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(40, 167, 69, 0.3);
    }

    .btn-save::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-save:hover::before {
        left: 100%;
    }

    .btn-save:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(40, 167, 69, 0.4);
        color: white;
    }

    .btn-save:active {
        transform: translateY(-1px);
    }

    .alert-modern {
        background: rgba(40, 167, 69, 0.1);
        border: 1px solid rgba(40, 167, 69, 0.2);
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        color: #155724;
        font-weight: 500;
        backdrop-filter: blur(10px);
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .security-section {
        margin-top: 2rem;
        padding: 2rem;
        background: rgba(102, 126, 234, 0.05);
        border-radius: 15px;
        border: 1px solid rgba(102, 126, 234, 0.1);
    }

    .security-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .security-item:last-child {
        border-bottom: none;
    }

    .security-info h6 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.25rem;
    }

    .security-info p {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 0;
    }

    .security-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-enabled {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
    }

    .status-disabled {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        color: white;
    }

    .account-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
        background: rgba(102, 126, 234, 0.05);
        border-radius: 15px;
        border: 1px solid rgba(102, 126, 234, 0.1);
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: #667eea;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    @media (max-width: 768px) {
        .settings-container {
            padding: 1rem 0;
        }

        .settings-header {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .settings-header h1 {
            font-size: 2rem;
        }

        .settings-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .settings-sidebar {
            position: static;
            order: 2;
        }

        .settings-content {
            order: 1;
            padding: 1.5rem;
        }

        .settings-nav {
            display: flex;
            overflow-x: auto;
            gap: 0.5rem;
        }

        .settings-nav li {
            margin-bottom: 0;
            flex-shrink: 0;
        }

        .settings-nav a {
            white-space: nowrap;
            padding: 0.75rem 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="settings-container">
    <div class="container">
        <!-- Settings Header -->
        <div class="settings-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-cog me-3"></i>Account Settings</h1>
                    <p class="mb-0 text-muted">Manage your account preferences and security settings</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="me-3">
                            <div class="text-muted small">Member Since</div>
                            <div class="fw-bold">{{ $user->created_at->format('M Y') }}</div>
                        </div>
                        <div class="avatar-circle">
                            <i class="fas fa-user-shield fa-3x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-modern alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="settings-grid">
            <!-- Settings Sidebar -->
            <div class="settings-sidebar">
                <div class="profile-card">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-name">{{ $user->name }}</div>
                    <div class="profile-email">{{ $user->email }}</div>
                </div>

                <ul class="settings-nav">
                    <li>
                        <a href="#profile" class="active" data-tab="profile">
                            <i class="fas fa-user"></i>Profile Information
                        </a>
                    </li>
                    <li>
                        <a href="#security" data-tab="security">
                            <i class="fas fa-shield-alt"></i>Security
                        </a>
                    </li>
                    <li>
                        <a href="#notifications" data-tab="notifications">
                            <i class="fas fa-bell"></i>Notifications
                        </a>
                    </li>
                    <li>
                        <a href="#privacy" data-tab="privacy">
                            <i class="fas fa-lock"></i>Privacy
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Settings Content -->
            <div class="settings-content">
                <!-- Profile Information Tab -->
                <div id="profile-tab" class="settings-tab active">
                    <div class="section-header">
                        <h2 class="section-title">Profile Information</h2>
                        <p class="section-subtitle">Update your personal details and contact information</p>
                    </div>

                    <form action="{{ route('regular_user.settings.update') }}" method="POST" id="profileForm">
                        @csrf

                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Full Name" required>
                            <label for="name">
                                <i class="fas fa-user me-2"></i>Full Name
                            </label>
                        </div>

                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="Email Address" disabled>
                            <label for="email">
                                <i class="fas fa-envelope me-2"></i>Email Address
                            </label>
                            <small class="text-muted">Email cannot be changed. Contact support if needed.</small>
                        </div>

                        <div class="form-floating">
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Phone Number" required>
                            <label for="phone">
                                <i class="fas fa-phone me-2"></i>Phone Number
                            </label>
                        </div>

                        <div class="password-section">
                            <h5 class="mb-3"><i class="fas fa-lock me-2"></i>Change Password</h5>
                            <p class="text-muted mb-3">Leave password fields blank to keep your current password</p>

                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password" placeholder="New Password" autocomplete="new-password">
                                <label for="password">
                                    <i class="fas fa-key me-2"></i>New Password
                                </label>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm New Password" autocomplete="new-password">
                                <label for="password_confirmation">
                                    <i class="fas fa-key me-2"></i>Confirm New Password
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-save">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </form>
                </div>

                <!-- Security Tab -->
                <div id="security-tab" class="settings-tab">
                    <div class="section-header">
                        <h2 class="section-title">Security Settings</h2>
                        <p class="section-subtitle">Manage your account security and authentication</p>
                    </div>

                    <div class="account-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ $user->created_at->diffInDays() }}</div>
                            <div class="stat-label">Days Active</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $user->transactions()->count() }}</div>
                            <div class="stat-label">Transactions</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $user->investments()->count() }}</div>
                            <div class="stat-label">Investments</div>
                        </div>
                    </div>

                    <div class="security-section">
                        <h5 class="mb-3"><i class="fas fa-shield-alt me-2"></i>Security Features</h5>
                        
                        <div class="security-item">
                            <div class="security-info">
                                <h6>Two-Factor Authentication</h6>
                                <p>Add an extra layer of security to your account</p>
                            </div>
                            <span class="security-status status-disabled">Disabled</span>
                        </div>

                        <div class="security-item">
                            <div class="security-info">
                                <h6>Login Notifications</h6>
                                <p>Get notified when someone logs into your account</p>
                            </div>
                            <span class="security-status status-enabled">Enabled</span>
                        </div>

                        <div class="security-item">
                            <div class="security-info">
                                <h6>Session Management</h6>
                                <p>Manage active sessions and device access</p>
                            </div>
                            <span class="security-status status-enabled">Enabled</span>
                        </div>
                    </div>
                </div>

                <!-- Notifications Tab -->
                <div id="notifications-tab" class="settings-tab">
                    <div class="section-header">
                        <h2 class="section-title">Notification Preferences</h2>
                        <p class="section-subtitle">Choose how you want to be notified about account activity</p>
                    </div>
                    <p class="text-muted">Notification settings will be available in a future update.</p>
                </div>

                <!-- Privacy Tab -->
                <div id="privacy-tab" class="settings-tab">
                    <div class="section-header">
                        <h2 class="section-title">Privacy Settings</h2>
                        <p class="section-subtitle">Control your data and privacy preferences</p>
                    </div>
                    <p class="text-muted">Privacy settings will be available in a future update.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Tab switching functionality
    document.querySelectorAll('.settings-nav a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs and nav links
            document.querySelectorAll('.settings-nav a').forEach(navLink => navLink.classList.remove('active'));
            document.querySelectorAll('.settings-tab').forEach(tab => tab.classList.remove('active'));
            
            // Add active class to clicked nav link
            this.classList.add('active');
            
            // Show corresponding tab
            const tabId = this.getAttribute('data-tab') + '-tab';
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Password confirmation validation
    document.getElementById('password_confirmation').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const confirmation = this.value;
        
        if (confirmation.length > 0) {
            if (password === confirmation) {
                this.style.borderColor = '#28a745';
            } else {
                this.style.borderColor = '#dc3545';
            }
        } else {
            this.style.borderColor = 'rgba(102, 126, 234, 0.1)';
        }
    });

    // Form submission with loading state
    document.getElementById('profileForm').addEventListener('submit', function() {
        const btn = this.querySelector('.btn-save');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
        btn.disabled = true;
    });

    // Add focus effects to form inputs
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });
</script>
@endsection
