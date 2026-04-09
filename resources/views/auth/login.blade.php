<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Welcome back!</h2>
        <p class="text-slate-500 font-semibold mt-1">Login to see what's cooking.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        <div>
            <label class="auth-label">Email</label>
            <input type="email" name="email" :value="old('email')" required autofocus class="auth-input" placeholder="email@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex justify-between items-center mb-2">
                <label class="auth-label mb-0">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-orange-500 hover:text-orange-600" href="{{ route('password.request') }}">Forgot?</a>
                @endif
            </div>
            <input type="password" name="password" required class="auth-input" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 rounded-lg border-slate-200 text-orange-500 focus:ring-orange-500/20 transition-all">
            <label for="remember_me" class="ml-3 text-sm font-bold text-slate-500 cursor-pointer">Keep me logged in</label>
        </div>

        <button type="submit" class="w-full btn-primary py-4 text-lg">Let's Get Cooking</button>
        
        <p class="text-center text-sm font-bold text-slate-400 mt-6">
            New here? <a href="{{ route('register') }}" class="text-orange-500 hover:underline">Create an account</a>
        </p>
    </form>
</x-guest-layout>