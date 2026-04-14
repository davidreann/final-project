<div @isset($categoryId) id="{{ $categoryId }}" @endisset class="scroll-mt-28 mb-10 bg-gradient-to-br from-white to-orange-50/30 rounded-3xl p-8 border border-orange-100/50">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">{{ $title }}</h2>
            @if($subtitle)
                <p class="text-slate-600 font-semibold mt-2 text-lg">{{ $subtitle }}</p>
            @endif
        </div>
        @if($recipes->count() > $visibleCount)
            <a href="{{ $seeMoreUrl }}" class="text-orange-600 font-bold hover:text-orange-700 text-sm whitespace-nowrap ml-4">
                See All →
            </a>
        @endif
    </div>

    <div class="overflow-x-auto scrollbar-hide -mx-4 px-4">
        <div class="flex gap-5 pb-2 flex-nowrap">
            @foreach($recipes->take($visibleCount) as $recipe)
                <div class="flex-shrink-0 w-56 sm:w-60 md:w-64 lg:w-72">
                    @include('recipes.partials.card', ['recipe' => $recipe])
                </div>
            @endforeach
        </div>
    </div>
</div>
