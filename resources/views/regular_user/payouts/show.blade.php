@extends('layouts.app')

@section('content')
<h1>Payout Details</h1>

<ul>
    <li><strong>Date:</strong> {{ $payout->payout_date->format('Y-m-d') }}</li>
    <li><strong>Amount:</strong> KES {{ number_format($payout->amount, 2) }}</li>
    <li><strong>Status:</strong> {{ ucfirst($payout->status) }}</li>
</ul>

<a href="{{ route('regular_user.payouts.index') }}">Back to Payouts</a>
@endsection
