@extends('layouts.app')

@section('styles')
<style>
    /* Modern Dashboard Styles */
    .dashboard-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .dashboard-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .dashboard-header h2 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .dashboard-header p {
        font-size: 1.1rem;
        color: #6c757d;
        font-weight: 500;
    }

    /* Modern Summary Cards */
    .summary-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
        position: relative;
    }

    .summary-card::before {
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

    .summary-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .summary-card:hover::before {
        transform: scaleX(1);
    }

    .summary-card .card-body {
        padding: 2rem;
        position: relative;
    }

    .summary-card .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .summary-card h6 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    .summary-card h3 {
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
        color: #2c3e50;
    }

    .summary-card .trend {
        display: flex;
        align-items: center;
        margin-top: 0.5rem;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .trend-up {
        color: #28a745;
    }

    .trend-down {
        color: #dc3545;
    }

    /* Quick Actions */
    .quick-actions {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .quick-actions h5 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .quick-actions .btn {
        padding: 1rem 2rem;
        font-weight: 600;
        border-radius: 15px;
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
        margin: 0.5rem;
        min-width: 160px;
    }

    .quick-actions .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .quick-actions .btn:hover::before {
        left: 100%;
    }

    .btn-invest {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-invest:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-balance {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
        box-shadow: 0 10px 20px rgba(17, 153, 142, 0.3);
    }

    .btn-balance:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(17, 153, 142, 0.4);
        color: white;
    }

    .btn-referrals {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        color: white;
        box-shadow: 0 10px 20px rgba(255, 107, 107, 0.3);
    }

    .btn-referrals:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(255, 107, 107, 0.4);
        color: white;
    }

    .btn-settings {
        background: linear-gradient(135deg, #a8edea, #fed6e3);
        color: #2c3e50;
        box-shadow: 0 10px 20px rgba(168, 237, 234, 0.3);
    }

    .btn-settings:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(168, 237, 234, 0.4);
        color: #2c3e50;
    }

    /* Transactions Card */
    .transactions-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .transactions-card .card-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 1.5rem;
        border: none;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .transactions-card .table {
        margin: 0;
    }

    .transactions-card .table th {
        background: rgba(102, 126, 234, 0.1);
        border: none;
        padding: 1rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .transactions-card .table td {
        padding: 1rem;
        border: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        vertical-align: middle;
    }

    .transactions-card .table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    .status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-completed {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
    }

    .status-pending {
        background: linear-gradient(135deg, #ffa726, #ff7043);
        color: white;
    }

    .status-failed {
        background: linear-gradient(135deg, #ef5350, #e53935);
        color: white;
    }

    /* Investments Card */
    .investments-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .investments-card .card-header {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
        padding: 1.5rem;
        border: none;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .investment-item {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }

    .investment-item:hover {
        background: rgba(17, 153, 142, 0.05);
        transform: translateX(10px);
    }

    .investment-item:last-child {
        border-bottom: none;
    }

    .investment-item strong {
        font-size: 1.1rem;
        color: #2c3e50;
        font-weight: 700;
    }

    .investment-item span {
        font-size: 1.2rem;
        font-weight: 800;
        color: #11998e;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem 0;
        }

        .dashboard-header {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .dashboard-header h2 {
            font-size: 2rem;
        }

        .summary-card .card-body {
            padding: 1.5rem;
        }

        .summary-card h3 {
            font-size: 1.5rem;
        }

        .quick-actions .btn {
            min-width: 140px;
            padding: 0.8rem 1.5rem;
        }
    }

    /* Animation Classes */
    .fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    .slide-up {
        animation: slideUp 0.6s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { 
            opacity: 0;
            transform: translateY(30px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-container">
    <div class="container">
        <!-- Hero Header -->
        <div class="dashboard-header fade-in">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2>Welcome back, {{ auth('regular_user')->user()->name }}! 👋</h2>
                    <p class="mb-0">Here's your investment portfolio overview and recent activity</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="me-3">
                            <div class="text-muted small">Last Login</div>
                            <div class="fw-bold">{{ now()->format('M d, Y') }}</div>
                        </div>
                        <div class="avatar-circle">
                            <i class="fas fa-user-circle fa-3x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="summary-card slide-up" style="animation-delay: 0.1s">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h6>Total Balance</h6>
                        <h3>KSh {{ number_format($totalBalance, 2) }}</h3>
                        <div class="trend trend-up">
                            <i class="fas fa-arrow-up me-1"></i>
                            <span>+5.2% from last month</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card slide-up" style="animation-delay: 0.2s">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h6>Total Invested</h6>
                        <h3>KSh {{ number_format($totalInvested, 2) }}</h3>
                        <div class="trend trend-up">
                            <i class="fas fa-arrow-up me-1"></i>
                            <span>+12.8% this quarter</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card slide-up" style="animation-delay: 0.3s">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h6>Referrals</h6>
                        <h3>{{ $referralsCount }}</h3>
                        <div class="trend trend-up">
                            <i class="fas fa-arrow-up me-1"></i>
                            <span>+2 this week</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions slide-up" style="animation-delay: 0.4s">
            <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a href="{{ route('regular_user.portfolio.create') }}" class="btn btn-invest">
                        <i class="fas fa-plus-circle me-2"></i>New Investment
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('regular_user.balance') }}" class="btn btn-balance">
                        <i class="fas fa-wallet me-2"></i>View Balance
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('regular_user.referrals') }}" class="btn btn-referrals">
                        <i class="fas fa-user-friends me-2"></i>My Referrals
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('regular_user.settings') }}" class="btn btn-settings">
                        <i class="fas fa-cog me-2"></i>Settings
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="transactions-card slide-up" style="animation-delay: 0.5s">
                    <div class="card-header">
                        <i class="fas fa-exchange-alt me-2"></i>Recent Transactions
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-calendar me-1"></i>Date</th>
                                        <th><i class="fas fa-tag me-1"></i>Type</th>
                                        <th><i class="fas fa-money-bill me-1"></i>Amount</th>
                                        <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentTransactions as $tx)
                                        <tr>
                                            <td>
                                                <div class="fw-bold">{{ $tx->created_at->format('M d') }}</div>
                                                <small class="text-muted">{{ $tx->created_at->format('Y') }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark px-3 py-2">
                                                    <i class="fas fa-{{ $tx->type === 'deposit' ? 'arrow-down' : 'arrow-up' }} me-1"></i>
                                                    {{ ucfirst($tx->type) }}
                                                </span>
                                            </td>
                                            <td class="fw-bold">KSh {{ number_format($tx->amount, 2) }}</td>
                                            <td>
                                                <span class="status status-{{ strtolower($tx->status) }}">
                                                    {{ ucfirst($tx->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                <div class="text-muted">No transactions yet</div>
                                                <small>Your transaction history will appear here</small>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Investments -->
            <div class="col-lg-4">
                <div class="investments-card slide-up" style="animation-delay: 0.6s">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-2"></i>My Investments
                    </div>
                    <div class="card-body p-0">
                        @forelse ($investments as $inv)
                            <div class="investment-item">
                                <div>
                                    <strong>{{ $inv->company->name }}</strong>
                                    <div class="small text-muted">Invested {{ $inv->created_at->format('M Y') }}</div>
                                </div>
                                <span>KSh {{ number_format($inv->amount, 2) }}</span>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                                <div class="text-muted">No investments yet</div>
                                <small>Start your investment journey today!</small>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection