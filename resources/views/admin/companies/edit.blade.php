@extends('layouts.admin')

@section('content')
<h2>Edit Car Company</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.companies.update', $company->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Company Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Current Logo</label><br>
        <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="100">
    </div>

    <div class="mb-3">
        <label>Upload New Logo (optional)</label>
        <input type="file" name="logo" class="form-control">
        @error('logo')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Stock Price (KES)</label>
        <input type="number" name="stock_price" class="form-control" value="{{ old('stock_price', $company->stock_price) }}" required>
        @error('stock_price')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Company</button>
</form>
@endsection
