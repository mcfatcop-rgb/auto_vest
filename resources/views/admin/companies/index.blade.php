@extends('layouts.admin')

@section('content')
<h2>All Car Companies</h2>
<a href="{{ route('admin.companies.create') }}" class="btn btn-primary mb-3">Add New Company</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Logo</th>
            <th>Stock Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
        <tr>
            <td>{{ $company->name }}</td>
            <td><img src="{{ asset('storage/' . $company->logo) }}" width="50"></td>
            <td>KSh {{ number_format($company->stock_price) }}</td>
            <td>
                <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-sm btn-warning">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
