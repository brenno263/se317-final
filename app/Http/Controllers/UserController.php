<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


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

    public function authenticate(Request $request) {
        $validated = $request->validate([
            'email' => ['required', 'string','email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if(Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->intended(route('user.dashboard', ['id' => Auth::user()->id]));
        }

        return back()->withErrors([
            'email' => 'No user found with that username & password',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }

    public function dashboard(User $user) {
        return view('user.dashboard', ['user', $user]);
    }
}
