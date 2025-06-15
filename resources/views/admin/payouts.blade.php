@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Payments & Payouts</h1>

    <div class="bg-white shadow rounded p-4">
        <table class="w-full text-left">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Paid At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payouts as $payout)
                    <tr class="border-t">
                        <td class="py-2">{{ $payout->user->phone }}</td>
                        <td>KES {{ number_format($payout->amount) }}</td>
                        <td>{{ $payout->method }}</td>
                        <td>{{ ucfirst($payout->status) }}</td>
                        <td>{{ $payout->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
