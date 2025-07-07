@extends('layouts.admin')

@section('content')
<h2>All Users</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Balance</th>
            <th>Joined</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->phone }}</td>
            <td>KSh {{ number_format($user->balance) }}</td>
            <td>{{ $user->created_at->diffForHumans() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
