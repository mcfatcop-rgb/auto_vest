@extends('layouts.app')

@section('content')
<h1>Create Investment</h1>

<form action="{{ route('regular_user.portfolio.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="company_id">Company</label>
        <select name="company_id" id="company_id" class="form-control" required>
            <!-- Populate companies dynamically -->
        </select>
    </div>

    <div class="form-group">
        <label for="amount">Amount (KES)</label>
        <input type="number" name="amount" id="amount" class="form-control" required min="1000">
    </div>

    <button type="submit" class="btn btn-primary">Invest</button>
</form>
@endsection
