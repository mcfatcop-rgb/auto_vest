@extends('layouts.app')

@section('content')
<h1>Payouts</h1>

<table class="table">
    <thead>
        <tr>
            <th>Payout Date</th>
            <th>Amount (KES)</th>
            <th>Status</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payouts as $payout)
        <tr>
            <td>{{ $payout->payout_date->format('Y-m-d') }}</td>
            <td>{{ number_format($payout->amount, 2) }}</td>
            <td>{{ ucfirst($payout->status) }}</td>
            <td><a href="{{ route('regular_user.payouts.show', $payout->id) }}">View</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $payouts->links() }}
@endsection
