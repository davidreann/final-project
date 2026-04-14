<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="mb-10">
            <span class="inline-block py-2 px-4 rounded-full bg-orange-100 text-orange-600 text-xs font-black uppercase tracking-widest mb-4">
                Share a Recipe
            </span>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight">Post Your Recipe</h1>
            <p class="text-slate-500 font-medium mt-3">
                Add your best dish to Whisklist and let the community cook along.
            </p>
        </div>

        <div class="bg-white border border-slate-100 shadow-sm rounded-3xl p-6 md:p-10">
            @php
                $oldSteps = old('steps');

                if (is_string($oldSteps)) {
                    $oldSteps = preg_split('/\r\n|\r|\n/', $oldSteps);
                }

                if (! is_array($oldSteps) || count(array_filter($oldSteps, fn ($step) => trim((string) $step) !== '')) === 0) {
                    $oldSteps = [''];
                }
            @endphp

            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3">
                    <p class="font-bold text-red-700 mb-2">Please fix the following:</p>
                    <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="recipe-form" action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                @include('recipes.partials.form-actions', [
                    'backHref' => route('recipes.browse'),
                    'backLabel' => '← Back to Browse',
                    'publishLabel' => 'Publish Recipe',
                ])

                @include('recipes.partials.form-fields', [
                    'recipe' => null,
                    'steps' => $oldSteps,
                ])

            </form>
        </div>
    </div>

    @include('recipes.partials.form-script', ['formId' => 'recipe-form'])
</x-app-layout>
