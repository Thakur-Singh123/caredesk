<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show Super Admin Profile Edit Form
     */
    public function edit()
    {
        $user = auth()->user();
        return view('super-admin.profile.edit', compact('user'));
    }

    /**
     * Update Super Admin Personal Profile Info
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $updateData = [
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        //Call the private method from inside the controller
        if ($request->hasFile('image')) {
            $updateData['image'] = $this->handleProfileImageUpload($request->file('image'), $user->image);
        }

        $user->update($updateData);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Update Super Admin Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password does not match our records.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    /**
     * Delete Super Admin Profile Image
     */
    public function deleteImage()
    {
        $user = auth()->user();

        if ($user->image) {
            $imagePath = 'profile-images/' . $user->image;
            
            // 1. Delete physical file from storage folder
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            // 2. Set image column to null in the database
            $user->update(['image' => null]);

            return redirect()->back()->with('success', 'Profile image deleted successfully.');
        }

        return redirect()->back()->with('error', 'No profile image found.');
    }

    /**
     * PRIVATE METHOD: Only accessible inside this Controller class
     */
    private function handleProfileImageUpload($file, $oldImageName)
    {
        // 1. Delete old image if it exists
        if ($oldImageName && Storage::disk('public')->exists('profile-images/' . $oldImageName)) {
            Storage::disk('public')->delete('profile-images/' . $oldImageName);
        }

        // 2. Generate unique name and store
        $filename = 'img_' . uniqid() . '_' . time() . '.jpg';
        
        // Using Laravel's simple storeAs instead of GD library to avoid server extension issues
        $file->storeAs('profile-images', $filename, 'public');

        // Return only the filename for the database
        return $filename;
    }
}