<x-app-layout>
    <!-- Include Scroll Header -->
    @include('recipes.partials.scroll-header', ['search' => $search ?? ''])

    <div class="max-w-7xl mx-auto px-6 pt-12 pb-8">
        <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Browse Recipes</h1>
                <p class="text-slate-600 font-semibold mt-2 text-lg">Discover delicious recipes from our community.</p>
            </div>

            <form action="{{ route('recipes.browse') }}" method="GET" class="w-full lg:w-auto">
                <div class="relative group">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Search recipes..."
                        class="w-full lg:w-80 px-4 py-3 pr-20 bg-white border-2 border-slate-200 rounded-xl focus:border-orange-500 focus:ring-0 transition-all duration-300 font-semibold text-sm"
                    >
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 group-hover:text-orange-500 transition-colors" aria-label="Search recipes">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>

                @if(!empty($search))
                    <div class="mt-2 text-right">
                        <a href="{{ route('recipes.browse') }}" class="text-xs font-bold text-orange-600 hover:text-orange-700">Clear search</a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Category Sections -->
    <div class="max-w-7xl mx-auto px-6 pb-10 space-y-10">
        
        <!-- Top 20 Recipes -->
        @if($topRecipes->isNotEmpty())
            @include('recipes.partials.category-row', [
                'title' => 'Top 20 Recipes',
                'subtitle' => 'The most loved recipes in the Whisklist community.',
                'recipes' => $topRecipes,
                'visibleCount' => 4,
                'categoryId' => 'top-recipes',
                'seeMoreUrl' => '#top-recipes',
            ])
        @endif

        <!-- New Recipes -->
        @if($newRecipes->isNotEmpty())
            @include('recipes.partials.category-row', [
                'title' => 'New',
                'subtitle' => 'Fresh recipes just added to our collection.',
                'recipes' => $newRecipes,
                'categoryId' => 'new-recipes',
                'visibleCount' => 4,
                'seeMoreUrl' => '#new-recipes',
            ])
        @endif

        <!-- Main Dish -->
        @if($mainDishRecipes->isNotEmpty())
            @include('recipes.partials.category-row', [
                'title' => 'Main Dish',
                'subtitle' => 'Hearty and satisfying main course recipes.',
                'recipes' => $mainDishRecipes,
                'categoryId' => 'main-dish',
                'visibleCount' => 4,
                'seeMoreUrl' => '#main-dish',
            ])
        @endif

        <!-- Appetizer -->
        @if($appetizerRecipes->isNotEmpty())
            @include('recipes.partials.category-row', [
                'title' => 'Appetizer',
                'subtitle' => 'Start your meal with these delightful starters.',
                'recipes' => $appetizerRecipes,
                'categoryId' => 'appetizer',
                'visibleCount' => 4,
                'seeMoreUrl' => '#appetizer',
            ])
        @endif

        <!-- Side Dish -->
        @if($sideDishRecipes->isNotEmpty())
            @include('recipes.partials.category-row', [
                'title' => 'Side Dish',
                'subtitle' => 'Perfect sides to complement your main course.',
                'recipes' => $sideDishRecipes,
                'categoryId' => 'side-dish',
                'visibleCount' => 4,
                'seeMoreUrl' => '#side-dish',
            ])
        @endif

        <!-- Dessert -->
        @if($dessertRecipes->isNotEmpty())
            @include('recipes.partials.category-row', [
                'title' => 'Dessert',
                'subtitle' => 'Sweet treats to satisfy your cravings.',
                'recipes' => $dessertRecipes,
                'categoryId' => 'dessert',
                'visibleCount' => 4,
                'seeMoreUrl' => '#dessert',
            ])
        @endif

        <!-- No Results Message -->
        @if($topRecipes->isEmpty() && $newRecipes->isEmpty() && $mainDishRecipes->isEmpty() && 
            $appetizerRecipes->isEmpty() && $sideDishRecipes->isEmpty() && $dessertRecipes->isEmpty())
            <div class="text-center py-20 bg-gradient-to-br from-white to-orange-50/30 rounded-3xl border-2 border-dashed border-orange-200 shadow-sm">
                <svg class="w-16 h-16 mx-auto text-orange-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-orange-700 font-black text-lg">No recipes found matching your search!</p>
                <p class="text-orange-600 text-sm mt-2">Try searching with different keywords or browse our categories.</p>
            </div>
        @endif
    </div>
</x-app-layout>