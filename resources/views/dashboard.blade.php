<x-app-layout>
    @include('partials.page-heading', [
        'title' => 'My Dashboard',
        'subtitle' => 'View uploaded and saved recipes.',
    ])

    <!-- Status Messages -->
    <div class="max-w-7xl mx-auto px-6 pb-6">
        @include('partials.status-message')
    </div>

    <!-- Category Sections -->
    <div class="max-w-7xl mx-auto px-6 pb-10 space-y-10">
        
        <!-- My Uploaded Recipes -->
        @if($publishedRecipes->isNotEmpty())
            @include('recipes.partials.category-row', [
                'title' => 'My Uploaded Recipes',
                'subtitle' => 'All recipes you have created and published.',
                'recipes' => $publishedRecipes,
                'visibleCount' => 4,
                'categoryId' => 'my-uploaded',
                'seeMoreUrl' => '#my-uploaded',
            ])
        @else
            <div class="bg-gradient-to-br from-white to-orange-50/30 rounded-3xl p-12 border border-orange-100/50 text-center">
                <svg class="w-16 h-16 mx-auto text-orange-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-slate-500 font-semibold text-lg mb-4">You haven't uploaded any published recipes yet.</p>
                <a href="{{ route('recipes.create') }}" class="btn-primary inline-block">
                    Post Your First Recipe
                </a>
            </div>
        @endif

        <!-- My Drafts -->
        @if($draftRecipes->isNotEmpty())
            @include('recipes.partials.category-row', [
                'title' => 'My Drafts',
                'subtitle' => 'Recipes you are still working on.',
                'recipes' => $draftRecipes,
                'categoryId' => 'my-drafts',
                'visibleCount' => 4,
                'seeMoreUrl' => '#my-drafts',
            ])
        @endif
    </div>
</x-app-layout>
