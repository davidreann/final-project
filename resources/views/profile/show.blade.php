<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Avatar + name block --}}
                <div class="flex items-center gap-5 mb-6">
                    <img src="{{ $user->avatarUrl() }}"
                         alt="{{ $user->name }}"
                         class="w-24 h-24 rounded-full object-cover border-2 border-orange-200">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h3>
                        @if($user->username)
                            <p class="text-gray-500">@{{ $user->username }}</p>
                        @endif
                        @if($user->location)
                            <p class="text-sm text-gray-500 mt-1">📍 {{ $user->location }}</p>
                        @endif
                    </div>
                </div>

                {{-- Bio --}}
                @if($user->bio)
                    <p class="text-gray-700 mb-6 leading-relaxed">{{ $user->bio }}</p>
                @else
                    <p class="text-gray-400 italic mb-6">No bio yet.</p>
                @endif

                {{-- Stats --}}
                <div class="flex gap-6 mb-6 text-center">
                    <div>
                        <p class="text-2xl font-bold text-orange-500">
                            {{ $user->recipes()->count() }}
                        </p>
                        <p class="text-sm text-gray-500">Recipes</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-orange-500">
                            {{ $user->ratings()->count() }}
                        </p>
                        <p class="text-sm text-gray-500">Ratings Given</p>
                    </div>
                </div>

                <a href="{{ route('profile.edit') }}"
                   class="inline-block px-5 py-2 bg-orange-500 text-white rounded-md
                          hover:bg-orange-600 transition font-medium">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
