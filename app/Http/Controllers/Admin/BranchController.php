<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the branches.
     */
    public function index()
    {
        $branches = Branch::withCount('users')->latest()->paginate(10);
        return view('admin.branches.index', compact('branches'));
    }

    /**
     * Store a newly created branch in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'code'      => 'required|string|max:50|unique:branches,code',
            'address'   => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        Branch::create([
            'name'      => $request->name,
            'code'      => strtoupper($request->code),
            'address'   => $request->address,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.branches.index')->with('success', 'Branch created successfully.');
    }

    /**
     * Update the specified branch in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'code'      => 'required|string|max:50|unique:branches,code,' . $branch->id,
            'address'   => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $branch->update([
            'name'      => $request->name,
            'code'      => strtoupper($request->code),
            'address'   => $request->address,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified branch from storage.
     */
    public function destroy(Branch $branch)
    {
        // Safety Check: Do not delete if users are assigned
        if ($branch->users()->count() > 0) {
            return back()->withErrors(['error' => 'Cannot delete branch because users are currently assigned to it.']);
        }

        $branch->delete();

        return redirect()->route('admin.branches.index')->with('success', 'Branch deleted successfully.');
    }

    /**
     * Toggle branch active/inactive status.
     */
    public function toggleStatus(Branch $branch)
    {
        $branch->is_active = !$branch->is_active;
        $branch->save();

        return redirect()->route('admin.branches.index')->with('success', 'Branch status updated successfully.');
    }
}