<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $emailChanged = $user->email !== $request->email;

        $user->fill($request->validated());

        if ($emailChanged) {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }

        $user->save();

        return $emailChanged
            ? Redirect::route('profile.edit')->with([
                'status' => 'verification-link-sent',
                'message' => __('A new verification link has been sent to your email address.')
              ])
            : Redirect::route('profile.edit')->with([
                'status' => 'profile-updated',
                'message' => __('Profile updated successfully.')
              ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with([
            'status' => 'account-deleted',
            'message' => __('Your account has been permanently deleted.')
        ]);
    }
}
