@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Payout Management</h2>
    <div class="text-muted">
        Total Payouts: {{ $payouts->total() }}
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-2">
        <div class="card text-white bg-primary">
            <div class="card-body text-center">
                <h5 class="card-title">Total</h5>
                <p class="card-text h4">{{ $stats['total'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-white bg-warning">
            <div class="card-body text-center">
                <h5 class="card-title">Pending</h5>
                <p class="card-text h4">{{ $stats['pending'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-white bg-success">
            <div class="card-body text-center">
                <h5 class="card-title">Paid</h5>
                <p class="card-text h4">{{ $stats['paid'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-white bg-danger">
            <div class="card-body text-center">
                <h5 class="card-title">Failed</h5>
                <p class="card-text h4">{{ $stats['failed'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-white bg-info">
            <div class="card-body text-center">
                <h5 class="card-title">Total Amount</h5>
                <p class="card-text h6">KSh {{ number_format($stats['total_amount']) }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-white bg-warning">
            <div class="card-body text-center">
                <h5 class="card-title">Pending Amount</h5>
                <p class="card-text h6">KSh {{ number_format($stats['pending_amount']) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Filter Form -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.payouts.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="from_date" class="form-label">From Date</label>
                <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-3">
                <label for="to_date" class="form-label">To Date</label>
                <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}">
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

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Payouts List</h5>
        <div>
            <button type="button" class="btn btn-sm btn-success" onclick="bulkUpdate('paid')">
                <i class="fas fa-check"></i> Mark Selected as Paid
            </button>
            <button type="button" class="btn btn-sm btn-danger" onclick="bulkUpdate('failed')">
                <i class="fas fa-times"></i> Mark Selected as Failed
            </button>
        </div>
    </div>
    <div class="card-body">
        <form id="bulkForm" action="{{ route('admin.payouts.bulkUpdate') }}" method="POST">
            @csrf
            <input type="hidden" name="status" id="bulkStatus">
            <input type="hidden" name="payout_ids" id="bulkPayoutIds">
        </form>
        
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                        </th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Requested</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payouts as $payout)
                    <tr>
                        <td>
                            <input type="checkbox" class="payout-checkbox" value="{{ $payout->id }}">
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                    {{ substr($payout->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $payout->user->name ?? 'N/A' }}</div>
                                    <small class="text-muted">{{ $payout->user->phone ?? 'N/A' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold">KSh {{ number_format($payout->amount) }}</span>
                        </td>
                        <td>
                            <span class="badge 
                                @if($payout->status === 'pending') bg-warning
                                @elseif($payout->status === 'paid') bg-success
                                @else bg-danger
                                @endif">
                                {{ ucfirst($payout->status) }}
                            </span>
                        </td>
                        <td>
                            <div>{{ $payout->created_at->format('d M Y') }}</div>
                            <small class="text-muted">{{ $payout->created_at->diffForHumans() }}</small>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.payouts.show', $payout->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($payout->status === 'pending')
                                <button type="button" class="btn btn-sm btn-success" onclick="quickUpdate({{ $payout->id }}, 'paid')">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="quickUpdate({{ $payout->id }}, 'failed')">
                                    <i class="fas fa-times"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No payouts found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $payouts->appends(request()->query())->links() }}
    </div>
</div>

<script>
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.payout-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

function bulkUpdate(status) {
    const checkboxes = document.querySelectorAll('.payout-checkbox:checked');
    if (checkboxes.length === 0) {
        alert('Please select at least one payout.');
        return;
    }
    
    if (confirm(`Are you sure you want to mark ${checkboxes.length} payout(s) as ${status}?`)) {
        const ids = Array.from(checkboxes).map(cb => cb.value);
        document.getElementById('bulkStatus').value = status;
        document.getElementById('bulkPayoutIds').value = JSON.stringify(ids);
        document.getElementById('bulkForm').submit();
    }
}

function quickUpdate(payoutId, status) {
    if (confirm(`Are you sure you want to mark this payout as ${status}?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('admin/payouts') }}/${payoutId}/status`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'PUT';
        
        const statusField = document.createElement('input');
        statusField.type = 'hidden';
        statusField.name = 'status';
        statusField.value = status;
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        form.appendChild(statusField);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
