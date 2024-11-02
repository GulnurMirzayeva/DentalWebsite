<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    public function profile()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_image' => 'nullable|image|max:2048',
        ], [
            'name.required' => 'Zəhmət olmasa adınızı daxil edin.',
            'email.required' => 'Zəhmət olmasa email adresinizi daxil edin.',
            'email.email' => 'Email adresiniz etibarlı olmalıdır.',
            'profile_image.image' => 'File şəkil olmalıdır.',
            'profile_image.max' => 'Şəkil ölçüsü 2MB-dan böyük olmamalıdır.',
        ]);

        $admin->name = $request->input('name');
        $admin->email = $request->input('email');

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('images', 'public');

            if ($admin->profile_image) {
                Storage::disk('public')->delete($admin->profile_image);
            }

            $admin->profile_image = $path;
        }

        $admin->save();

        return redirect()->route('admin.profile')->with('profile_success', 'Profil dəyərləri güncəlləndi.');
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
            'old_password.required' => 'Zəhmət olmasa indiki parolunuzu daxil edin.',
            'password.required' => 'Zəhmət olmasa yeni parolunuzu daxil edin.',
            'password.min' => 'Yeni parol ən az 8 simvoldan ibarət olmalıdır.',
            'password.confirmed' => 'Parol təsdiq uyğun deyildir.',
        ]);

// Check if the old password matches
        if (!Hash::check($request->input('old_password'), $admin->password)) {
            return back()->withErrors([
                'old_password' => 'Daxil etdiyiniz cari parol düzgün deyildir.'
            ])->withInput();
        }

// Update password
        $admin->password = Hash::make($request->input('password'));
        $admin->save();

        Auth::logout();

        return redirect()->route('admin.login')->with('password_success', 'Parol uğurla yeniləndi. Zəhmət olmasa yeni parol ilə daxil olun.');
    }
}
