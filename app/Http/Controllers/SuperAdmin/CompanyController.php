<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of registered companies.
     */
    public function index()
    {
        $companies = Company::withCount(['branches', 'users'])->latest()->paginate(10);
        return view('super-admin.companies.index', compact('companies'));
    }

    /**
     * Store a newly created company, its default branch, and its admin user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'owner_name'   => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:companies,email|unique:users,email',
            'phone'        => 'nullable|string|max:20',
            'password'     => 'required|min:6',
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

            // 2. Create Default Branch (Head Office)
            $branch = $company->branches()->create([
                'name'      => 'Head Office',
                'code'      => 'HQ-' . strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $request->company_name), 0, 3)) . '-' . rand(10,99),
                'is_active' => 1,
            ]);

            // 3. Create Company Admin User
            User::create([
                'company_id' => $company->id,
                'branch_id'  => $branch->id,
                'name'       => $request->owner_name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'password'   => Hash::make($request->password),
                'role'       => 'admin',
                'status'     => 'active',
            ]);
        });

        return redirect()->route('super.companies.index')->with('success', 'Company, Head Office branch, and Admin account created successfully.');
    }

    /**
     * Update the specified company details.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'owner_name'   => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:companies,email,' . $company->id,
            'phone'        => 'nullable|string|max:20',
            'status'       => 'required|in:active,suspended,trial',
        ]);

        $company->update($request->only(['company_name', 'owner_name', 'email', 'phone', 'status']));

        return redirect()->route('super.companies.index')->with('success', 'Company details updated successfully.');
    }

    /**
     * Delete the specified company (cascades to branches and users).
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('super.companies.index')->with('success', 'Company and all associated records deleted successfully.');
    }

    /**
     * Toggle company active/suspended status.
     */
    public function toggleStatus(Company $company)
    {
        $company->status = $company->status === 'active' ? 'suspended' : 'active';
        $company->save();

        return redirect()->route('super.companies.index')->with('success', 'Company status updated successfully.');
    }
}