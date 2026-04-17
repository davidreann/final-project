<div>
    <label for="title" class="block text-sm font-bold text-slate-700 mb-2">Recipe Title</label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $recipe->title ?? '') }}"
        placeholder="e.g. Creamy Garlic Chicken Pasta"
        class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 focus:border-orange-500 focus:ring-0 transition"
        required
    >
</div>

<div>
    <label for="image" class="block text-sm font-bold text-slate-700 mb-2">Recipe Image (optional)</label>
    <input
        type="file"
        id="image"
        name="image"
        accept="image/*"
        class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 focus:border-orange-500 focus:ring-0 transition file:mr-4 file:rounded-xl file:border-0 file:bg-orange-50 file:px-4 file:py-2 file:text-sm file:font-bold file:text-orange-700 hover:file:bg-orange-100"
    >
    <p class="mt-2 text-xs text-slate-500 font-semibold">PNG, JPG, GIF, or WEBP up to 5MB.</p>

    @if (! empty($recipe?->image))
        <p class="mt-3 text-xs text-slate-500 font-semibold">Current image:</p>
        @php
            $imageSrc = filter_var($recipe->image, FILTER_VALIDATE_URL)
                ? $recipe->image
                : \Illuminate\Support\Facades\Storage::url($recipe->image);
        @endphp
        <img
            src="{{ $imageSrc }}"
            alt="Current recipe image"
            class="mt-2 h-24 w-24 rounded-2xl object-cover border border-slate-200"
        >
    @endif
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="prep_time" class="block text-sm font-bold text-slate-700 mb-2">Prep Time (minutes)</label>
        <input
            type="number"
            id="prep_time"
            name="prep_time"
            value="{{ old('prep_time', $recipe->prep_time ?? 0) }}"
            min="0"
            max="1440"
            class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 focus:border-orange-500 focus:ring-0 transition"
        >
    </div>

    <div>
        <label for="category" class="block text-sm font-bold text-slate-700 mb-2">Recipe Category (optional)</label>
        <select
            id="category"
            name="category"
            class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 focus:border-orange-500 focus:ring-0 transition"
        >
            <option value="">-- Select a category --</option>
            <option value="main_dish" @selected(old('category', $recipe->category ?? '') === 'main_dish')>Main Dish</option>
            <option value="appetizer" @selected(old('category', $recipe->category ?? '') === 'appetizer')>Appetizer</option>
            <option value="side_dish" @selected(old('category', $recipe->category ?? '') === 'side_dish')>Side Dish</option>
            <option value="dessert" @selected(old('category', $recipe->category ?? '') === 'dessert')>Dessert</option>
        </select>
    </div>
</div>

<div>
    <label for="description" class="block text-sm font-bold text-slate-700 mb-2">Description</label>
    <textarea
        id="description"
        name="description"
        rows="4"
        placeholder="A short summary of your recipe..."
        class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 focus:border-orange-500 focus:ring-0 transition"
    >{{ old('description', $recipe->description ?? '') }}</textarea>
</div>

<div>
    <label for="ingredients" class="block text-sm font-bold text-slate-700 mb-2">Ingredients</label>
    <textarea
        id="ingredients"
        name="ingredients"
        rows="6"
        placeholder="List all ingredients, one per line..."
        class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 focus:border-orange-500 focus:ring-0 transition"
        required
    >{{ old('ingredients', $recipe->ingredients ?? '') }}</textarea>
</div>

<div>
    <label for="steps" class="block text-sm font-bold text-slate-700 mb-2">Steps</label>
    <p class="text-xs text-slate-500 font-semibold mb-3">Add each step one by one.</p>

    <div id="steps-wrapper" class="space-y-3">
        @foreach($steps as $step)
            <div class="step-row flex items-start gap-3">
                <span class="step-number mt-2 inline-flex h-8 w-8 items-center justify-center rounded-full bg-orange-100 text-orange-700 text-xs font-black">
                    {{ $loop->iteration }}
                </span>

                <input
                    type="text"
                    name="steps[]"
                    value="{{ $step }}"
                    placeholder="e.g. Heat oil in a pan over medium heat..."
                    class="flex-1 px-4 py-3 rounded-2xl border-2 border-slate-200 focus:border-orange-500 focus:ring-0 transition"
                    required
                >

                <button type="button" class="remove-step mt-1 px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold transition-colors">
                    Remove
                </button>
            </div>
        @endforeach
    </div>

    <button type="button" id="add-step" class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-orange-50 text-orange-700 hover:bg-orange-100 font-bold text-sm transition-colors">
        + Add Step
    </button>
</div>

<div>
    <label for="closing" class="block text-sm font-bold text-slate-700 mb-2">Closing (optional)</label>
    <textarea
        id="closing"
        name="closing"
        rows="3"
        placeholder="Any final note, serving tip, or variation..."
        class="w-full px-4 py-3 rounded-2xl border-2 border-slate-200 focus:border-orange-500 focus:ring-0 transition"
    >{{ old('closing', $recipe->closing ?? '') }}</textarea>
</div>
