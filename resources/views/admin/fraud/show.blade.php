@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Fraud Report Details</h2>
    <a href="{{ route('admin.fraud.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Reports
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
                <h5 class="mb-0">Report Information</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>User:</strong></div>
                    <div class="col-sm-9">{{ $fraudLog->user->name ?? 'N/A' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Phone:</strong></div>
                    <div class="col-sm-9">{{ $fraudLog->user->phone ?? 'N/A' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Reported:</strong></div>
                    <div class="col-sm-9">{{ $fraudLog->created_at->format('d M Y, H:i') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Status:</strong></div>
                    <div class="col-sm-9">
                        <span class="badge 
                            @if($fraudLog->status === 'pending') bg-warning
                            @elseif($fraudLog->status === 'reviewed') bg-info
                            @else bg-success
                            @endif">
                            {{ ucfirst($fraudLog->status) }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Reason:</strong></div>
                    <div class="col-sm-9">{{ $fraudLog->reason }}</div>
                </div>
                @if($fraudLog->admin_notes)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Admin Notes:</strong></div>
                    <div class="col-sm-9">{{ $fraudLog->admin_notes }}</div>
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
                <form action="{{ route('admin.fraud.update', $fraudLog->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending" {{ $fraudLog->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="reviewed" {{ $fraudLog->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                            <option value="resolved" {{ $fraudLog->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="admin_notes" class="form-label">Admin Notes</label>
                        <textarea name="admin_notes" id="admin_notes" rows="4" class="form-control" 
                                  placeholder="Add notes about this fraud report...">{{ old('admin_notes', $fraudLog->admin_notes) }}</textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i> Update Report
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

