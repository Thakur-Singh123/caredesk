<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the Super Admin login form.
     */
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'super_admin') {
            return redirect()->route('super.dashboard');
        }

        return view('auth.super-admin');
    }

    /**
     * Handle the Super Admin login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // Status check
            if (isset($user->status) && $user->status !== 'active') {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account has been deactivated. Please contact support.']);
            }

            // Role check
            if ($user->role !== 'super_admin') {
                Auth::logout();
                return back()->withErrors(['email' => 'Access denied. Super admin credentials required.']);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('super.dashboard'));
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }

    /**
     * Log out the Super Admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }
}