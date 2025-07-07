@extends('layouts.admin')

@section('content')
<h2>Earnings Report</h2>
<p>Total Earnings: KSh {{ number_format($total) }}</p>
<canvas id="earningsChart"></canvas>
@endsection
