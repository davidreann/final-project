<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Join Whisklist</h2>
        <p class="text-slate-500 font-semibold mt-1">Save recipes and share your kitchen.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf
        <div>
            <label class="auth-label">Name</label>
            <input type="text" name="name" :value="old('name')" required autofocus class="auth-input" placeholder="Your name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label class="auth-label">Email Address</label>
            <input type="email" name="email" :value="old('email')" required class="auth-input" placeholder="chef@whisklist.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label class="auth-label">Password</label>
            <input type="password" name="password" required class="auth-input" placeholder="At least 8 characters" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="auth-label">Confirm Password</label>
            <input type="password" name="password_confirmation" required class="auth-input" placeholder="Type it again" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="w-full btn-primary py-4 text-lg mt-4">Start Cooking Now</button>
        
        <p class="text-center text-sm font-bold text-slate-400 mt-6">
            Already a chef? <a href="{{ route('login') }}" class="text-orange-500 hover:underline">Sign in</a>
        </p>
    </form>
</x-guest-layout>