<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G-Scores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body>
    <div class="header">
        <button id="menu-toggle">☰</button>
        <h2>G-Scores</h2>
    </div>

    <div class="container-fluid">
        <div class="sidebar" id="sidebar">
            <h3>Menu</h3>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('searchscores') }}" class="{{ request()->routeIs('searchscores') ? 'active' : '' }}">Search Scores</a>
            <a href="{{ route('report') }}" class="{{ request()->routeIs('report') ? 'active' : '' }}">Reports</a>
            <a href="{{ route('setting') }}" class="{{ request()->routeIs('setting') ? 'active' : '' }}">Settings</a>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("menu-toggle").addEventListener("click", function () {
                document.getElementById("sidebar").classList.toggle("show");
            });
        });
    </script>
</body>
</html>
