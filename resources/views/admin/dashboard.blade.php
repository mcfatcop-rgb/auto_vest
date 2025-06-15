@extends('layouts.admin')

@section('content')
    <div class="dashboard-header mb-6">
        <h1 class="text-3xl font-semibold text-gray-900">Admin Dashboard</h1>
        <p class="text-gray-600">Welcome back, {{ auth()->user()->name ?? 'Administrator' }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Users Card -->
        <div class="stats-card bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-50 mr-4">
                    <i class="fas fa-users text-red-500 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Users</h2>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $userCount ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">Last 30 days: +{{ $userGrowth ?? 0 }}%</p>
                </div>
            </div>
        </div>

        <!-- Total Investments Card -->
        <div class="stats-card bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-50 mr-4">
                    <i class="fas fa-chart-line text-blue-500 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Investments</h2>
                    <p class="text-2xl font-bold text-gray-900 mt-1">KES {{ number_format($totalInvestments ?? 0) }}</p>
                    <p class="text-xs text-gray-500 mt-1">Last 30 days: +{{ $investmentGrowth ?? 0 }}%</p>
                </div>
            </div>
        </div>

        <!-- Companies Listed Card -->
        <div class="stats-card bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-50 mr-4">
                    <i class="fas fa-building text-green-500 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Companies Listed</h2>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $companyCount ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">Active: {{ $activeCompanies ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
            <a href="#" class="text-sm text-red-500 hover:text-red-700">View All</a>
        </div>
        
        <div class="space-y-4">
            @if(isset($recentActivities) && count($recentActivities) > 0)
                @foreach($recentActivities as $activity)
                <div class="activity-item flex items-start pb-4 border-b border-gray-100 last:border-0">
                    <div class="flex-shrink-0 mr-3">
                        <div class="p-2 rounded-full {{ $activity['bgColor'] ?? 'bg-gray-200' }}">
                            <i class="{{ $activity['icon'] ?? 'fas fa-info-circle' }} text-white"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $activity['title'] ?? 'Activity' }}</p>
                        <p class="text-sm text-gray-500">{{ $activity['description'] ?? 'No description available' }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $activity['time'] ?? 'Just now' }}</p>
                    </div>
                </div>
                @endforeach
            @else
                <div class="text-center py-4 text-gray-500">
                    <i class="fas fa-info-circle mr-2"></i> No recent activities found
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Investment Overview</h2>
            <div class="h-64 bg-gray-50 rounded flex items-center justify-center">
                @if(isset($hasInvestmentData) && $hasInvestmentData)
                    <!-- Chart would render here -->
                    <canvas id="investmentChart"></canvas>
                @else
                    <p class="text-gray-400">No investment data available</p>
                @endif
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">User Registrations</h2>
            <div class="h-64 bg-gray-50 rounded flex items-center justify-center">
                @if(isset($hasUserData) && $hasUserData)
                    <!-- Chart would render here -->
                    <canvas id="userGrowthChart"></canvas>
                @else
                    <p class="text-gray-400">No user growth data available</p>
                @endif
            </div>
        </div>
    </div>
@endsection

<style>
    .dashboard-header {
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 1rem;
    }
    
    .stats-card {
        transition: all 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-2px);
    }
    
    .activity-item {
        transition: background-color 0.2s;
    }
    
    .activity-item:hover {
        background-color: #f9fafb;
    }
</style>