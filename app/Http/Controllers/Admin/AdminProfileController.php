<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
// Method to display the profile page
    public function profile()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

// Method to update the profile (name, email, profile image)
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

// Validate name, email, and profile image
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_image' => 'nullable|image|max:2048',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'The email address must be valid.',
            'profile_image.image' => 'The file must be an image.',
            'profile_image.max' => 'The image must not be greater than 2MB.',
        ]);

// Update name and email
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');

// Update profile image if provided
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('images', 'public');

// Delete the old profile image if it exists
            if ($admin->profile_image) {
                Storage::disk('public')->delete($admin->profile_image);
            }

            $admin->profile_image = $path;
        }

// Save the updated admin profile
        $admin->save();

        return redirect()->route('admin.profile')->with('profile_success', 'Profile updated successfully.');
    }

// Method to update the password
    public function updatePassword(Request $request)
    {
        $admin = Auth::user();

// Validate with custom messages
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'old_password.required' => 'Please enter your current password.',
            'password.required' => 'Please enter a new password.',
            'password.min' => 'The new password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

// Check if the old password matches
        if (!Hash::check($request->input('old_password'), $admin->password)) {
            return back()->withErrors([
                'old_password' => 'The current password you entered is incorrect.'
            ])->withInput();
        }

// Update password
        $admin->password = Hash::make($request->input('password'));
        $admin->save();

        Auth::logout();

        return redirect()->route('admin.login')->with('password_success', 'Password updated successfully. Please log in with your new password.');
    }
}
