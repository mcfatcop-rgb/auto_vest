@extends('layouts.app')

@section('styles')
<style>
    .balance-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .balance-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .balance-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .balance-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .balance-display {
        text-align: center;
        padding: 3rem 2rem;
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .balance-display::before {
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

    .balance-amount {
        font-size: 3.5rem;
        font-weight: 900;
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
    }

    .balance-label {
        font-size: 1.2rem;
        font-weight: 600;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }

    .balance-actions {
        padding: 2rem;
        background: rgba(255, 255, 255, 0.95);
    }

    .btn-deposit {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 15px;
        padding: 1rem 2rem;
        font-weight: 600;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-deposit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-deposit:hover::before {
        left: 100%;
    }

    .btn-deposit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-withdraw {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        color: white;
        border: none;
        border-radius: 15px;
        padding: 1rem 2rem;
        font-weight: 600;
        box-shadow: 0 10px 20px rgba(255, 107, 107, 0.3);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-withdraw::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-withdraw:hover::before {
        left: 100%;
    }

    .btn-withdraw:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(255, 107, 107, 0.4);
        color: white;
    }

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

    .transactions-table {
        margin: 0;
    }

    .transactions-table th {
        background: rgba(102, 126, 234, 0.1);
        border: none;
        padding: 1rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .transactions-table td {
        padding: 1rem;
        border: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        vertical-align: middle;
    }

    .transactions-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    .transaction-type {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .transaction-type.deposit {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
    }

    .transaction-type.withdrawal {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        color: white;
    }

    .status-badge {
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

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .balance-container {
            padding: 1rem 0;
        }

        .balance-header {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .balance-header h1 {
            font-size: 2rem;
        }

        .balance-amount {
            font-size: 2.5rem;
        }

        .balance-actions .btn {
            width: 100%;
            margin-bottom: 1rem;
        }

        .balance-actions .btn:last-child {
            margin-bottom: 0;
        }
    }
</style>
@endsection

@section('content')
<div class="balance-container">
    <div class="container">
        <!-- Balance Header -->
        <div class="balance-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-wallet me-3"></i>Account Balance</h1>
                    <p class="mb-0 text-muted">Manage your funds and track transaction history</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="me-3">
                            <div class="text-muted small">Account Status</div>
                            <div class="fw-bold text-success">Active</div>
                        </div>
                        <div class="avatar-circle">
                            <i class="fas fa-shield-alt fa-3x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Balance Display -->
        <div class="balance-card">
            <div class="balance-display">
                <div class="balance-amount">KSh {{ number_format($balance, 2) }}</div>
                <div class="balance-label">Available Balance</div>
            </div>
            <div class="balance-actions">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <button class="btn btn-deposit w-100">
                            <i class="fas fa-plus-circle me-2"></i>Deposit Funds
                        </button>
                    </div>
                    <div class="col-md-6 mb-3">
                        <button class="btn btn-withdraw w-100">
                            <i class="fas fa-minus-circle me-2"></i>Request Withdrawal
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="transactions-card">
            <div class="card-header">
                <i class="fas fa-exchange-alt me-2"></i>Recent Transactions
            </div>
            <div class="card-body p-0">
                @if($transactions->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h5>No Transactions Yet</h5>
                        <p class="text-muted">Your transaction history will appear here</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table transactions-table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-calendar me-1"></i>Date</th>
                                    <th><i class="fas fa-tag me-1"></i>Type</th>
                                    <th><i class="fas fa-money-bill me-1"></i>Amount</th>
                                    <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $tx)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $tx->created_at->format('M d') }}</div>
                                            <small class="text-muted">{{ $tx->created_at->format('Y') }}</small>
                                        </td>
                                        <td>
                                            <span class="transaction-type {{ strtolower($tx->type) }}">
                                                <i class="fas fa-{{ $tx->type === 'deposit' ? 'arrow-down' : 'arrow-up' }} me-1"></i>
                                                {{ ucfirst($tx->type) }}
                                            </span>
                                        </td>
                                        <td class="fw-bold">KSh {{ number_format($tx->amount, 2) }}</td>
                                        <td>
                                            <span class="status-badge status-{{ strtolower($tx->status) }}">
                                                {{ ucfirst($tx->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <div class="text-muted">No recent transactions</div>
                                            <small>Your transaction history will appear here</small>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
