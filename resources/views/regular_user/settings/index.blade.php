@extends('layouts.app')

@section('content')
<h1>Settings</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('regular_user.settings.update') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
    </div>

    <div class="form-group">
        <label for="password">New Password (leave blank to keep current)</label>
        <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm New Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>
@endsection
