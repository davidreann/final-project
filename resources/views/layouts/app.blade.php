<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Whisklist | Find Your Next Meal')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif;background-color:#fdfdfd;color:#1f2937;} .recipe-card{transition:all 0.3s ease;} .recipe-card:hover{transform:translateY(-4px);box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);}</style>
</head>
<body class="antialiased flex flex-col min-h-screen">
    @include('partials.header')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>