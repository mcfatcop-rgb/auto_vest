@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>User Management</h2>
    <div class="text-muted">
        Total Users: {{ $users->total() }}
    </div>
</div>

<!-- Search and Filter Form -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.users.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">Search</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="{{ request('search') }}" placeholder="Name, phone, or email...">
            </div>
            <div class="col-md-3">
                <label for="min_balance" class="form-label">Min Balance</label>
                <input type="number" class="form-control" id="min_balance" name="min_balance" 
                       value="{{ request('min_balance') }}" placeholder="0">
            </div>
            <div class="col-md-3">
                <label for="max_balance" class="form-label">Max Balance</label>
                <input type="number" class="form-control" id="max_balance" name="max_balance" 
                       value="{{ request('max_balance') }}" placeholder="1000000">
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
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
    <div class="card-header">
        <h5 class="mb-0">Users List</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Contact</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $user->name }}</div>
                                    <small class="text-muted">ID: {{ $user->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>{{ $user->phone ?? 'N/A' }}</div>
                            <small class="text-muted">{{ $user->email ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <span class="fw-bold">KSh {{ number_format($user->balance ?? 0) }}</span>
                        </td>
                        <td>
                            <span class="badge {{ ($user->status ?? 'active') === 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($user->status ?? 'active') }}
                            </span>
                        </td>
                        <td>
                            <div>{{ $user->created_at->format('d M Y') }}</div>
                            <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.users.referrals', $user->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-users"></i>
                                </a>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="{{ ($user->status ?? 'active') === 'active' ? 'suspended' : 'active' }}">
                                                <button type="submit" class="dropdown-item">
                                                    {{ ($user->status ?? 'active') === 'active' ? 'Suspend' : 'Activate' }} User
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $users->appends(request()->query())->links() }}
    </div>
</div>
@endsection
