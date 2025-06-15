@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Users Management</h1>

    <div class="bg-white shadow rounded p-4">
        <table class="w-full text-left">
            <thead>
                <tr>
                    <th class="py-2">ID</th>
                    <th>Phone</th>
                    <th>Registered</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-t">
                        <td class="py-2">{{ $user->id }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>KES {{ number_format($user->balance) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
