<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
            $user = auth()->user();

            if($request->has('user_name') && $request->has('email')){

                $request->validate([
                    'user_name' => ['required','string', 'max:255'],
                    'email' => ['required','email', 'max:255', Rule::unique(User::class)->ignore(auth()->id())]
                ]);

                $user->update([
                    'name' => $request->user_name,
                    'email' => $request->email
                ]);
            }

            if($request->has('password')){

                $request->validate([
                    'password' => ['required', 'current_password'],
                    'new_password' => ['required','min:8', 'same:password_confirmation'],
                    'password_confirmation' => ['required']
                ]);

                $user->update([
                    'password' => Hash::make($request->new_password)
                ]);
            }

            return Redirect::route('profile.edit')->with('status', 'profile-updated successfully');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'delete-password' => ['required', 'current-password'],
        ],[
            'delete-password.required' => 'password is required to proceed this action',
            'delete-password.current-password' => 'password does not match'
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
