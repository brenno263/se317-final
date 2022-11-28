<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Create a new user with the supplied POST data.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('login');
    }


    /**
     * Log in a user using a username and password.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request) {
        $validated = $request->validate([
            'email' => ['required', 'string','email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if(Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->intended(route('users.images.index', ['user' => Auth::user()]));
        }

        return back()->withErrors([
            'email' => 'No users found with that email & password',
        ])->onlyInput('email');
    }

    /**
     * Log out the current user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }
}
