<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Whisklist - Your Digital Cookbook</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white antialiased">
        @include('partials.header')

        <main>
            <!-- Hero Section -->
            <div class="relative overflow-hidden bg-orange-50/50 pt-16 pb-32">
                <div class="max-w-7xl mx-auto px-6 relative z-10">
                    <div class="text-center max-w-3xl mx-auto">
                        <span class="inline-block py-2 px-4 rounded-full bg-orange-100 text-orange-600 text-xs font-black uppercase tracking-widest mb-6">Welcome to the Kitchen</span>
                        <h1 class="text-6xl md:text-7xl font-black text-slate-900 tracking-tighter leading-tight mb-8">
                            Every great meal starts with a <span class="text-orange-500 italic">Whisk.</span>
                        </h1>
                        <p class="text-xl text-slate-500 font-medium leading-relaxed mb-10">
                            The social cookbook for modern chefs and home cooks. Organize your recipes, follow your favorite cooks, and never lose a delicious idea again.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary px-10 py-4 text-lg w-full sm:w-auto">Go to My Kitchen</a>
                            @else
                                <a href="{{ route('register') }}" class="btn-primary px-10 py-4 text-lg w-full sm:w-auto">Start Your Whisklist</a>
                                <a href="{{ route('login') }}" class="font-bold text-slate-600 hover:text-orange-500 transition-colors px-6">Already a member?</a>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Abstract Decor -->
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-orange-200/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-orange-300/10 rounded-full blur-3xl"></div>
            </div>

            <!-- Features Grid -->
            <div class="max-w-7xl mx-auto px-6 py-24">
                <div class="grid md:grid-cols-3 gap-12">
                    <div class="group">
                        <div class="w-14 h-14 bg-white shadow-xl rounded-2xl flex items-center justify-center text-orange-500 mb-6 group-hover:bg-orange-500 group-hover:text-white transition-all duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 mb-3">Save Recipes</h3>
                        <p class="text-slate-500 font-medium">Clip recipes from across the web or write your own family secrets.</p>
                    </div>
                    <div class="group">
                        <div class="w-14 h-14 bg-white shadow-xl rounded-2xl flex items-center justify-center text-orange-500 mb-6 group-hover:bg-orange-500 group-hover:text-white transition-all duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 mb-3">Cook Together</h3>
                        <p class="text-slate-500 font-medium">Follow friends, share recipes, and send helpful interactive feedback.</p>
                    </div>
                    <div class="group">
                        <div class="w-14 h-14 bg-white shadow-xl rounded-2xl flex items-center justify-center text-orange-500 mb-6 group-hover:bg-orange-500 group-hover:text-white transition-all duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 mb-3">Smart Recipe Finder</h3>
                        <p class="text-slate-500 font-medium">Find the perfect recipe for any occasion in no time.</p>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>