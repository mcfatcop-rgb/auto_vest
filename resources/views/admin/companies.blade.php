@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Car Companies</h1>

    <div class="bg-white shadow rounded p-4">
        <a href="#" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">+ Add Company</a>

        <table class="w-full text-left mt-4">
            <thead>
                <tr>
                    <th class="py-2">Logo</th>
                    <th>Name</th>
                    <th>ROI %</th>
                    <th>Price Range</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                    <tr class="border-t">
                        <td class="py-2">
                            <img src="{{ asset('storage/logos/' . $company->logo) }}" alt="" class="w-10 h-10">
                        </td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->roi_percent }}%</td>
                        <td>KES {{ $company->min_price }} – {{ $company->max_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
