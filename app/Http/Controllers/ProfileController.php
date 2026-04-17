<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Handles profile setup: view, edit form, update, and account deletion.
 *
 * Routes (inside auth + verified middleware):
 *   GET  /profile        → profile.show
 *   GET  /profile/edit   → profile.edit
 *   PUT  /profile        → profile.update
 */
class ProfileController extends Controller
{
    /** Show the authenticated user's public profile */
    public function show(): View
    {
        $user = Auth::user()->load('ratings');
        return view('profile.show', compact('user'));
    }

    /** Show the profile edit form */
    public function edit(): View
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /** Validate and save profile changes */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'     => ['required', 'string', 'min:2', 'max:100'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'username' => [
                'nullable', 'string', 'min:3', 'max:30', 'alpha_dash',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'bio'      => ['nullable', 'string', 'max:500'],
            'location' => ['nullable', 'string', 'max:100'],
            'avatar'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'username.alpha_dash' => 'Username may only contain letters, numbers, dashes, and underscores.',
            'avatar.max'          => 'Avatar must be smaller than 2 MB.',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar); // delete old file
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $emailChanged = $validated['email'] !== $user->email;

        if (! array_key_exists('username', $validated) || blank($validated['username'])) {
            unset($validated['username']);
        }

        $user->update($validated);

        if ($emailChanged) {
            $user->forceFill(['email_verified_at' => null])->save();
        }

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully!');
    }

    /** Delete the authenticated user's account */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
