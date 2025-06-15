@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Investments</h1>

    <div class="bg-white shadow rounded p-4">
        <table class="w-full text-left">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Company</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($investments as $investment)
                    <tr class="border-t">
                        <td class="py-2">{{ $investment->user->phone }}</td>
                        <td>{{ $investment->company->name }}</td>
                        <td>KES {{ number_format($investment->amount) }}</td>
                        <td>{{ $investment->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
