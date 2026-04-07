@extends('layouts.app')

@section('title', 'Recipe Directory | Whisklist')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <h2 class="text-xl font-semibold text-slate-800">Recipe Directory</h2>
        <p class="text-sm text-slate-500">Showing all recipes from the community</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-600 text-xs uppercase tracking-widest font-bold">
                    <th class="px-6 py-4 border-b border-slate-100">Recipe Title</th>
                    <th class="px-6 py-4 border-b border-slate-100">Description</th>
                    <th class="px-6 py-4 border-b border-slate-100 text-center">Rating</th>
                    <th class="px-6 py-4 border-b border-slate-100">Chef/Author</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($recipes as $recipe)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 font-medium text-slate-900">{{ $recipe->title }}</td>
                    <td class="px-6 py-4 text-slate-500 text-sm">{{ Str::limit($recipe->description, 60) }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="text-orange-400 font-bold">
                            {{ str_repeat('★', $recipe->rating) }}{{ str_repeat('☆', 5 - $recipe->rating) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-600 text-sm italic">{{ $recipe->author ?? 'Anonymous' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection