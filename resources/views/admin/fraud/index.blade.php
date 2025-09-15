@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Fraud Management</h2>
    <a href="{{ route('admin.fraud.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Fraud Report
    </a>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title">Total Reports</h5>
                <p class="card-text h4">{{ $stats['total'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Pending</h5>
                <p class="card-text h4">{{ $stats['pending'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Reviewed</h5>
                <p class="card-text h4">{{ $stats['reviewed'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Resolved</h5>
                <p class="card-text h4">{{ $stats['resolved'] }}</p>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Fraud Reports</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Phone</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Reported</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fraudLogs as $log)
                    <tr>
                        <td>{{ $log->user->name ?? 'N/A' }}</td>
                        <td>{{ $log->user->phone ?? 'N/A' }}</td>
                        <td>{{ Str::limit($log->reason, 50) }}</td>
                        <td>
                            <span class="badge 
                                @if($log->status === 'pending') bg-warning
                                @elseif($log->status === 'reviewed') bg-info
                                @else bg-success
                                @endif">
                                {{ ucfirst($log->status) }}
                            </span>
                        </td>
                        <td>{{ $log->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('admin.fraud.show', $log->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No fraud reports found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $fraudLogs->links() }}
    </div>
</div>
@endsection

