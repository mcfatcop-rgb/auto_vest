@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Earnings Report</h2>
    <div class="text-muted">
        <i class="fas fa-calendar"></i> {{ now()->format('d M Y') }}
    </div>
</div>

<!-- Filter Form -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.reports.earnings') }}" class="row g-3">
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

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Earnings</h5>
                        <p class="card-text h3">KSh {{ number_format($total) }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-coins fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Transactions</h5>
                        <p class="card-text h3">{{ $totalCount }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-credit-card fa-2x"></i>
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
                        <h5 class="card-title">Average Transaction</h5>
                        <p class="card-text h6">KSh {{ number_format($totalCount > 0 ? $total / $totalCount : 0) }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calculator fa-2x"></i>
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
                        <h5 class="card-title">This Month</h5>
                        <p class="card-text h6">KSh {{ number_format($monthlyEarnings->where('month', now()->format('Y-m'))->first()->total ?? 0) }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Monthly Earnings Trend</h5>
            </div>
            <div class="card-body">
                <canvas id="monthlyEarningsChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Payment Methods</h5>
            </div>
            <div class="card-body">
                <canvas id="methodsChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Daily Earnings Chart -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Daily Earnings - {{ now()->format('F Y') }}</h5>
            </div>
            <div class="card-body">
                <canvas id="dailyEarningsChart" height="50"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Top Users -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Top Users by Transaction Amount</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>User</th>
                                <th>Total Amount</th>
                                <th>Transactions</th>
                                <th>Average</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topUsers as $index => $user)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">{{ $index + 1 }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                            {{ substr($user->user->name ?? 'U', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $user->user->name ?? 'N/A' }}</div>
                                            <small class="text-muted">{{ $user->user->phone ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold text-success">KSh {{ number_format($user->total) }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $user->count }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">KSh {{ number_format($user->total / $user->count) }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No data available.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Monthly Earnings Chart
const monthlyCtx = document.getElementById('monthlyEarningsChart').getContext('2d');
const monthlyChart = new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($monthlyEarnings->pluck('month')) !!},
        datasets: [{
            label: 'Monthly Earnings (KSh)',
            data: {!! json_encode($monthlyEarnings->pluck('total')) !!},
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
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

// Payment Methods Chart
const methodsCtx = document.getElementById('methodsChart').getContext('2d');
const methodsChart = new Chart(methodsCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($methodsBreakdown->pluck('method')) !!},
        datasets: [{
            data: {!! json_encode($methodsBreakdown->pluck('total')) !!},
            backgroundColor: [
                '#FF6384',
                '#36A2EB',
                '#FFCE56',
                '#4BC0C0'
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

// Daily Earnings Chart
const dailyCtx = document.getElementById('dailyEarningsChart').getContext('2d');
const dailyChart = new Chart(dailyCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($dailyEarnings->pluck('date')) !!},
        datasets: [{
            label: 'Daily Earnings (KSh)',
            data: {!! json_encode($dailyEarnings->pluck('total')) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.8)',
            borderColor: 'rgba(54, 162, 235, 1)',
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
</script>
@endsection
