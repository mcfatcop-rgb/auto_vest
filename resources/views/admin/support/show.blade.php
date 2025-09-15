@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Support Message</h2>
    <a href="{{ route('admin.support.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Messages
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
                <h5 class="mb-0">Message Details</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>From:</strong></div>
                    <div class="col-sm-9">{{ $supportMessage->user->name ?? 'N/A' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Phone:</strong></div>
                    <div class="col-sm-9">{{ $supportMessage->user->phone ?? 'N/A' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Subject:</strong></div>
                    <div class="col-sm-9">{{ $supportMessage->subject }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Category:</strong></div>
                    <div class="col-sm-9">
                        <span class="badge bg-secondary">{{ $supportMessage->category }}</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Received:</strong></div>
                    <div class="col-sm-9">{{ $supportMessage->created_at->format('d M Y, H:i') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Status:</strong></div>
                    <div class="col-sm-9">
                        <span class="badge 
                            @if($supportMessage->status === 'pending') bg-warning
                            @elseif($supportMessage->status === 'in_progress') bg-info
                            @elseif($supportMessage->status === 'resolved') bg-success
                            @else bg-secondary
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $supportMessage->status)) }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Message:</strong></div>
                    <div class="col-sm-9">
                        <div class="border p-3 bg-light rounded">
                            {{ $supportMessage->message }}
                        </div>
                    </div>
                </div>
                @if($supportMessage->admin_response)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Admin Response:</strong></div>
                    <div class="col-sm-9">
                        <div class="border p-3 bg-info text-white rounded">
                            {{ $supportMessage->admin_response }}
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
                <h5 class="mb-0">Respond & Update</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.support.update', $supportMessage->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending" {{ $supportMessage->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $supportMessage->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="resolved" {{ $supportMessage->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="closed" {{ $supportMessage->status === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="admin_response" class="form-label">Admin Response</label>
                        <textarea name="admin_response" id="admin_response" rows="6" class="form-control" 
                                  placeholder="Type your response to the user...">{{ old('admin_response', $supportMessage->admin_response) }}</textarea>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update & Respond
                        </button>
                        <a href="{{ route('admin.support.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

