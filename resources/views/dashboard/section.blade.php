<x-app-layout>
    @include('partials.page-heading', [
        'title' => $title,
        'subtitle' => $subtitle,
    ])

    <div class="max-w-7xl mx-auto px-6 pb-8">
        <a href="{{ route('dashboard') }}" class="px-5 py-2 rounded-full bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition-colors inline-block">
            ← Back to Dashboard
        </a>
    </div>

    <div class="max-w-7xl mx-auto px-6 pb-12">
        @if($recipes->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($recipes as $recipe)
                    @include('recipes.partials.card', ['recipe' => $recipe])
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-gradient-to-br from-white to-orange-50/30 rounded-3xl border-2 border-dashed border-orange-200 shadow-sm">
                <p class="text-orange-700 font-black text-lg">No recipes found in this section.</p>
            </div>
        @endif
    </div>
</x-app-layout>
