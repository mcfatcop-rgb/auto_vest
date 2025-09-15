@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Car Companies Management</h2>
    <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Company
    </a>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Companies</h5>
                        <p class="card-text h3">{{ $stats['total_companies'] }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-car fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Investments</h5>
                        <p class="card-text h3">{{ $stats['total_investments'] }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-chart-line fa-2x"></i>
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
                        <h5 class="card-title">Total Amount</h5>
                        <p class="card-text h6">KSh {{ number_format($stats['total_investment_amount']) }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-coins fa-2x"></i>
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
                        <h5 class="card-title">Avg Investment</h5>
                        <p class="card-text h6">KSh {{ number_format($stats['average_investment']) }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calculator fa-2x"></i>
                    </div>
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
        <h5 class="mb-0">Companies Overview</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Stock Price</th>
                        <th>Investments</th>
                        <th>Total Amount</th>
                        <th>Avg Investment</th>
                        <th>Performance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $company->logo) }}" 
                                     class="rounded me-3" width="50" height="50" 
                                     style="object-fit: cover;">
                                <div>
                                    <div class="fw-bold">{{ $company->name }}</div>
                                    <small class="text-muted">ID: {{ $company->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-primary">KSh {{ number_format($company->stock_price) }}</span>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $company->investments_count }}</span>
                        </td>
                        <td>
                            <span class="fw-bold">KSh {{ number_format($company->investments_sum_amount ?? 0) }}</span>
                        </td>
                        <td>
                            <span class="text-muted">KSh {{ number_format($company->investments_avg_amount ?? 0) }}</span>
                        </td>
                        <td>
                            @php
                                $performance = $company->investments_count > 0 ? 'Good' : 'No Activity';
                                $badgeClass = $company->investments_count > 5 ? 'bg-success' : 
                                             ($company->investments_count > 0 ? 'bg-warning' : 'bg-secondary');
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $performance }}</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.companies.edit', $company->id) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-sm btn-info" 
                                        onclick="viewCompanyDetails({{ $company->id }})">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No companies found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Company Details Modal -->
<div class="modal fade" id="companyDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Company Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="companyDetailsContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function viewCompanyDetails(companyId) {
    // This would typically load company details via AJAX
    // For now, we'll show a placeholder
    document.getElementById('companyDetailsContent').innerHTML = `
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading company details...</p>
        </div>
    `;
    
    const modal = new bootstrap.Modal(document.getElementById('companyDetailsModal'));
    modal.show();
    
    // Simulate loading (replace with actual AJAX call)
    setTimeout(() => {
        document.getElementById('companyDetailsContent').innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <h6>Company Information</h6>
                    <p><strong>ID:</strong> ${companyId}</p>
                    <p><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
                </div>
                <div class="col-md-6">
                    <h6>Investment Statistics</h6>
                    <p><strong>Total Investments:</strong> 0</p>
                    <p><strong>Total Amount:</strong> KSh 0</p>
                </div>
            </div>
        `;
    }, 1000);
}
</script>
@endsection
