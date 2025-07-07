@extends('layouts.app')

@section('content')
<h1>Edit Investment</h1>

<form action="{{ route('regular_user.portfolio.update', $investment->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Company</label>
        <input type="text" class="form-control" value="{{ $investment->company->name }}" disabled>
    </div>

    <div class="form-group">
        <label for="amount">Amount (KES)</label>
        <input type="number" name="amount" id="amount" class="form-control" value="{{ $investment->amount }}" required min="1000">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
