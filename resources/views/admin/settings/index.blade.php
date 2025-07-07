@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Platform Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <form action="{{ route('admin.settings.save') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="mpesa_api_key" class="form-label">M-Pesa API Key</label>
            <input type="text" id="mpesa_api_key" name="mpesa_api_key"
                value="{{ old('mpesa_api_key', $settings->mpesa_api_key ?? '') }}"
                class="form-control @error('mpesa_api_key') is-invalid @enderror">

            @error('mpesa_api_key')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="enable_swahili" class="form-label">Enable Swahili Language</label>
            <select id="enable_swahili" name="enable_swahili"
                class="form-select @error('enable_swahili') is-invalid @enderror">
                <option value="1" {{ (isset($settings) && $settings->enable_swahili) ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ (isset($settings) && !$settings->enable_swahili) ? 'selected' : '' }}>No</option>
            </select>

            @error('enable_swahili')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success">Save Settings</button>
    </form>
</div>
@endsection
