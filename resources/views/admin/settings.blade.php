@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Settings</h1>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white shadow rounded p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Global ROI Multiplier</label>
            <input type="number" step="0.01" name="roi_multiplier" value="{{ $settings->roi_multiplier ?? 1 }}" class="mt-1 block w-full border-gray-300 rounded">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Next Payout Date</label>
            <input type="date" name="next_payout" value="{{ $settings->next_payout ?? '' }}" class="mt-1 block w-full border-gray-300 rounded">
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update Settings</button>
    </form>
@endsection
