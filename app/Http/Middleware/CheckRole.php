<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login')->withErrors(['email' => 'Please login to continue.']);
        }

        $user = Auth::user();

        // 2. Check if user account is active
        if ($user->status !== 'active') {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors(['email' => 'Your account is deactivated.']);
        }

        // 3. Check if user role matches the required role
        if ($user->role !== $role) {
            // Optional: redirect each role to its own default dashboard
            return match ($user->role) {
                'cre' => redirect()->route('cre.dashboard'),
                'field_inspector' => redirect()->route('fi.dashboard'),
                'operations' => redirect()->route('ops.dashboard'),
                default => redirect()->route('admin.dashboard'),
            };
        }

        return $next($request);
    }
}