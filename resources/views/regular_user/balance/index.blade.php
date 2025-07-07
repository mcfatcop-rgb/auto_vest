@extends('layouts.app')

@section('content')
<h1>Account Balance</h1>
<p>Your current balance is: <strong>KES {{ number_format($balance, 2) }}</strong></p>
<!-- Buttons for deposit and withdrawal -->
@endsection
