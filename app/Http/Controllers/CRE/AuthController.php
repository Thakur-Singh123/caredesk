<?php

namespace App\Http\Controllers\CRE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display CRE Login View
     */
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'cre') {
            return redirect()->route('cre.dashboard');
        }

        return view('auth.cre');
    }

    /**
     * Process CRE Authentication
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
            if ($user->role !== 'cre') {
                Auth::logout();
                return back()->withErrors(['email' => 'Access denied. Authorized for CRE role only.']);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('cre.dashboard'));
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }

    /**
     * Process CRE Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('cre.login')->with('success', 'You have been logged out successfully.');
    }
}