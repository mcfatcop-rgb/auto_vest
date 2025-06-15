@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Fraud Logs</h1>

    <div class="bg-white shadow rounded p-4">
        <table class="w-full text-left">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Reason</th>
                    <th>Detected</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr class="border-t">
                        <td class="py-2">{{ $log->user->phone }}</td>
                        <td>{{ $log->reason }}</td>
                        <td>{{ $log->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
