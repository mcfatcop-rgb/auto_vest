@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Create Fraud Report</h2>
    <a href="{{ route('admin.fraud.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Reports
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Report Details</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.fraud.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="regular_user_id" class="form-label">Select User</label>
                <select name="regular_user_id" id="regular_user_id" class="form-select @error('regular_user_id') is-invalid @enderror" required>
                    <option value="">Choose a user...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('regular_user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->phone }})
                        </option>
                    @endforeach
                </select>
                @error('regular_user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="reason" class="form-label">Fraud Reason</label>
                <textarea name="reason" id="reason" rows="5" class="form-control @error('reason') is-invalid @enderror" 
                          placeholder="Describe the fraud activity or suspicious behavior..." required>{{ old('reason') }}</textarea>
                @error('reason')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-exclamation-triangle"></i> Create Fraud Report
                </button>
                <a href="{{ route('admin.fraud.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

