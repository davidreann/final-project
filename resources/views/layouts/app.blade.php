<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whisklist - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body{background-color:#f8fafc;font-family:sans-serif;} .card{border-radius:12px;border:1px solid #e2e8f0;background:white;overflow:hidden;}</style>
</head>
<body class="flex flex-col min-h-screen">
    @include('partials.header')
    <main class="flex-grow container mx-auto px-4 py-12">@yield('content')</main>
    @include('partials.footer')
</body>
</html>