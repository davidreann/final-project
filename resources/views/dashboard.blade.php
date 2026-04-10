<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('My Uploaded Recipes') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6">
            @if (session('status'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700 font-semibold">
                    {{ session('status') }}
                </div>
            @endif

            @if($recipes->isEmpty())
                <div class="bg-white border border-slate-100 rounded-3xl p-8 text-center">
                    <p class="text-slate-500 font-semibold">You haven’t uploaded a recipe yet.</p>
                    <a href="{{ route('recipes.create') }}" class="btn-primary inline-block mt-4 px-6 py-2">
                        Post Your First Recipe
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($recipes as $recipe)
                        @include('recipes.partials.card', ['recipe' => $recipe])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
