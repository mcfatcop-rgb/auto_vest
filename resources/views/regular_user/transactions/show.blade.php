@extends('layouts.app')

@section('content')
<h1>Transaction Details</h1>

<ul>
    <li><strong>Date:</strong> {{ $transaction->transaction_date->format('Y-m-d H:i') }}</li>
    <li><strong>Type:</strong> {{ ucfirst($transaction->transaction_type) }}</li>
    <li><strong>Amount:</strong> KES {{ number_format($transaction->amount, 2) }}</li>
    <li><strong>Status:</strong> {{ ucfirst($transaction->status) }}</li>
    <li><strong>Reference:</strong> {{ $transaction->reference }}</li>
</ul>

<a href="{{ route('regular_user.transactions.index') }}">Back to Transactions</a>
@endsection
