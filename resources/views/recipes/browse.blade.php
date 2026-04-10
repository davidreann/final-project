<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-black text-slate-800 tracking-tight">Top 20 Recipes</h1>
                <p class="text-slate-500 font-medium mt-2">The most loved recipes in the Whisklist community.</p>
            </div>

            <form action="{{ route('recipes.browse') }}" method="GET" class="relative group">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search recipes..." 
                       class="w-full md:w-80 px-6 py-3 bg-slate-100 border-2 border-transparent rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-0 transition-all duration-300 font-bold">
                <button type="submit" class="absolute right-4 top-3.5 text-slate-400 group-hover:text-orange-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($recipes as $recipe)
                @include('recipes.partials.card', ['recipe' => $recipe])
            @endforeach
        </div>

        @if($recipes->isEmpty())
            <div class="text-center py-24 bg-orange-50/50 rounded-[3rem] border-2 border-dashed border-orange-100">
                <p class="text-orange-600 font-black text-xl italic">No recipes found matching your search!</p>
            </div>
        @endif
    </div>
</x-app-layout>