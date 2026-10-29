<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PublicCompanyRegisterController extends Controller
{
    /**
     * Show the public company registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register-company');
    }

    /**
     * Handle the public company registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'owner_name'   => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:companies,email|unique:users,email',
            'phone'        => 'nullable|string|max:20',
            'password'     => 'required|min:6|confirmed',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Create Company
            $company = Company::create([
                'company_name' => $request->company_name,
                'owner_name'   => $request->owner_name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'status'       => 'active',
            ]);

            // 2. Create Company Admin User (Branch ID is null for now)
            User::create([
                'company_id' => $company->id,
                'branch_id'  => null,
                'name'       => $request->owner_name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'password'   => Hash::make($request->password),
                'role'       => 'admin',
                'status'     => 'active',
            ]);
        });

        // Do NOT log in automatically. Redirect to login page with success message.
        return redirect()->route('admin.login')->with('success', 'Company registered successfully! Please sign in with your credentials.');
    }
}