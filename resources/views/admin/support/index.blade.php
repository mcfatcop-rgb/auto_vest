@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Support Messages</h2>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Messages</h5>
                <p class="card-text h4">{{ $stats['total'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Unread</h5>
                <p class="card-text h4">{{ $stats['unread'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">By Category</h5>
                <div class="row">
                    @foreach($stats['by_category'] as $category)
                    <div class="col-6">
                        <small class="text-muted">{{ $category->category }}:</small>
                        <strong>{{ $category->count }}</strong>
                    </div>
                    @endforeach
                </div>
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
        <h5 class="mb-0">Support Messages</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Subject</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Received</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($supportMessages as $message)
                    <tr class="{{ !$message->admin_read ? 'table-warning' : '' }}">
                        <td>
                            {{ $message->user->name ?? 'N/A' }}
                            @if(!$message->admin_read)
                                <span class="badge bg-danger ms-1">New</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($message->subject, 40) }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $message->category }}</span>
                        </td>
                        <td>
                            <span class="badge 
                                @if($message->status === 'pending') bg-warning
                                @elseif($message->status === 'in_progress') bg-info
                                @elseif($message->status === 'resolved') bg-success
                                @else bg-secondary
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $message->status)) }}
                            </span>
                        </td>
                        <td>{{ $message->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('admin.support.show', $message->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No support messages found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $supportMessages->links() }}
    </div>
</div>
@endsection

