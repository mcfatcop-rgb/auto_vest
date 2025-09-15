@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Failed Transactions</h2>
    <div class="text-muted">
        Total: {{ $failed->total() }} failed transactions
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Failed</h5>
                        <p class="card-text h4">{{ $stats['total_failed'] }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
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
                        <h5 class="card-title">Failed Amount</h5>
                        <p class="card-text h6">KSh {{ number_format($stats['total_amount']) }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-coins fa-2x"></i>
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
                        <h5 class="card-title">Today's Failures</h5>
                        <p class="card-text h4">{{ $stats['today_failed'] }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-day fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-secondary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Recent (7 days)</h5>
                        <p class="card-text h4">{{ $stats['recent_failures'] }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Form -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.transactions.failed') }}" class="row g-3">
            <div class="col-md-4">
                <label for="from_date" class="form-label">From Date</label>
                <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-4">
                <label for="to_date" class="form-label">To Date</label>
                <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}">
            </div>
            <div class="col-md-4">
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
        <h5 class="mb-0">Failed Transactions</h5>
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
                        <th>Error</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($failed as $txn)
                    <tr>
                        <td>
                            <span class="badge bg-danger">#{{ $txn->id }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                    {{ substr($txn->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $txn->user->name ?? 'N/A' }}</div>
                                    <small class="text-muted">{{ $txn->user->phone ?? 'N/A' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-danger">KSh {{ number_format($txn->amount) }}</span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ ucfirst($txn->method ?? 'Unknown') }}</span>
                        </td>
                        <td>
                            <span class="text-danger">{{ $txn->error_message ?? 'Unknown error' }}</span>
                        </td>
                        <td>{{ $txn->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewFailedTransactionDetails({{ $txn->id }})">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-success" onclick="retryTransaction({{ $txn->id }})">
                                    <i class="fas fa-redo"></i> Retry
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No failed transactions found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $failed->appends(request()->query())->links() }}
    </div>
</div>

<!-- Failed Transaction Details Modal -->
<div class="modal fade" id="failedTransactionDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Failed Transaction Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="failedTransactionDetailsContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function viewFailedTransactionDetails(transactionId) {
    document.getElementById('failedTransactionDetailsContent').innerHTML = `
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading transaction details...</p>
        </div>
    `;
    
    const modal = new bootstrap.Modal(document.getElementById('failedTransactionDetailsModal'));
    modal.show();
    
    // Simulate loading (replace with actual AJAX call)
    setTimeout(() => {
        document.getElementById('failedTransactionDetailsContent').innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <h6>Transaction Information</h6>
                    <p><strong>ID:</strong> ${transactionId}</p>
                    <p><strong>Status:</strong> <span class="badge bg-danger">Failed</span></p>
                    <p><strong>Method:</strong> M-Pesa</p>
                </div>
                <div class="col-md-6">
                    <h6>Failure Details</h6>
                    <p><strong>Amount:</strong> KSh 0</p>
                    <p><strong>Date:</strong> ${new Date().toLocaleDateString()}</p>
                    <p><strong>Reason:</strong> Insufficient funds</p>
                </div>
            </div>
        `;
    }, 1000);
}

function retryTransaction(transactionId) {
    if (confirm('Are you sure you want to retry this transaction?')) {
        // This would typically make an AJAX call to retry the transaction
        alert('Transaction retry initiated for ID: ' + transactionId);
    }
}
</script>
@endsection
