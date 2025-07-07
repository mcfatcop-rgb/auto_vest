@extends('layouts.admin')

@section('content')
<h2>Investments Report</h2>
<p>Total Investments: KSh {{ number_format($totalInvestments) }}</p>
<ul>
    @foreach($byCompany as $item)
    <li>{{ $item->company->name }} - KSh {{ number_format($item->total) }}</li>
    @endforeach
</ul>
@endsection
