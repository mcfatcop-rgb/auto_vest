<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - AutoVest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }

        /* Animated Background Elements */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .register-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 500px;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            position: relative;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            text-align: center;
            padding: 2.5rem 2rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .card-header h4 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }

        .card-header p {
            font-size: 1rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        .card-body {
            padding: 2.5rem 2rem;
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

        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .strength-bar {
            height: 4px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 2px;
            overflow: hidden;
            margin-top: 0.25rem;
        }

        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #dc3545; width: 25%; }
        .strength-fair { background: #ffc107; width: 50%; }
        .strength-good { background: #17a2b8; width: 75%; }
        .strength-strong { background: #28a745; width: 100%; }

        .btn-register {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(40, 167, 69, 0.3);
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(40, 167, 69, 0.4);
            color: white;
        }

        .btn-register:active {
            transform: translateY(-1px);
        }

        .login-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .login-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .login-link a:hover::after {
            width: 100%;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        .alert-modern {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.2);
            border-radius: 15px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            color: #721c24;
            font-weight: 500;
            backdrop-filter: blur(10px);
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 1rem;
        }

        .logo-section i {
            font-size: 3rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .form-row {
            display: flex;
            gap: 1rem;
        }

        .form-row .form-floating {
            flex: 1;
        }

        @media (max-width: 576px) {
            .register-container {
                padding: 0.5rem;
            }

            .card-header {
                padding: 2rem 1.5rem 1.5rem;
            }

            .card-header h4 {
                font-size: 1.5rem;
            }

            .card-body {
                padding: 2rem 1.5rem;
            }

            .form-floating .form-control {
                height: 55px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        /* Loading Animation */
        .btn-register.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-register.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid transparent;
            border-top: 2px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .terms-checkbox {
            margin-bottom: 2rem;
            padding-left: 2.5rem;
        }

        .terms-checkbox .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
            margin-top: 0.125rem;
            margin-left: -2.5rem;
            border: 2px solid rgba(102, 126, 234, 0.3);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .terms-checkbox .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .terms-checkbox .form-check-label {
            font-weight: 500;
            color: #495057;
            cursor: pointer;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="register-card">
        <div class="card-header">
            <div class="logo-section">
                <i class="fas fa-user-plus"></i>
            </div>
            <h4>Join AutoVest!</h4>
            <p>Create your investment account today</p>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-modern">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('regular_user.register') }}" id="registerForm">
                @csrf

                <div class="form-floating">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Full Name" required>
                    <label for="name">
                        <i class="fas fa-user me-2"></i>Full Name
                    </label>
                </div>

                <div class="form-floating">
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" required>
                    <label for="phone">
                        <i class="fas fa-phone me-2"></i>Phone Number
                    </label>
                </div>

                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                    <label for="email">
                        <i class="fas fa-envelope me-2"></i>Email Address
                    </label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Create Password" required>
                    <label for="password">
                        <i class="fas fa-lock me-2"></i>Create Password
                    </label>
                    <div class="password-strength" id="passwordStrength"></div>
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthBar"></div>
                    </div>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                    <label for="password_confirmation">
                        <i class="fas fa-lock me-2"></i>Confirm Password
                    </label>
                </div>

                <div class="terms-checkbox">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">
                        I agree to the <a href="#" style="color: #667eea;">Terms of Service</a> and <a href="#" style="color: #667eea;">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="btn btn-register" id="registerBtn">
                    <i class="fas fa-user-plus me-2"></i>Create Account
                </button>
            </form>

            <div class="login-link">
                <p class="mb-0">Already have an account?</p>
                <a href="{{ route('regular_user.login') }}">
                    <i class="fas fa-sign-in-alt me-1"></i>Sign In
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Password strength checker
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('passwordStrength');
        
        let strength = 0;
        let strengthLabel = '';
        let strengthClass = '';
        
        if (password.length >= 6) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;
        
        switch(strength) {
            case 0:
            case 1:
                strengthLabel = 'Weak';
                strengthClass = 'strength-weak';
                break;
            case 2:
                strengthLabel = 'Fair';
                strengthClass = 'strength-fair';
                break;
            case 3:
            case 4:
                strengthLabel = 'Good';
                strengthClass = 'strength-good';
                break;
            case 5:
                strengthLabel = 'Strong';
                strengthClass = 'strength-strong';
                break;
        }
        
        strengthBar.className = 'strength-fill ' + strengthClass;
        strengthText.textContent = password.length > 0 ? 'Password strength: ' + strengthLabel : '';
    });

    // Password confirmation checker
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

    // Add loading state to register button
    document.getElementById('registerForm').addEventListener('submit', function() {
        const btn = document.getElementById('registerBtn');
        btn.classList.add('loading');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Account...';
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

</body>
</html>
