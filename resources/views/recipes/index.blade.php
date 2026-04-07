@extends('layouts.app')
@section('title', 'Explore Community Recipes')

@section('content')
<div class="mb-12">
    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Cook Something <span class="text-orange-500 underline decoration-orange-200">New</span> Today</h1>
    <p class="text-slate-500 mt-2 text-lg italic">Explore {{ $recipes->count() }} recipes from around the world.</p>
</div>

<div class="recipe-card-wrapper">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="table-header-cell">Recipe</th>
                    <th class="table-header-cell">Instructions</th>
                    <th class="table-header-cell">Rating</th>
                    <th class="table-header-cell">Author</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($recipes as $recipe)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-6 py-6">
                        <div class="font-bold text-slate-800 group-hover:text-orange-600 transition-colors">{{ $recipe->title }}</div>
                        <div class="text-[10px] text-slate-400 mt-1 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $recipe->prep_time }} MINS
                        </div>
                    </td>
                    <td class="px-6 py-6 text-sm text-slate-500 leading-relaxed">{{ Str::limit($recipe->description, 70) }}</td>
                    <td class="px-6 py-6">
                        <div class="flex gap-0.5">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $recipe->rating ? 'rating-star-active' : 'rating-star-empty' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                    </td>
                    <td class="px-6 py-6 font-semibold text-slate-600 text-sm italic">{{ $recipe->author ?? 'Chef' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection