@extends('layouts.admin')

@section('content')
<h2>Admin Dashboard</h2>
<hr>
<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text">{{ $userCount ?? '...' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Investment (KES)</h5>
                <p class="card-text">KSh {{ number_format($totalInvestment ?? 0) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
