<?php

namespace App\Http\Controllers\FI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display Field Inspector Login View
     */
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'field_inspector') {
            return redirect()->route('fi.dashboard');
        }

        return view('auth.fi');
    }

    /**
     * Process Field Inspector Authentication
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
                return back()->withErrors(['email' => 'Your account has been deactivated. Please contact your manager.']);
            }

            // Role check
            if ($user->role !== 'field_inspector') {
                Auth::logout();
                return back()->withErrors(['email' => 'Access denied. Authorized for Field Inspector role only.']);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('fi.dashboard'));
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }

    /**
     * Process Field Inspector Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('fi.login')->with('success', 'You have been logged out successfully.');
    }
}