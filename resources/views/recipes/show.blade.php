<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-12">
        @if (session('status'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700 font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white border border-slate-100 shadow-sm rounded-3xl p-6 md:p-10">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-black uppercase tracking-wider">
                    {{ $recipe->prep_time ?? 0 }} min prep
                </span>
                @if($recipe->is_draft)
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-black uppercase tracking-wider">
                        Draft
                    </span>
                @endif
                <span class="text-slate-400 text-sm font-semibold">Posted by {{ $recipe->user?->name ?? 'Chef' }}</span>
            </div>

            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-slate-900 mb-4">{{ $recipe->title }}</h1>

            <div class="space-y-8">
                <section>
                    <h2 class="text-lg font-black text-slate-800 mb-2">Description</h2>
                    <article class="prose prose-slate max-w-none text-slate-700 leading-relaxed whitespace-pre-line">
                        {{ $recipe->description }}
                    </article>
                </section>

                <section>
                    <h2 class="text-lg font-black text-slate-800 mb-2">Ingredients</h2>
                    <article class="prose prose-slate max-w-none text-slate-700 leading-relaxed whitespace-pre-line">
                        {{ $recipe->ingredients }}
                    </article>
                </section>

                <section>
                    <h2 class="text-lg font-black text-slate-800 mb-2">Steps</h2>
                    @php
                        $steps = collect(preg_split('/\r\n|\r|\n/', (string) $recipe->steps))
                            ->map(fn ($step) => trim($step))
                            ->filter()
                            ->values();
                    @endphp

                    @if ($steps->isNotEmpty())
                        <ol class="space-y-3 text-slate-700">
                            @foreach($steps as $step)
                                <li class="flex items-start gap-3">
                                    <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-full bg-orange-100 text-orange-700 text-xs font-black">
                                        {{ $loop->iteration }}
                                    </span>
                                    <span class="leading-relaxed">{{ $step }}</span>
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <p class="text-slate-500">No steps added yet.</p>
                    @endif
                </section>

                @if(! empty($recipe->closing))
                    <section>
                        <h2 class="text-lg font-black text-slate-800 mb-2">Closing</h2>
                        <article class="prose prose-slate max-w-none text-slate-700 leading-relaxed whitespace-pre-line">
                            {{ $recipe->closing }}
                        </article>
                    </section>
                @endif
            </div>

            <div class="mt-10 flex flex-wrap gap-3">
                <a href="{{ route('recipes.browse') }}" class="px-5 py-2 rounded-full bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition-colors">
                    Browse More
                </a>
                @can('update', $recipe)
                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="px-5 py-2 rounded-full bg-orange-50 text-orange-700 font-semibold hover:bg-orange-100 transition-colors">
                        Edit Recipe
                    </a>
                @endcan

                @can('delete', $recipe)
                    <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}" onsubmit="return confirm('Delete this recipe permanently?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-5 py-2 rounded-full bg-red-50 text-red-700 font-semibold hover:bg-red-100 transition-colors">
                            Delete Recipe
                        </button>
                    </form>
                @endcan
                <a href="{{ route('recipes.create') }}" class="btn-primary px-5 py-2">
                    Post Another Recipe
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
