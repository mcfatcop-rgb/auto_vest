@extends('layouts.admin')

@section('content')
<h2>Failed Transactions</h2>
<table class="table table-danger">
    <thead>
        <tr>
            <th>User</th>
            <th>Amount</th>
            <th>Error</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($failed as $txn)
        <tr>
            <td>{{ $txn->user->name }}</td>
            <td>KSh {{ number_format($txn->amount) }}</td>
            <td>{{ $txn->error_message }}</td>
            <td>{{ $txn->created_at->diffForHumans() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
