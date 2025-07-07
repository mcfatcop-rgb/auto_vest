@extends('layouts.app')

@section('content')
<h1>Welcome, {{ auth('regular_user')->user()->name }}</h1>
<p>This is your dashboard overview.</p>
<!-- Add summary cards here -->
@endsection
