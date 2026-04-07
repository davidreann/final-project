<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whisklist | @yield('title', 'Cook Something Great')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col">
    @include('partials.header')
    <main class="flex-grow container mx-auto px-4 py-12">
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>