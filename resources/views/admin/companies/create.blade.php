@extends('layouts.admin')

@section('content')
<h2>Add Car Company</h2>
<form method="POST" action="{{ route('admin.companies.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Company Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Logo</label>
        <input type="file" name="logo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Initial Stock Price (KES)</label>
        <input type="number" name="stock_price" class="form-control" required>
    </div>
    <button class="btn btn-success">Save Company</button>
</form>
@endsection
