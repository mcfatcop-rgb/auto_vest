@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Platform Settings</h2>
                <div class="text-muted">
                    <i class="fas fa-cog me-2"></i>Configure your platform settings
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.settings.save') }}" method="POST" class="row g-4">
                @csrf

                <!-- Site Information Section -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-globe me-2"></i>Site Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="site_name" class="form-label">Site Name <span class="text-danger">*</span></label>
                                    <input type="text" id="site_name" name="site_name"
                                        value="{{ old('site_name', $settings->site_name ?? 'AutoVest') }}"
                                        class="form-control @error('site_name') is-invalid @enderror" required>
                                    @error('site_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="site_email" class="form-label">Site Email</label>
                                    <input type="email" id="site_email" name="site_email"
                                        value="{{ old('site_email', $settings->site_email ?? '') }}"
                                        class="form-control @error('site_email') is-invalid @enderror">
                                    @error('site_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="site_phone" class="form-label">Site Phone</label>
                                    <input type="text" id="site_phone" name="site_phone"
                                        value="{{ old('site_phone', $settings->site_phone ?? '') }}"
                                        class="form-control @error('site_phone') is-invalid @enderror">
                                    @error('site_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="enable_swahili" class="form-label">Enable Swahili Language <span class="text-danger">*</span></label>
                                    <select id="enable_swahili" name="enable_swahili"
                                        class="form-select @error('enable_swahili') is-invalid @enderror" required>
                                        <option value="1" {{ old('enable_swahili', $settings->enable_swahili ?? false) ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !old('enable_swahili', $settings->enable_swahili ?? false) ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('enable_swahili')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="site_description" class="form-label">Site Description</label>
                                    <textarea id="site_description" name="site_description" rows="3"
                                        class="form-control @error('site_description') is-invalid @enderror"
                                        placeholder="Brief description of your platform">{{ old('site_description', $settings->site_description ?? '') }}</textarea>
                                    @error('site_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Investment Settings Section -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Investment Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="min_investment" class="form-label">Minimum Investment <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" id="min_investment" name="min_investment" step="0.01"
                                            value="{{ old('min_investment', $settings->min_investment ?? 100) }}"
                                            class="form-control @error('min_investment') is-invalid @enderror" required>
                                    </div>
                                    @error('min_investment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="max_investment" class="form-label">Maximum Investment <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" id="max_investment" name="max_investment" step="0.01"
                                            value="{{ old('max_investment', $settings->max_investment ?? 100000) }}"
                                            class="form-control @error('max_investment') is-invalid @enderror" required>
                                    </div>
                                    @error('max_investment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="roi_multiplier" class="form-label">ROI Multiplier <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" id="roi_multiplier" name="roi_multiplier" step="0.01" min="0.01" max="10.00"
                                            value="{{ old('roi_multiplier', $settings->roi_multiplier ?? 1.00) }}"
                                            class="form-control @error('roi_multiplier') is-invalid @enderror" required>
                                        <span class="input-group-text">x</span>
                                    </div>
                                    @error('roi_multiplier')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payout Settings Section -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-coins me-2"></i>Payout Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="payout_frequency_days" class="form-label">Payout Frequency (Days) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" id="payout_frequency_days" name="payout_frequency_days" min="1" max="365"
                                            value="{{ old('payout_frequency_days', $settings->payout_frequency_days ?? 30) }}"
                                            class="form-control @error('payout_frequency_days') is-invalid @enderror" required>
                                        <span class="input-group-text">days</span>
                                    </div>
                                    @error('payout_frequency_days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="next_payout" class="form-label">Next Payout Date</label>
                                    <input type="date" id="next_payout" name="next_payout"
                                        value="{{ old('next_payout', $settings->next_payout ?? '') }}"
                                        class="form-control @error('next_payout') is-invalid @enderror">
                                    @error('next_payout')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Integration Section -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i>Payment Integration</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="mpesa_api_key" class="form-label">M-Pesa API Key</label>
                                    <input type="text" id="mpesa_api_key" name="mpesa_api_key"
                                        value="{{ old('mpesa_api_key', $settings->mpesa_api_key ?? '') }}"
                                        class="form-control @error('mpesa_api_key') is-invalid @enderror"
                                        placeholder="Enter your M-Pesa API key">
                                    @error('mpesa_api_key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Keep this secure and never share it publicly.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maintenance Mode Section -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0"><i class="fas fa-tools me-2"></i>Maintenance Mode</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="maintenance_mode" class="form-label">Enable Maintenance Mode <span class="text-danger">*</span></label>
                                    <select id="maintenance_mode" name="maintenance_mode"
                                        class="form-select @error('maintenance_mode') is-invalid @enderror" required>
                                        <option value="0" {{ !old('maintenance_mode', $settings->maintenance_mode ?? false) ? 'selected' : '' }}>Disabled</option>
                                        <option value="1" {{ old('maintenance_mode', $settings->maintenance_mode ?? false) ? 'selected' : '' }}>Enabled</option>
                                    </select>
                                    @error('maintenance_mode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="maintenance_message" class="form-label">Maintenance Message</label>
                                    <textarea id="maintenance_message" name="maintenance_message" rows="3"
                                        class="form-control @error('maintenance_message') is-invalid @enderror"
                                        placeholder="Message to display to users during maintenance">{{ old('maintenance_message', $settings->maintenance_message ?? '') }}</textarea>
                                    @error('maintenance_message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Settings
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function resetForm() {
    if (confirm('Are you sure you want to reset all changes? This will reload the page.')) {
        location.reload();
    }
}
</script>
@endsection
