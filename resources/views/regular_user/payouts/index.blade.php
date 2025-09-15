@extends('layouts.app')

@section('styles')
<style>
    .payouts-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .payouts-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .payouts-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .payout-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .summary-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
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

    .summary-card .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: white;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .summary-card.total-payouts .card-icon {
        background: linear-gradient(135deg, #11998e, #38ef7d);
    }

    .summary-card.pending-payouts .card-icon {
        background: linear-gradient(135deg, #ffa726, #ff7043);
    }

    .summary-card.completed-payouts .card-icon {
        background: linear-gradient(135deg, #667eea, #764ba2);
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

    .payouts-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .payouts-card .card-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 1.5rem;
        border: none;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .payouts-table {
        margin: 0;
    }

    .payouts-table th {
        background: rgba(102, 126, 234, 0.1);
        border: none;
        padding: 1.5rem 1rem;
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .payouts-table td {
        padding: 1.5rem 1rem;
        border: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        vertical-align: middle;
        font-weight: 500;
    }

    .payouts-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    .payout-date {
        font-weight: 700;
        color: #2c3e50;
    }

    .payout-date small {
        display: block;
        color: #6c757d;
        font-weight: 400;
        margin-top: 0.25rem;
    }

    .payout-amount {
        font-size: 1.2rem;
        font-weight: 800;
        color: #28a745;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .status-completed {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
    }

    .status-pending {
        background: linear-gradient(135deg, #ffa726, #ff7043);
        color: white;
    }

    .status-processing {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .status-failed {
        background: linear-gradient(135deg, #ef5350, #e53935);
        color: white;
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

    .btn-request {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        box-shadow: 0 10px 20px rgba(40, 167, 69, 0.3);
    }

    .btn-request:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(40, 167, 69, 0.4);
        color: white;
    }

    .btn-history {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-history:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        color: white;
    }

    @media (max-width: 768px) {
        .payouts-container {
            padding: 1rem 0;
        }

        .payouts-header {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .payouts-header h1 {
            font-size: 2rem;
        }

        .payout-summary {
            grid-template-columns: 1fr;
        }

        .summary-card {
            padding: 1.5rem;
        }

        .payouts-table th,
        .payouts-table td {
            padding: 1rem 0.5rem;
            font-size: 0.85rem;
        }

        .quick-actions .btn {
            min-width: 140px;
            padding: 0.8rem 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="payouts-container">
    <div class="container">
        <!-- Payouts Header -->
        <div class="payouts-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-money-bill-wave me-3"></i>Payouts</h1>
                    <p class="mb-0 text-muted">Track your earnings and payout history</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="me-3">
                            <div class="text-muted small">Total Payouts</div>
                            <div class="fw-bold">{{ $payouts->total() }}</div>
                        </div>
                        <div class="avatar-circle">
                            <i class="fas fa-coins fa-3x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payout Summary -->
        <div class="payout-summary">
            <div class="summary-card total-payouts">
                <div class="card-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h6>Total Payouts</h6>
                <h3 class="text-success">KSh {{ number_format($payouts->where('status', 'completed')->sum('amount'), 2) }}</h3>
                <div class="trend trend-up">
                    <i class="fas fa-arrow-up me-1"></i>All time
                </div>
            </div>
            <div class="summary-card pending-payouts">
                <div class="card-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h6>Pending Payouts</h6>
                <h3 class="text-warning">KSh {{ number_format($payouts->where('status', 'pending')->sum('amount'), 2) }}</h3>
                <div class="trend trend-up">
                    <i class="fas fa-hourglass-half me-1"></i>Processing
                </div>
            </div>
            <div class="summary-card completed-payouts">
                <div class="card-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h6>Completed This Month</h6>
                <h3 class="text-info">{{ $payouts->where('status', 'completed')->where('payout_date', '>=', now()->startOfMonth())->count() }}</h3>
                <div class="trend trend-up">
                    <i class="fas fa-calendar-check me-1"></i>This month
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            <div class="text-center">
                <button class="btn btn-request">
                    <i class="fas fa-plus me-2"></i>Request Payout
                </button>
                <button class="btn btn-history">
                    <i class="fas fa-history me-2"></i>View History
                </button>
            </div>
        </div>

        <!-- Payouts Table -->
        <div class="payouts-card">
            <div class="card-header">
                <i class="fas fa-list me-2"></i>Payout History
            </div>
            <div class="card-body p-0">
                @if($payouts->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>No Payouts Yet</h3>
                        <p>Your payout history will appear here once you start earning from your investments.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table payouts-table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-calendar me-1"></i>Payout Date</th>
                                    <th><i class="fas fa-money-bill me-1"></i>Amount</th>
                                    <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                    <th><i class="fas fa-eye me-1"></i>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payouts as $payout)
                                <tr>
                                    <td>
                                        <div class="payout-date">
                                            {{ $payout->payout_date->format('M d, Y') }}
                                            <small>{{ $payout->payout_date->format('h:i A') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="payout-amount">
                                            KSh {{ number_format($payout->amount, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($payout->status) }}">
                                            {{ ucfirst($payout->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('regular_user.payouts.show', $payout->id) }}" class="btn btn-view">
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
        @if($payouts->hasPages())
            <div class="pagination-wrapper">
                {{ $payouts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
