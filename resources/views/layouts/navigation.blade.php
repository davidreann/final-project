<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-2 group shrink-0">
            <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center shadow-orange-200 shadow-lg group-hover:rotate-12 transition-transform">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <span class="text-xl font-black italic tracking-tighter text-slate-800">WHISKLIST</span>
        </a>

        <!-- Desktop Navigation Links -->
        <div class="hidden md:flex items-center gap-6 text-sm font-semibold">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-500 hover:text-orange-500 transition-colors">
                {{ __('Dashboard') }}
            </x-nav-link>
            <a href="{{ route('recipes.browse') }}" class="text-slate-500 hover:text-orange-500 transition-colors">Browse Recipes</a>
        </div>

        <!-- Settings Dropdown -->
        <div class="hidden md:flex md:items-center md:ms-6 items-center gap-4">
            @auth
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-semibold rounded-lg text-slate-500 bg-white hover:text-orange-600 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
            <a href="{{ route('recipes.create') }}" class="btn-primary">Post Recipe</a>
            @else
            <div class="hidden space-x-3 md:flex">
                <a href="{{ route('login') }}" class="text-slate-500 hover:text-orange-500 transition-colors text-sm font-semibold">
                    {{ __('Log in') }}
                </a>
                <a href="{{ route('register') }}" class="px-5 py-2 bg-orange-50 text-orange-600 rounded-full hover:bg-orange-100 transition-colors text-sm font-semibold">
                    {{ __('Join Now') }}
                </a>
            </div>
            @endauth
        </div>

        <!-- Hamburger -->
        <div class="-me-2 flex items-center md:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 focus:text-slate-600 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <a href="{{ route('recipes.browse') }}" class="block px-4 py-2 text-slate-500 hover:text-orange-600 hover:bg-slate-50 rounded-lg transition-colors font-semibold text-base">
                {{ __('Browse Recipes') }}
            </a>
            @auth
                <a href="{{ route('recipes.create') }}" class="block px-4 py-2 text-orange-600 hover:text-orange-700 hover:bg-orange-50 rounded-lg transition-colors font-semibold text-base">
                    {{ __('Post Recipe') }}
                </a>
            @else
                <a href="{{ route('login') }}" class="block px-4 py-2 text-orange-600 hover:text-orange-700 hover:bg-orange-50 rounded-lg transition-colors font-semibold text-base">
                    {{ __('Post Recipe') }}
                </a>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-slate-100">
            <div class="px-4">
                <div class="font-black text-base text-slate-800">{{ Auth::user()->name }}</div>
                <div class="font-semibold text-sm text-slate-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-1 border-t border-slate-100">
            <div class="px-4 py-2 space-y-1">
                <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-semibold text-slate-600 hover:text-orange-600 hover:bg-slate-50 transition-colors rounded">
                    {{ __('Log in') }}
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-base font-semibold text-orange-600 hover:bg-orange-50 transition-colors rounded">
                    {{ __('Join Now') }}
                </a>
            </div>
        </div>
        @endauth
    </div>
</nav>
