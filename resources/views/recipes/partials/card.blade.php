<a href="{{ route('recipes.show', $recipe->id) }}" class="recipe-card-wrapper p-4 block hover:shadow-lg hover:scale-105 transition-all duration-300 rounded-[1.5rem]">
    <div class="aspect-square bg-slate-100 rounded-[1.5rem] mb-4 overflow-hidden">
        <img
            src="{{ $recipe->image ?? 'https://placehold.co/600x600?text=Delicious+Food' }}"
            class="w-full h-full object-cover"
            alt="{{ $recipe->title }}"
        >
    </div>

    <h3 class="font-black text-slate-800 text-lg leading-tight">{{ $recipe->title }}</h3>
    @if($recipe->is_draft)
        <p class="inline-block mt-2 px-2 py-1 rounded-full bg-slate-100 text-slate-700 text-[10px] font-black uppercase tracking-wide">
            Draft
        </p>
    @endif
    <p class="text-slate-500 text-sm font-semibold mt-1">by {{ $recipe->user?->name ?? 'Unknown' }}</p>
    <p class="text-slate-400 text-xs font-bold mt-2 uppercase tracking-wide">{{ $recipe->prep_time ?? 0 }} mins prep</p>

    @if(! empty($recipe->description))
        <p class="text-slate-500 text-sm mt-2 line-clamp-2">{{ $recipe->description }}</p>
    @endif
</a>
