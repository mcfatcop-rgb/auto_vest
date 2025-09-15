@extends('layouts.app')

@section('styles')
<style>
    .transactions-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .transactions-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .transactions-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .filters-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .filter-group {
        display: flex;
        gap: 1rem;
        align-items: end;
        flex-wrap: wrap;
    }

    .filter-item {
        flex: 1;
        min-width: 200px;
    }

    .filter-item label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        display: block;
    }

    .filter-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid rgba(102, 126, 234, 0.1);
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .filter-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        outline: none;
    }

    .btn-filter {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 15px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
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
        padding: 1.5rem 1rem;
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .transactions-table td {
        padding: 1.5rem 1rem;
        border: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        vertical-align: middle;
        font-weight: 500;
    }

    .transactions-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    .transaction-date {
        font-weight: 700;
        color: #2c3e50;
    }

    .transaction-date small {
        display: block;
        color: #6c757d;
        font-weight: 400;
        margin-top: 0.25rem;
    }

    .transaction-type {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .transaction-type.deposit {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
    }

    .transaction-type.withdrawal {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        color: white;
    }

    .transaction-type.investment {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .transaction-type.refund {
        background: linear-gradient(135deg, #ffa726, #ff7043);
        color: white;
    }

    .transaction-amount {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2c3e50;
    }

    .transaction-amount.positive {
        color: #28a745;
    }

    .transaction-amount.negative {
        color: #dc3545;
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

    .transaction-reference {
        font-family: 'Courier New', monospace;
        background: rgba(0, 0, 0, 0.05);
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        font-size: 0.85rem;
        color: #6c757d;
    }

    .btn-view {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: #2c3e50;
    }

    .pagination-wrapper {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 1.5rem;
        margin-top: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: flex;
        justify-content: center;
    }

    .pagination .page-link {
        background: rgba(255, 255, 255, 0.8);
        border: 2px solid rgba(102, 126, 234, 0.1);
        color: #667eea;
        margin: 0 0.25rem;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background: #667eea;
        border-color: #667eea;
        color: white;
        transform: translateY(-2px);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-color: #667eea;
        color: white;
    }

    .summary-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 1rem;
        color: white;
    }

    .stat-icon.deposits {
        background: linear-gradient(135deg, #11998e, #38ef7d);
    }

    .stat-icon.withdrawals {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    }

    .stat-icon.investments {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    @media (max-width: 768px) {
        .transactions-container {
            padding: 1rem 0;
        }

        .transactions-header {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .transactions-header h1 {
            font-size: 2rem;
        }

        .filter-group {
            flex-direction: column;
            gap: 1rem;
        }

        .filter-item {
            min-width: auto;
        }

        .transactions-table th,
        .transactions-table td {
            padding: 1rem 0.5rem;
            font-size: 0.85rem;
        }

        .summary-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="transactions-container">
    <div class="container">
        <!-- Transactions Header -->
        <div class="transactions-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-exchange-alt me-3"></i>Transaction History</h1>
                    <p class="mb-0 text-muted">Track all your financial activities and transaction details</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="me-3">
                            <div class="text-muted small">Total Transactions</div>
                            <div class="fw-bold">{{ $transactions->total() }}</div>
                        </div>
                        <div class="avatar-circle">
                            <i class="fas fa-history fa-3x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Statistics -->
        <div class="summary-stats">
            <div class="stat-card">
                <div class="stat-icon deposits">
                    <i class="fas fa-arrow-down"></i>
                </div>
                <div class="stat-value text-success">KSh {{ number_format($transactions->where('type', 'deposit')->sum('amount'), 2) }}</div>
                <div class="stat-label">Total Deposits</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon withdrawals">
                    <i class="fas fa-arrow-up"></i>
                </div>
                <div class="stat-value text-danger">KSh {{ number_format($transactions->where('type', 'withdrawal')->sum('amount'), 2) }}</div>
                <div class="stat-label">Total Withdrawals</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon investments">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-value text-info">{{ $transactions->where('type', 'investment')->count() }}</div>
                <div class="stat-label">Investments</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters-card">
            <h5 class="mb-3"><i class="fas fa-filter me-2"></i>Filter Transactions</h5>
            <form method="GET" action="{{ route('regular_user.transactions.index') }}">
                <div class="filter-group">
                    <div class="filter-item">
                        <label for="type">Transaction Type</label>
                        <select name="type" id="type" class="filter-select">
                            <option value="">All Types</option>
                            <option value="deposit" {{ request('type') == 'deposit' ? 'selected' : '' }}>Deposits</option>
                            <option value="withdrawal" {{ request('type') == 'withdrawal' ? 'selected' : '' }}>Withdrawals</option>
                            <option value="investment" {{ request('type') == 'investment' ? 'selected' : '' }}>Investments</option>
                            <option value="refund" {{ request('type') == 'refund' ? 'selected' : '' }}>Refunds</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="filter-select">
                            <option value="">All Statuses</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <label for="date_from">From Date</label>
                        <input type="date" name="date_from" id="date_from" class="filter-select" value="{{ request('date_from') }}">
                    </div>
                    <div class="filter-item">
                        <label for="date_to">To Date</label>
                        <input type="date" name="date_to" id="date_to" class="filter-select" value="{{ request('date_to') }}">
                    </div>
                    <div class="filter-item">
                        <button type="submit" class="btn btn-filter">
                            <i class="fas fa-search me-2"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Transactions Table -->
        <div class="transactions-card">
            <div class="card-header">
                <i class="fas fa-list me-2"></i>All Transactions
            </div>
            <div class="card-body p-0">
                @if($transactions->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>No Transactions Found</h3>
                        <p>Your transaction history will appear here once you start using the platform.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table transactions-table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-calendar me-1"></i>Date & Time</th>
                                    <th><i class="fas fa-tag me-1"></i>Type</th>
                                    <th><i class="fas fa-money-bill me-1"></i>Amount</th>
                                    <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                    <th><i class="fas fa-hashtag me-1"></i>Reference</th>
                                    <th><i class="fas fa-eye me-1"></i>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $tx)
                                <tr>
                                    <td>
                                        <div class="transaction-date">
                                            {{ $tx->created_at->format('M d, Y') }}
                                            <small>{{ $tx->created_at->format('h:i A') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="transaction-type {{ strtolower($tx->type) }}">
                                            <i class="fas fa-{{ $tx->type === 'deposit' ? 'arrow-down' : ($tx->type === 'withdrawal' ? 'arrow-up' : 'chart-line') }} me-1"></i>
                                            {{ ucfirst($tx->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="transaction-amount {{ $tx->type === 'deposit' || $tx->type === 'refund' ? 'positive' : 'negative' }}">
                                            {{ $tx->type === 'deposit' || $tx->type === 'refund' ? '+' : '-' }}KSh {{ number_format($tx->amount, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($tx->status) }}">
                                            {{ ucfirst($tx->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="transaction-reference">{{ $tx->reference ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('regular_user.transactions.show', $tx->id) }}" class="btn btn-view">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Pagination -->
        @if($transactions->hasPages())
            <div class="pagination-wrapper">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
