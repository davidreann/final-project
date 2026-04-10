<div class="sticky top-24 z-20 mb-6 rounded-2xl border border-slate-100 bg-white/95 backdrop-blur px-4 py-3">
    <div class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
        <a href="{{ $backHref }}" class="text-slate-500 hover:text-orange-600 font-semibold transition-colors">
            {{ $backLabel }}
        </a>

        <div class="flex flex-wrap gap-3">
            <button type="submit" name="intent" value="draft" formnovalidate class="px-6 py-3 rounded-full bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition-colors">
                Save Draft & Exit
            </button>

            <button type="submit" name="intent" value="publish" class="btn-primary px-8 py-3 text-base js-publish-btn">
                {{ $publishLabel }}
            </button>
        </div>
    </div>
</div>
