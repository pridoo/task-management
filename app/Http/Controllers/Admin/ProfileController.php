<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        $messages = Message::latest()->get();

        return view('admin.settings.index', compact('admin', 'messages'));
    }

    public function showProfile()
    {
        $admin = auth('admin')->user();
        $messages = Message::latest()->get();

        return view('admin.settings.profile', compact('admin', 'messages'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|max:255|unique:admins,email,' . auth()->id(),
            'id_number' => 'required|string|max:255|unique:admins,id_number,' . auth()->id(),
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $admin = auth('admin')->user();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->id_number = $request->id_number;

        if ($request->hasFile('profile_picture')) {
            if ($admin->profile_picture && Storage::exists('public/' . $admin->profile_picture)) {
                Storage::delete('public/' . $admin->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $admin->profile_picture = $path;
        }

        $admin->save();

        return redirect()->route('admin.settings.profile')->with('success', 'Profile updated successfully!');
    }

    public function showPassword()
    {
        $admin = auth('admin')->user();
        $messages = Message::latest()->get();

        return view('admin.settings.password', compact('admin', 'messages'));
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin = auth('admin')->user();

        if (!Hash::check($request->old_password, $admin->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->route('admin.settings.password')->with('success', 'Password updated successfully!');
    }
}
