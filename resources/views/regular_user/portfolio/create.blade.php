@extends('layouts.app')

@section('styles')
<style>
    .investment-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .investment-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .investment-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .investment-form-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .company-selection {
        margin-bottom: 2rem;
    }

    .company-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border: 2px solid rgba(102, 126, 234, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .company-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .company-card:hover {
        border-color: #667eea;
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
    }

    .company-card:hover::before {
        transform: scaleX(1);
    }

    .company-card.selected {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
    }

    .company-card.selected::before {
        transform: scaleX(1);
    }

    .company-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .company-logo {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        flex-shrink: 0;
    }

    .company-details h5 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .company-details p {
        color: #6c757d;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .company-stats {
        display: flex;
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .stat-item {
        background: rgba(102, 126, 234, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #667eea;
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

    .amount-inputs {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .quick-amount-btn {
        background: rgba(102, 126, 234, 0.1);
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-weight: 600;
        color: #667eea;
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
    }

    .quick-amount-btn:hover,
    .quick-amount-btn.active {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-color: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .calculator-section {
        background: rgba(102, 126, 234, 0.05);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(102, 126, 234, 0.1);
    }

    .calculator-section h6 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .calculation-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .calculation-item:last-child {
        border-bottom: none;
        font-weight: 700;
        font-size: 1.1rem;
        color: #28a745;
    }

    .calculation-label {
        color: #6c757d;
        font-weight: 500;
    }

    .calculation-value {
        font-weight: 600;
        color: #2c3e50;
    }

    .btn-invest {
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

    .btn-invest::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-invest:hover::before {
        left: 100%;
    }

    .btn-invest:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(40, 167, 69, 0.4);
        color: white;
    }

    .btn-invest:active {
        transform: translateY(-1px);
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

    .investment-tips {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .investment-tips h5 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tip-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .tip-item:last-child {
        border-bottom: none;
    }

    .tip-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.8rem;
        flex-shrink: 0;
        margin-top: 0.25rem;
    }

    .tip-content {
        flex: 1;
    }

    .tip-content h6 {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.25rem;
    }

    .tip-content p {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 0;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .investment-container {
            padding: 1rem 0;
        }

        .investment-header {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .investment-header h1 {
            font-size: 2rem;
        }

        .company-info {
            flex-direction: column;
            text-align: center;
        }

        .company-stats {
            justify-content: center;
        }

        .amount-inputs {
            grid-template-columns: repeat(2, 1fr);
        }

        .quick-amount-btn {
            padding: 0.5rem;
            font-size: 0.9rem;
        }
    }
</style>
@endsection

@section('content')
<div class="investment-container">
    <div class="container">
        <!-- Investment Header -->
        <div class="investment-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-chart-line me-3"></i>Create New Investment</h1>
                    <p class="mb-0 text-muted">Choose your investment and start earning returns today</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="me-3">
                            <div class="text-muted small">Available Balance</div>
                            <div class="fw-bold">KSh {{ number_format(auth('regular_user')->user()->balance ?? 0, 2) }}</div>
                        </div>
                        <div class="avatar-circle">
                            <i class="fas fa-coins fa-3x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Investment Form -->
            <div class="col-lg-8">
                <div class="investment-form-card">
                    {{-- Error messages --}}
                    @if($errors->any())
                        <div class="alert alert-modern">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('regular_user.portfolio.store') }}" method="POST" id="investmentForm">
                        @csrf

                        <!-- Company Selection -->
                        <div class="company-selection">
                            <h5 class="mb-3"><i class="fas fa-building me-2"></i>Select Investment Company</h5>
                            <div class="row">
                                @foreach($companies as $company)
                                <div class="col-md-6 mb-3">
                                    <div class="company-card" onclick="selectCompany({{ $company->id }}, '{{ $company->name }}', {{ $company->interest_rate ?? 15 }})">
                                        <div class="company-info">
                                            <div class="company-logo">
                                                <i class="fas fa-car"></i>
                                            </div>
                                            <div class="company-details">
                                                <h5>{{ $company->name }}</h5>
                                                <p>{{ $company->description ?? 'Leading automotive company with strong market presence' }}</p>
                                                <div class="company-stats">
                                                    <span class="stat-item">{{ $company->interest_rate ?? 15 }}% ROI</span>
                                                    <span class="stat-item">Min: KSh 1,000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="company_id" id="selected_company_id" required>
                        </div>

                        <!-- Investment Amount -->
                        <div class="form-floating">
                            <input type="number" class="form-control" id="amount" name="amount" min="1000" step="100" placeholder="Investment Amount" required>
                            <label for="amount">
                                <i class="fas fa-money-bill me-2"></i>Investment Amount (KES)
                            </label>
                        </div>

                        <!-- Quick Amount Selection -->
                        <div class="amount-inputs">
                            <div class="quick-amount-btn" onclick="setAmount(1000)">KSh 1,000</div>
                            <div class="quick-amount-btn" onclick="setAmount(5000)">KSh 5,000</div>
                            <div class="quick-amount-btn" onclick="setAmount(10000)">KSh 10,000</div>
                            <div class="quick-amount-btn" onclick="setAmount(25000)">KSh 25,000</div>
                            <div class="quick-amount-btn" onclick="setAmount(50000)">KSh 50,000</div>
                            <div class="quick-amount-btn" onclick="setAmount(100000)">KSh 100,000</div>
                        </div>

                        <!-- ROI Calculator -->
                        <div class="calculator-section">
                            <h6><i class="fas fa-calculator me-2"></i>Investment Calculator</h6>
                            <div class="calculation-item">
                                <span class="calculation-label">Investment Amount:</span>
                                <span class="calculation-value" id="calc-amount">KSh 0</span>
                            </div>
                            <div class="calculation-item">
                                <span class="calculation-label">Expected ROI:</span>
                                <span class="calculation-value" id="calc-roi">0%</span>
                            </div>
                            <div class="calculation-item">
                                <span class="calculation-label">Monthly Returns:</span>
                                <span class="calculation-value" id="calc-monthly">KSh 0</span>
                            </div>
                            <div class="calculation-item">
                                <span class="calculation-label">Annual Returns:</span>
                                <span class="calculation-value" id="calc-annual">KSh 0</span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-invest" id="investBtn">
                            <i class="fas fa-chart-line me-2"></i>Invest Now
                        </button>
                    </form>
                </div>
            </div>

            <!-- Investment Tips -->
            <div class="col-lg-4">
                <div class="investment-tips">
                    <h5><i class="fas fa-lightbulb me-2"></i>Investment Tips</h5>
                    
                    <div class="tip-item">
                        <div class="tip-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="tip-content">
                            <h6>Diversify Your Portfolio</h6>
                            <p>Consider investing in multiple companies to spread your risk and maximize returns.</p>
                        </div>
                    </div>

                    <div class="tip-item">
                        <div class="tip-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="tip-content">
                            <h6>Start Small, Scale Up</h6>
                            <p>Begin with smaller investments to understand the process before committing larger amounts.</p>
                        </div>
                    </div>

                    <div class="tip-item">
                        <div class="tip-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="tip-content">
                            <h6>Long-term Perspective</h6>
                            <p>Automotive investments typically perform better over longer periods. Think long-term growth.</p>
                        </div>
                    </div>

                    <div class="tip-item">
                        <div class="tip-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="tip-content">
                            <h6>Monitor Performance</h6>
                            <p>Regularly check your portfolio to track performance and make informed decisions.</p>
                        </div>
                    </div>

                    <div class="tip-item">
                        <div class="tip-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="tip-content">
                            <h6>Stay Informed</h6>
                            <p>Keep up with automotive industry trends and company performance to make better investment choices.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedCompany = null;
    let selectedROI = 15;

    function selectCompany(companyId, companyName, roi) {
        // Remove previous selection
        document.querySelectorAll('.company-card').forEach(card => {
            card.classList.remove('selected');
        });
        
        // Add selection to clicked card
        event.currentTarget.classList.add('selected');
        
        // Set form values
        selectedCompany = companyId;
        selectedROI = roi;
        document.getElementById('selected_company_id').value = companyId;
        
        // Update calculator
        updateCalculator();
    }

    function setAmount(amount) {
        document.getElementById('amount').value = amount;
        
        // Update quick amount buttons
        document.querySelectorAll('.quick-amount-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        event.currentTarget.classList.add('active');
        
        // Update calculator
        updateCalculator();
    }

    function updateCalculator() {
        const amount = parseFloat(document.getElementById('amount').value) || 0;
        const roi = selectedROI || 15;
        
        // Update display values
        document.getElementById('calc-amount').textContent = `KSh ${amount.toLocaleString()}`;
        document.getElementById('calc-roi').textContent = `${roi}%`;
        
        const monthlyReturn = (amount * roi / 100) / 12;
        const annualReturn = amount * roi / 100;
        
        document.getElementById('calc-monthly').textContent = `KSh ${monthlyReturn.toLocaleString()}`;
        document.getElementById('calc-annual').textContent = `KSh ${annualReturn.toLocaleString()}`;
    }

    // Add event listeners
    document.getElementById('amount').addEventListener('input', function() {
        // Remove active class from quick amount buttons
        document.querySelectorAll('.quick-amount-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        updateCalculator();
    });

    // Form submission with loading state
    document.getElementById('investmentForm').addEventListener('submit', function(e) {
        if (!selectedCompany) {
            e.preventDefault();
            alert('Please select a company to invest in.');
            return;
        }
        
        const btn = document.getElementById('investBtn');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing Investment...';
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
