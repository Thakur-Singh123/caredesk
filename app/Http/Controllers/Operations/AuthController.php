<?php

namespace App\Http\Controllers\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display Operations Team Login View
     */
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'operations') {
            return redirect()->route('ops.dashboard');
        }

        return view('auth.operations');
    }

    /**
     * Process Operations Team Authentication
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
            if ($user->role !== 'operations') {
                Auth::logout();
                return back()->withErrors(['email' => 'Access denied. Authorized for Operations role only.']);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('ops.dashboard'));
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }

    /**
     * Process Operations Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('ops.login')->with('success', 'You have been logged out successfully.');
    }
}