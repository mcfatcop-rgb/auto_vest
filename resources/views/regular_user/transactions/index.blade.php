@extends('layouts.app')

@section('content')
<h1>Transaction History</h1>

<table class="table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Amount (KES)</th>
            <th>Status</th>
            <th>Reference</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $tx)
        <tr>
            <td>{{ $tx->transaction_date->format('Y-m-d H:i') }}</td>
            <td>{{ ucfirst($tx->transaction_type) }}</td>
            <td>{{ number_format($tx->amount, 2) }}</td>
            <td>{{ ucfirst($tx->status) }}</td>
            <td>{{ $tx->reference }}</td>
            <td><a href="{{ route('regular_user.transactions.show', $tx->id) }}">View</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $transactions->links() }}
@endsection
