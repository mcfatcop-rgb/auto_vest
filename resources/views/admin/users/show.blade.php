@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>User Details</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Users
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <!-- User Information -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">User Information</h5>
            </div>
            <div class="card-body text-center">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                    <span class="h3">{{ substr($user->name, 0, 1) }}</span>
                </div>
                <h4>{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->email ?? 'No email' }}</p>
                <p class="text-muted">{{ $user->phone ?? 'No phone' }}</p>
                
                <div class="mt-3">
                    <span class="badge {{ ($user->status ?? 'active') === 'active' ? 'bg-success' : 'bg-danger' }} fs-6">
                        {{ ucfirst($user->status ?? 'active') }}
                    </span>
                </div>
                
                <div class="mt-3">
                    <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="{{ ($user->status ?? 'active') === 'active' ? 'suspended' : 'active' }}">
                        <button type="submit" class="btn {{ ($user->status ?? 'active') === 'active' ? 'btn-danger' : 'btn-success' }}">
                            {{ ($user->status ?? 'active') === 'active' ? 'Suspend User' : 'Activate User' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Account Statistics -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Account Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="text-primary">KSh {{ number_format($user->balance ?? 0) }}</h4>
                            <small class="text-muted">Current Balance</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success">{{ $user->investments->count() }}</h4>
                        <small class="text-muted">Total Investments</small>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="text-info">{{ $user->transactions->count() }}</h4>
                            <small class="text-muted">Transactions</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="text-warning">{{ $user->payouts->count() }}</h4>
                        <small class="text-muted">Payouts</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- User Activity -->
    <div class="col-md-8">
        <!-- Recent Investments -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Recent Investments</h5>
            </div>
            <div class="card-body">
                @if($user->investments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Amount</th>
                                <th>Shares</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->investments->take(5) as $investment)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $investment->company->logo) }}" width="20" class="me-2">
                                    {{ $investment->company->name }}
                                </td>
                                <td>KSh {{ number_format($investment->amount) }}</td>
                                <td>{{ $investment->shares }}</td>
                                <td>{{ $investment->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">No investments found.</p>
                @endif
            </div>
        </div>
        
        <!-- Recent Transactions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Recent Transactions</h5>
            </div>
            <div class="card-body">
                @if($user->transactions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->transactions->take(5) as $transaction)
                            <tr>
                                <td>{{ ucfirst($transaction->transaction_type ?? 'Payment') }}</td>
                                <td>KSh {{ number_format($transaction->amount) }}</td>
                                <td>
                                    <span class="badge {{ $transaction->status === 'success' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td>{{ $transaction->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">No transactions found.</p>
                @endif
            </div>
        </div>
        
        <!-- Recent Payouts -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Payouts</h5>
            </div>
            <div class="card-body">
                @if($user->payouts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->payouts->take(5) as $payout)
                            <tr>
                                <td>KSh {{ number_format($payout->amount) }}</td>
                                <td>
                                    <span class="badge 
                                        @if($payout->status === 'paid') bg-success
                                        @elseif($payout->status === 'pending') bg-warning
                                        @else bg-danger
                                        @endif">
                                        {{ ucfirst($payout->status) }}
                                    </span>
                                </td>
                                <td>{{ $payout->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">No payouts found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

