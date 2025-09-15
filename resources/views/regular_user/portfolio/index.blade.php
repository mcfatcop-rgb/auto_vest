@extends('layouts.app')

@section('styles')
<style>
    .portfolio-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .portfolio-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .portfolio-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .btn-new-investment {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        border-radius: 15px;
        padding: 1rem 2rem;
        font-weight: 600;
        color: white;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-new-investment::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-new-investment:hover::before {
        left: 100%;
    }

    .btn-new-investment:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .portfolio-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .portfolio-table {
        margin: 0;
    }

    .portfolio-table th {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 1.5rem;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .portfolio-table td {
        padding: 1.5rem;
        border: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        vertical-align: middle;
        font-weight: 500;
    }

    .portfolio-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    .company-name {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.1rem;
    }

    .shares-count {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .investment-date {
        color: #6c757d;
        font-weight: 500;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
    }

    .btn-edit {
        background: linear-gradient(135deg, #ffa726, #ff7043);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 167, 38, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef5350, #e53935);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(239, 83, 80, 0.4);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: #2c3e50;
    }

    .empty-state p {
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .alert-modern {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(40, 167, 69, 0.2);
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .alert-modern.alert-success {
        background: linear-gradient(135deg, rgba(17, 153, 142, 0.1), rgba(56, 239, 125, 0.1));
        color: #155724;
    }

    @media (max-width: 768px) {
        .portfolio-container {
            padding: 1rem 0;
        }

        .portfolio-header {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .portfolio-header h1 {
            font-size: 2rem;
        }

        .portfolio-table th,
        .portfolio-table td {
            padding: 1rem 0.5rem;
            font-size: 0.9rem;
        }

        .action-buttons {
            flex-direction: column;
            gap: 0.25rem;
        }
    }
</style>
@endsection

@section('content')
<div class="portfolio-container">
    <div class="container">
        <!-- Portfolio Header -->
        <div class="portfolio-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-chart-pie me-3"></i>My Investment Portfolio</h1>
                    <p class="mb-0 text-muted">Manage and track your investment portfolio</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('regular_user.portfolio.create') }}" class="btn btn-new-investment">
                        <i class="fas fa-plus-circle me-2"></i>New Investment
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-modern alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Portfolio Table -->
        <div class="portfolio-card">
            @if($investments->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-chart-pie"></i>
                    <h3>No Investments Yet</h3>
                    <p>Start building your investment portfolio by adding your first investment.</p>
                    <a href="{{ route('regular_user.portfolio.create') }}" class="btn btn-new-investment">
                        <i class="fas fa-plus-circle me-2"></i>Create First Investment
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table portfolio-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-building me-2"></i>Company</th>
                                <th><i class="fas fa-chart-bar me-2"></i>Shares</th>
                                <th><i class="fas fa-calendar me-2"></i>Investment Date</th>
                                <th class="text-end"><i class="fas fa-cogs me-2"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($investments as $investment)
                            <tr>
                                <td>
                                    <div class="company-name">{{ $investment->company->name }}</div>
                                    <small class="text-muted">{{ $investment->company->sector ?? 'Technology' }}</small>
                                </td>
                                <td>
                                    <span class="shares-count">{{ number_format($investment->shares) }} shares</span>
                                </td>
                                <td>
                                    <div class="investment-date">
                                        {{ $investment->investment_date ? $investment->investment_date->format('M d, Y') : 'Not set' }}
                                    </div>
                                    @if($investment->investment_date)
                                        <small class="text-muted">{{ $investment->investment_date->diffForHumans() }}</small>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="action-buttons">
                                        <a href="{{ route('regular_user.portfolio.edit', $investment->id) }}" class="btn btn-edit">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <form action="{{ route('regular_user.portfolio.destroy', $investment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this investment?')">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
