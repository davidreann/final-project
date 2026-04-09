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
                <a href="{{ route('recipes.show', $recipe->id) }}" class="recipe-card-wrapper p-4 block hover:shadow-lg hover:scale-105 transition-all duration-300 rounded-[1.5rem]">
                    <div class="aspect-square bg-slate-100 rounded-[1.5rem] mb-4 overflow-hidden">
                        <img src="{{ $recipe->image_url ?? 'https://placehold.co/600x600?text=Delicious+Food' }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex items-center gap-1 mb-2">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 {{ $i < $recipe->rating ? 'text-orange-400' : 'text-slate-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                        <span class="text-[10px] font-black text-slate-400 ml-1">({{ $recipe->feedback_count }})</span>
                    </div>
                    <h3 class="font-black text-slate-800 text-lg leading-tight">{{ $recipe->title }}</h3>
                    <p class="text-slate-500 text-sm font-semibold mt-1">by {{ $recipe->user?->name ?? 'Unknown' }}</p>
                </a>
            @endforeach
        </div>

        @if($recipes->isEmpty())
            <div class="text-center py-24 bg-orange-50/50 rounded-[3rem] border-2 border-dashed border-orange-100">
                <p class="text-orange-600 font-black text-xl italic">No recipes found matching your search!</p>
            </div>
        @endif
    </div>
</x-app-layout>