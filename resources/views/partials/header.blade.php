<header class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
        <a href="/" class="flex items-center gap-2 group">
            <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center shadow-orange-200 shadow-lg group-hover:rotate-12 transition-transform">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <span class="text-xl font-black italic tracking-tighter text-slate-800">WHISKLIST</span>
        </a>

        <nav class="hidden md:flex items-center gap-6 text-sm font-semibold">
            <a href="/" class="text-slate-500 hover:text-orange-500 transition-colors">Browse</a>
            
            @auth
                <a href="{{ url('/dashboard') }}" class="text-slate-500 hover:text-orange-500 transition-colors">My Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-slate-500 hover:text-orange-500 transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="px-5 py-2 bg-orange-50 text-orange-600 rounded-full hover:bg-orange-100 transition-colors">Join Now</a>
            @endauth

            <button class="btn-primary ml-2">Post Recipe</button>
        </nav>
    </div>
</header>