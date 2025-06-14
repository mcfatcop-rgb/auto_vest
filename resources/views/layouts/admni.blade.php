<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AutoVest Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r shadow-md">
            <div class="p-4 text-xl font-bold text-blue-600">AutoVest Admin</div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-2 py-1 rounded hover:bg-blue-100">Dashboard</a>
                <a href="{{ route('admin.users') }}" class="block px-2 py-1 rounded hover:bg-blue-100">Users</a>
                <a href="{{ route('admin.companies') }}" class="block px-2 py-1 rounded hover:bg-blue-100">Companies</a>
                <a href="{{ route('admin.investments') }}" class="block px-2 py-1 rounded hover:bg-blue-100">Investments</a>
                <a href="{{ route('admin.payouts') }}" class="block px-2 py-1 rounded hover:bg-blue-100">Payments</a>
                <a href="{{ route('admin.fraud') }}" class="block px-2 py-1 rounded hover:bg-blue-100">Fraud Logs</a>
                <a href="{{ route('admin.settings') }}" class="block px-2 py-1 rounded hover:bg-blue-100">Settings</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
