@extends('layouts.admin')

@section('content')
<h2>Referral Users for {{ $user->name }}</h2>
<ul class="list-group">
    @foreach($referrals as $ref)
    <li class="list-group-item">
        {{ $ref->name }} - {{ $ref->phone }}
    </li>
    @endforeach
</ul>
@endsection
