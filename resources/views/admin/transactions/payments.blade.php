@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Successful Payments</h2>
    <div class="text-muted">
        Total: {{ $payments->total() }} transactions
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Amount</h5>
                        <p class="card-text h4">KSh {{ number_format($stats['total_amount']) }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-coins fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Count</h5>
                        <p class="card-text h4">{{ $stats['total_count'] }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-credit-card fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Today's Amount</h5>
                        <p class="card-text h6">KSh {{ number_format($stats['today_amount']) }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-day fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Today's Count</h5>
                        <p class="card-text h4">{{ $stats['today_count'] }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-chart-bar fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Methods Breakdown -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Payment Methods Breakdown</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($stats['methods'] as $method)
                    <div class="col-md-3">
                        <div class="text-center p-3 border rounded">
                            <h6>{{ ucfirst($method->method ?? 'Unknown') }}</h6>
                            <div class="h4 text-primary">{{ $method->count }}</div>
                            <small class="text-muted">KSh {{ number_format($method->total) }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Form -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.payments') }}" class="row g-3">
            <div class="col-md-3">
                <label for="from_date" class="form-label">From Date</label>
                <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-3">
                <label for="to_date" class="form-label">To Date</label>
                <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}">
            </div>
            <div class="col-md-3">
                <label for="method" class="form-label">Payment Method</label>
                <select name="method" id="method" class="form-select">
                    <option value="">All Methods</option>
                    <option value="mpesa" {{ request('method') === 'mpesa' ? 'selected' : '' }}>M-Pesa</option>
                    <option value="bank" {{ request('method') === 'bank' ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="card" {{ request('method') === 'card' ? 'selected' : '' }}>Card</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Payment Transactions</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $txn)
                    <tr>
                        <td>
                            <span class="badge bg-secondary">#{{ $txn->id }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                    {{ substr($txn->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $txn->user->name ?? 'N/A' }}</div>
                                    <small class="text-muted">{{ $txn->user->phone ?? 'N/A' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-success">KSh {{ number_format($txn->amount) }}</span>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($txn->method ?? 'Unknown') }}</span>
                        </td>
                        <td>{{ $txn->created_at->format('d M Y') }}</td>
                        <td>{{ $txn->created_at->format('H:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewTransactionDetails({{ $txn->id }})">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No payments found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $payments->appends(request()->query())->links() }}
    </div>
</div>

<!-- Transaction Details Modal -->
<div class="modal fade" id="transactionDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transaction Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="transactionDetailsContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function viewTransactionDetails(transactionId) {
    document.getElementById('transactionDetailsContent').innerHTML = `
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading transaction details...</p>
        </div>
    `;
    
    const modal = new bootstrap.Modal(document.getElementById('transactionDetailsModal'));
    modal.show();
    
    // Simulate loading (replace with actual AJAX call)
    setTimeout(() => {
        document.getElementById('transactionDetailsContent').innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <h6>Transaction Information</h6>
                    <p><strong>ID:</strong> ${transactionId}</p>
                    <p><strong>Status:</strong> <span class="badge bg-success">Success</span></p>
                    <p><strong>Method:</strong> M-Pesa</p>
                </div>
                <div class="col-md-6">
                    <h6>Amount & Date</h6>
                    <p><strong>Amount:</strong> KSh 0</p>
                    <p><strong>Date:</strong> ${new Date().toLocaleDateString()}</p>
                </div>
            </div>
        `;
    }, 1000);
}
</script>
@endsection
