@extends('layouts.app')

@section('content')
<h1>Referral Program</h1>

<p>Your unique referral link:</p>
<input type="text" value="{{ $referralLink }}" readonly style="width: 100%; padding: 10px;" onclick="this.select()">

<p>Total Referrals: <strong>{{ $referralsCount }}</strong></p>
<p>Total Referral Bonus: <strong>KES {{ number_format($referralBonus, 2) }}</strong></p>
@endsection
