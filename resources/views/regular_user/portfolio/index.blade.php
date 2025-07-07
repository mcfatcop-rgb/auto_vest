@extends('layouts.app')

@section('content')
<h1>My Portfolio</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('regular_user.portfolio.create') }}" class="btn btn-primary">New Investment</a>

<table class="table mt-3">
    <thead>
        <tr>
            <th>Company</th>
            <th>Shares</th>
            <th>Investment Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($investments as $investment)
        <tr>
            <td>{{ $investment->company->name }}</td>
            <td>{{ $investment->shares }}</td>
            <td>{{ $investment->investment_date->format('Y-m-d') }}</td>
            <td>
                <a href="{{ route('regular_user.portfolio.edit', $investment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('regular_user.portfolio.destroy', $investment->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
