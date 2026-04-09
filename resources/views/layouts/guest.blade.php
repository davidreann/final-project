<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Whisklist - Join the Kitchen</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-orange-50/40 antialiased min-h-screen flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center mb-8">
            <a href="/" class="inline-flex flex-col items-center gap-3 group">
                <div class="w-16 h-16 bg-orange-500 rounded-2xl flex items-center justify-center shadow-orange-200 shadow-2xl group-hover:rotate-12 transition-all duration-500">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h1 class="text-3xl font-black italic tracking-tighter text-slate-800">WHISKLIST</h1>
            </a>
        </div>
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-12 px-10 shadow-[0_32px_64px_-12px_rgba(249,115,22,0.15)] border border-orange-100 rounded-[3rem]">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>