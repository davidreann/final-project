@extends('layouts.app')
@section('title', 'Whisklist | Top Recipes')
@section('content')
<div class="mb-16 text-center">
    <span class="text-orange-500 font-bold tracking-[0.2em] text-xs uppercase">Welcome to Whisklist</span>
    <h1 class="text-6xl font-black text-slate-900 mt-4 tracking-tight">Your Daily <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Flavor</span> Fix</h1>
    <p class="text-slate-400 mt-6 text-lg max-w-2xl mx-auto leading-relaxed italic font-medium">Browse our community-curated list of the most delicious, home-cooked recipes.</p>
</div>
<div class="recipe-card-wrapper">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="table-header-cell">Recipe Name</th>
                    <th class="table-header-cell">Instructions</th>
                    <th class="table-header-cell text-center">Community Rating</th>
                    <th class="table-header-cell">Author</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($recipes as $recipe)
                <tr class="hover:bg-orange-50/20 transition-all duration-300 group">
                    <td class="px-8 py-8">
                        <div class="font-extrabold text-slate-800 text-xl group-hover:text-orange-600 transition-colors">{{ $recipe->title }}</div>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-[10px] px-2 py-0.5 bg-orange-100 text-orange-600 rounded-full font-bold uppercase tracking-tighter">{{ $recipe->prep_time }} MINS PREP</span>
                        </div>
                    </td>
                    <td class="px-8 py-8 text-slate-500 text-sm leading-relaxed max-w-md">{{ Str::limit($recipe->description, 100) }}</td>
                    <td class="px-8 py-8 text-center text-xl">
                        <div class="flex justify-center gap-1">
                            @for($i=1;$i<=5;$i++)
                                <span class="{{ $i <= $recipe->rating ? 'rating-star-active' : 'rating-star-empty' }}">★</span>
                            @endfor
                        </div>
                    </td>
                    <td class="px-8 py-8">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-black text-slate-400 border border-slate-200">
                                {{ strtoupper(substr($recipe->author ?? 'W', 0, 1)) }}
                            </div>
                            <span class="font-bold text-slate-600 text-sm">{{ $recipe->author ?? 'Chef' }}</span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection