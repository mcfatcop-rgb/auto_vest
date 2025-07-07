@extends('layouts.admin')

@section('content')
<h2>Payments Received</h2>
<table class="table">
    <thead>
        <tr>
            <th>User</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $txn)
        <tr>
            <td>{{ $txn->user->name }}</td>
            <td>KSh {{ number_format($txn->amount) }}</td>
            <td>{{ $txn->method }}</td>
            <td>{{ $txn->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
