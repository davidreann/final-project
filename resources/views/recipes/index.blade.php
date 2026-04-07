@extends('layouts.app')

@section('title', 'Explore Recipes')

@section('content')
<div class="py-12 bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Page Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Explore Recipes</h1>
                <p class="mt-2 text-lg text-gray-500">Discover top-rated recipes from our community of food lovers.</p>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-400">
                <span>Showing {{ count($recipes) }} results</span>
            </div>
        </div>

        <!-- Recipe Table Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50 text-gray-400 text-[11px] uppercase tracking-widest font-bold">
                            <th class="px-8 py-5 border-b border-gray-100">Dish Title</th>
                            <th class="px-8 py-5 border-b border-gray-100">Instructions Preview</th>
                            <th class="px-8 py-5 border-b border-gray-100">Prep Time</th>
                            <th class="px-8 py-5 border-b border-gray-100 text-center">Community Rating</th>
                            <th class="px-8 py-5 border-b border-gray-100">Chef</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($recipes as $recipe)
                        <tr class="hover:bg-orange-50/30 transition-colors">
                            <td class="px-8 py-6">
                                <span class="font-bold text-gray-900 block">{{ $recipe->title }}</span>
                                <span class="text-[10px] px-2 py-0.5 bg-gray-100 text-gray-500 rounded uppercase font-bold mt-1 inline-block">Recipe #{{ $recipe->id }}</span>
                            </td>
                            <td class="px-8 py-6 text-gray-500 leading-relaxed max-w-xs">
                                {{ Str::limit($recipe->description, 75) }}
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center text-gray-700">
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $recipe->prep_time }} mins
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <div class="flex justify-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $recipe->rating ? 'text-orange-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-8 py-6 font-medium text-gray-600">
                                {{ $recipe->author ?? 'Anonymous Chef' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection