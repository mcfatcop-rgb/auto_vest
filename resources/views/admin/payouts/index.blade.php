@extends('layouts.admin')

@section('content')
<h2>Payout History</h2>
<table class="table">
    <thead>
        <tr>
            <th>User</th>
            <th>Amount (KES)</th>
            <th>Status</th>
            <th>Paid On</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payouts as $payout)
        <tr>
            <td>{{ $payout->user->name }}</td>
            <td>KSh {{ number_format($payout->amount) }}</td>
            <td>{{ ucfirst($payout->status) }}</td>
            <td>{{ $payout->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
