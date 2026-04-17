{{--
    Star Rating Component
    Usage: <x-star-rating :recipe="$recipe" />
    Props: $recipe — an instance of App\Models\Recipe (with ratings loaded)
--}}
@props(['recipe'])

<div class="star-rating-wrapper my-4">

    {{-- Display average + count --}}
    <div class="flex items-center gap-2 mb-3">
        @php $avg = $recipe->averageRating(); $count = $recipe->ratingCount(); @endphp

        @if($avg)
            <span class="text-yellow-400 text-xl">
                @for($i = 1; $i <= 5; $i++)
                    {{ $i <= round($avg) ? '★' : '☆' }}
                @endfor
            </span>
            <span class="font-semibold text-gray-700">{{ $avg }}/5</span>
            <span class="text-sm text-gray-400">({{ $count }} {{ Str::plural('rating', $count) }})</span>
        @else
            <span class="text-gray-400 text-sm italic">No ratings yet — be the first!</span>
        @endif
    </div>

    {{-- Rating form — only for authenticated users who didn't create the recipe --}}
    @auth
        @if(auth()->id() !== $recipe->user_id)
            @php $userRating = $recipe->userRating(); @endphp

            <form method="POST" action="{{ route('recipe.rate', $recipe) }}"
                  class="flex items-center gap-3">
                @csrf

                {{-- Interactive star buttons --}}
                <div class="flex gap-1" id="star-group">
                    @for($star = 1; $star <= 5; $star++)
                        <label class="cursor-pointer text-2xl leading-none
                                      {{ $userRating >= $star ? 'text-yellow-400' : 'text-gray-300' }}
                                      hover:text-yellow-400 transition-colors"
                               title="{{ $star }} star{{ $star > 1 ? 's' : '' }}">
                            <input type="radio" name="rating" value="{{ $star }}"
                                   class="sr-only"
                                   {{ $userRating == $star ? 'checked' : '' }}>
                            ★
                        </label>
                    @endfor
                </div>

                <button type="submit"
                        class="px-3 py-1 text-sm bg-orange-500 text-white rounded
                               hover:bg-orange-600 transition">
                    {{ $userRating ? 'Update' : 'Rate' }}
                </button>
            </form>

            {{-- Flash messages for this component --}}
            @if(session('success'))
                <p class="mt-2 text-sm text-green-600">✓ {{ session('success') }}</p>
            @endif
            @if(session('error'))
                <p class="mt-2 text-sm text-red-600">{{ session('error') }}</p>
            @endif

        @else
            <p class="text-sm text-gray-400 italic">You cannot rate your own recipe.</p>
        @endif
    @else
        <p class="text-sm text-gray-500">
            <a href="{{ route('login') }}" class="text-orange-500 hover:underline">Log in</a>
            to rate this recipe.
        </p>
    @endauth
</div>

{{-- Vanilla JS: highlight stars on hover before submitting --}}
<script>
(function () {
    const group = document.getElementById('star-group');
    if (!group) return;
    const labels = Array.from(group.querySelectorAll('label'));

    labels.forEach((label, idx) => {
        label.addEventListener('mouseenter', () => {
            labels.forEach((l, i) => {
                l.classList.toggle('text-yellow-400', i <= idx);
                l.classList.toggle('text-gray-300',  i >  idx);
            });
        });
        label.addEventListener('click', () => {
            label.querySelector('input').checked = true;
        });
    });

    group.addEventListener('mouseleave', () => {
        const checked = group.querySelector('input:checked');
        const checkedIdx = checked ? parseInt(checked.value) - 1 : -1;
        labels.forEach((l, i) => {
            l.classList.toggle('text-yellow-400', i <= checkedIdx);
            l.classList.toggle('text-gray-300',  i >  checkedIdx);
        });
    });
})();
</script>
