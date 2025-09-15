@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Admin Dashboard</h2>
    <div class="d-flex align-items-center gap-3">
        <!-- Date Range Filter -->
        <form method="GET" class="d-flex align-items-center gap-2">
            <label class="form-label mb-0">Period:</label>
            <select name="date_range" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                <option value="7" {{ $dateRange == '7' ? 'selected' : '' }}>Last 7 days</option>
                <option value="30" {{ $dateRange == '30' ? 'selected' : '' }}>Last 30 days</option>
                <option value="90" {{ $dateRange == '90' ? 'selected' : '' }}>Last 90 days</option>
                <option value="365" {{ $dateRange == '365' ? 'selected' : '' }}>Last year</option>
            </select>
        </form>
        <div class="text-muted">
            <i class="fas fa-calendar"></i> {{ now()->format('d M Y, H:i') }}
        </div>
    </div>
</div>

<!-- Quick Actions Panel -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <a href="{{ route('admin.companies.create') }}" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-plus"></i> Add Company
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.payouts.index') }}" class="btn btn-success btn-sm w-100">
                            <i class="fas fa-coins"></i> Manage Payouts
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.reports.investments') }}" class="btn btn-info btn-sm w-100">
                            <i class="fas fa-chart-bar"></i> Investment Report
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-warning btn-sm w-100">
                            <i class="fas fa-users"></i> View Users
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.support.index') }}" class="btn btn-secondary btn-sm w-100">
                            <i class="fas fa-headset"></i> Support
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark btn-sm w-100" onclick="exportData()">
                            <i class="fas fa-download"></i> Export Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Cards -->
@if($fraudAlerts > 0 || $unreadSupport > 0 || $failedTransactionsCount > 0 || $highValueTransactions > 0)
<div class="row mb-4">
    @if($fraudAlerts > 0)
    <div class="col-md-3">
        <div class="alert alert-danger d-flex align-items-center">
            <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
            <div>
                <strong>{{ $fraudAlerts }} Fraud Alert(s)</strong><br>
                <a href="{{ route('admin.fraud.index') }}" class="alert-link">Review Now</a>
            </div>
        </div>
    </div>
    @endif
    
    @if($unreadSupport > 0)
    <div class="col-md-3">
        <div class="alert alert-warning d-flex align-items-center">
            <i class="fas fa-headset fa-2x me-3"></i>
            <div>
                <strong>{{ $unreadSupport }} Unread Support Message(s)</strong><br>
                <a href="{{ route('admin.support.index') }}" class="alert-link">View Messages</a>
            </div>
        </div>
    </div>
    @endif
    
    @if($failedTransactionsCount > 0)
    <div class="col-md-3">
        <div class="alert alert-info d-flex align-items-center">
            <i class="fas fa-credit-card fa-2x me-3"></i>
            <div>
                <strong>{{ $failedTransactionsCount }} Failed Transaction(s)</strong><br>
                <a href="{{ route('admin.transactions.failed') }}" class="alert-link">Review Failed</a>
            </div>
        </div>
    </div>
    @endif
    
    @if($highValueTransactions > 0)
    <div class="col-md-3">
        <div class="alert alert-success d-flex align-items-center">
            <i class="fas fa-star fa-2x me-3"></i>
            <div>
                <strong>{{ $highValueTransactions }} High-Value Transaction(s)</strong><br>
                <small>Above KSh 100,000 (Last 7 days)</small>
            </div>
        </div>
    </div>
    @endif
</div>
@endif

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-2">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Total Users</h6>
                        <p class="card-text h4">{{ $userCount }}</p>
                        <small>Active: {{ $activeUsers }}</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Total Investment</h6>
                        <p class="card-text h4">KSh {{ number_format($totalInvestment) }}</p>
                        <small>Avg: KSh {{ number_format($averageInvestment) }}</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Total Transactions</h6>
                        <p class="card-text h4">KSh {{ number_format($totalTransactions) }}</p>
                        <small>Avg: KSh {{ number_format($averageTransaction) }}</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-credit-card fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Pending Payouts</h6>
                        <p class="card-text h4">KSh {{ number_format($pendingPayouts) }}</p>
                        <small>Awaiting approval</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-coins fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-white bg-secondary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Companies</h6>
                        <p class="card-text h4">{{ $totalCompanies }}</p>
                        <small>Active companies</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-building fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Success Rate</h6>
                        <p class="card-text h4">{{ $successRate }}%</p>
                        <small>Transaction success</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-percentage fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Visualizations -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Monthly Trends (Last 6 Months)</h5>
            </div>
            <div class="card-body">
                <canvas id="monthlyTrendsChart" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Top Performing Companies</h5>
            </div>
            <div class="card-body">
                <canvas id="companyPerformanceChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Daily Activity Chart -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Daily Activity (Last {{ $dateRange }} Days)</h5>
            </div>
            <div class="card-body">
                <canvas id="dailyActivityChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Company Performance -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Company Performance</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Stock Price</th>
                                <th>Investments</th>
                                <th>Total Amount</th>
                                <th>Average</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companyStats as $company)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $company->logo) }}" width="30" class="me-2">
                                    {{ $company->name }}
                                </td>
                                <td>KSh {{ number_format($company->stock_price) }}</td>
                                <td>{{ $company->investments_count }}</td>
                                <td>KSh {{ number_format($company->investments_sum_amount ?? 0) }}</td>
                                <td>KSh {{ number_format($company->investments_avg_amount ?? 0) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Referral Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h3 class="text-primary">{{ $referralStats['total_referrals'] }}</h3>
                        <small class="text-muted">Total Referrals</small>
                    </div>
                    <div class="col-6">
                        <h3 class="text-success">{{ $referralStats['active_referrers'] }}</h3>
                        <small class="text-muted">Active Referrers</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">System Status</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Database</span>
                    <span class="badge bg-success">Online</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Server</span>
                    <span class="badge bg-success">Running</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Last Backup</span>
                    <span class="text-muted">{{ now()->subDays(1)->format('M d, Y') }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Uptime</span>
                    <span class="text-muted">99.9%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Users</h5>
            </div>
            <div class="card-body">
                @forelse($recentUsers as $user)
                <div class="d-flex align-items-center mb-2">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="fw-bold">{{ $user->name }}</div>
                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted">No recent users</p>
                @endforelse
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Transactions</h5>
            </div>
            <div class="card-body">
                @forelse($recentTransactions as $transaction)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <div class="fw-bold">{{ $transaction->user->name ?? 'N/A' }}</div>
                        <small class="text-muted">{{ $transaction->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold">KSh {{ number_format($transaction->amount) }}</div>
                        <span class="badge {{ $transaction->status === 'success' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-muted">No recent transactions</p>
                @endforelse
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Investments</h5>
            </div>
            <div class="card-body">
                @forelse($recentInvestments as $investment)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <div class="fw-bold">{{ $investment->user->name ?? 'N/A' }}</div>
                        <small class="text-muted">{{ $investment->company->name ?? 'N/A' }}</small>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold">KSh {{ number_format($investment->amount) }}</div>
                        <small class="text-muted">{{ $investment->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted">No recent investments</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Monthly Trends Chart
const monthlyCtx = document.getElementById('monthlyTrendsChart').getContext('2d');
new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($monthlyStats['investments']->pluck('month')) !!},
        datasets: [{
            label: 'Investments (KSh)',
            data: {!! json_encode($monthlyStats['investments']->pluck('total')) !!},
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1
        }, {
            label: 'Transactions (KSh)',
            data: {!! json_encode($monthlyStats['transactions']->pluck('total')) !!},
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'KSh ' + value.toLocaleString();
                    }
                }
            }
        }
    }
});

// Company Performance Chart
const companyCtx = document.getElementById('companyPerformanceChart').getContext('2d');
new Chart(companyCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($topCompanies->pluck('name')) !!},
        datasets: [{
            data: {!! json_encode($topCompanies->pluck('investments_sum_amount')) !!},
            backgroundColor: [
                '#FF6384',
                '#36A2EB',
                '#FFCE56',
                '#4BC0C0',
                '#9966FF'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Daily Activity Chart
const dailyCtx = document.getElementById('dailyActivityChart').getContext('2d');
new Chart(dailyCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($dailyStats['investments']->pluck('date')) !!},
        datasets: [{
            label: 'Investments',
            data: {!! json_encode($dailyStats['investments']->pluck('total')) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.8)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: 'Transactions',
            data: {!! json_encode($dailyStats['transactions']->pluck('total')) !!},
            backgroundColor: 'rgba(255, 99, 132, 0.8)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'KSh ' + value.toLocaleString();
                    }
                }
            }
        }
    }
});

// Export Data Function
function exportData() {
    // Create a simple CSV export
    const data = {
        totalUsers: {{ $userCount }},
        totalInvestment: {{ $totalInvestment }},
        totalTransactions: {{ $totalTransactions }},
        pendingPayouts: {{ $pendingPayouts }},
        successRate: {{ $successRate }},
        exportDate: new Date().toISOString()
    };
    
    const csvContent = "Metric,Value\n" +
        "Total Users," + data.totalUsers + "\n" +
        "Total Investment," + data.totalInvestment + "\n" +
        "Total Transactions," + data.totalTransactions + "\n" +
        "Pending Payouts," + data.pendingPayouts + "\n" +
        "Success Rate," + data.successRate + "%\n" +
        "Export Date," + data.exportDate;
    
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'dashboard_export_' + new Date().toISOString().split('T')[0] + '.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
}

// Auto-refresh dashboard every 5 minutes
setInterval(function() {
    if (document.visibilityState === 'visible') {
        location.reload();
    }
}, 300000); // 5 minutes
</script>
@endpush
