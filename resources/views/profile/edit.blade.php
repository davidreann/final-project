<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Success message --}}
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}"
                      enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Avatar preview + upload --}}
                    <div class="flex items-center gap-4">
                        <img src="{{ $user->avatarUrl() }}"
                             alt="Current avatar"
                             class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Profile Photo
                            </label>
                            <input type="file" name="avatar" accept="image/*"
                                   class="text-sm text-gray-500 file:mr-4 file:py-1 file:px-3
                                          file:rounded file:border-0 file:text-sm
                                          file:bg-orange-50 file:text-orange-700
                                          hover:file:bg-orange-100">
                            @error('avatar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input id="name" type="text" name="name"
                               value="{{ old('name', $user->name) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                      focus:border-orange-500 focus:ring-orange-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Username --}}
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border
                                         border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                @
                            </span>
                            <input id="username" type="text" name="username"
                                   value="{{ old('username', $user->username) }}" required
                                   class="flex-1 rounded-none rounded-r-md border-gray-300
                                          focus:border-orange-500 focus:ring-orange-500">
                        </div>
                        @error('username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bio --}}
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700">
                            Bio
                        </label>
                        <textarea id="bio" name="bio" rows="3" maxlength="500"
                                  placeholder="Tell others about yourself and your cooking style..."
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                         focus:border-orange-500 focus:ring-orange-500">{{ old('bio', $user->bio) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Max 500 characters</p>
                        @error('bio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Location --}}
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">
                            Location
                        </label>
                        <input id="location" type="text" name="location"
                               value="{{ old('location', $user->location) }}"
                               placeholder="e.g. Manila, Philippines"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                      focus:border-orange-500 focus:ring-orange-500">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit"
                                class="px-6 py-2 bg-orange-500 text-white rounded-md
                                       hover:bg-orange-600 transition font-medium">
                            Save Changes
                        </button>
                        <a href="{{ route('profile.show') }}"
                           class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md
                                  hover:bg-gray-50 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
