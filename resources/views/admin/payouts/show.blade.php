@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Payout Details</h2>
    <a href="{{ route('admin.payouts.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Payouts
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Payout Information</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>User:</strong></div>
                    <div class="col-sm-9">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                {{ substr($payout->user->name ?? 'U', 0, 1) }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ $payout->user->name ?? 'N/A' }}</div>
                                <small class="text-muted">{{ $payout->user->phone ?? 'N/A' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Amount:</strong></div>
                    <div class="col-sm-9">
                        <span class="h4 text-primary">KSh {{ number_format($payout->amount) }}</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Status:</strong></div>
                    <div class="col-sm-9">
                        <span class="badge 
                            @if($payout->status === 'pending') bg-warning
                            @elseif($payout->status === 'paid') bg-success
                            @else bg-danger
                            @endif fs-6">
                            {{ ucfirst($payout->status) }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Requested:</strong></div>
                    <div class="col-sm-9">{{ $payout->created_at->format('d M Y, H:i') }}</div>
                </div>
                @if($payout->payout_date)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Paid On:</strong></div>
                    <div class="col-sm-9">{{ $payout->payout_date }}</div>
                </div>
                @endif
                @if($payout->admin_notes)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Admin Notes:</strong></div>
                    <div class="col-sm-9">
                        <div class="border p-3 bg-light rounded">
                            {{ $payout->admin_notes }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Update Status</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.payouts.updateStatus', $payout->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending" {{ $payout->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $payout->status === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $payout->status === 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="admin_notes" class="form-label">Admin Notes</label>
                        <textarea name="admin_notes" id="admin_notes" rows="4" class="form-control" 
                                  placeholder="Add notes about this payout...">{{ old('admin_notes', $payout->admin_notes) }}</textarea>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Payout
                        </button>
                        <a href="{{ route('admin.payouts.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                @if($payout->status === 'pending')
                <div class="d-grid gap-2">
                    <form action="{{ route('admin.payouts.updateStatus', $payout->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="paid">
                        <button type="submit" class="btn btn-success w-100" onclick="return confirm('Mark this payout as paid?')">
                            <i class="fas fa-check"></i> Mark as Paid
                        </button>
                    </form>
                    <form action="{{ route('admin.payouts.updateStatus', $payout->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="failed">
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Mark this payout as failed?')">
                            <i class="fas fa-times"></i> Mark as Failed
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

