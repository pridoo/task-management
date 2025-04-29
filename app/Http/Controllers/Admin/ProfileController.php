<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Method to show the admin profile
    public function showProfile()
    {
        // Fetch the currently logged-in admin's data
        $admin = auth('admin')->user();
        
        return view('admin.settings.profile', compact('admin'));
    }

    // Method to update the admin profile
    public function updateProfile(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|max:255|unique:admins,email,' . auth()->id(),
            'id_number' => 'required|string|max:255|unique:admins,id_number,' . auth()->id(),
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',  // Validate profile picture
        ]);

        // Get the currently logged-in admin
        $admin = auth('admin')->user();  // Using the 'admin' guard to fetch the logged-in admin

        // Update the admin's data
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->id_number = $request->id_number;

        // Handle the profile picture upload if there's a file
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($admin->profile_picture && Storage::exists('public/' . $admin->profile_picture)) {
                Storage::delete('public/' . $admin->profile_picture);
            }

            // Store the file and get the file path
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            // Update the admin's profile picture path
            $admin->profile_picture = $path;
        }

        // Save the updated data
        $admin->save();

        // Redirect back to the profile page with a success message
        return redirect()->route('admin.settings.profile')->with('success', 'Profile updated successfully!');
    }

       // Method to update the admin password
       public function updatePassword(Request $request)
       {
           // Validate the password fields
           $request->validate([
               'old_password' => 'required|string',
               'new_password' => 'required|string|min:8|confirmed', // New password must be at least 8 characters
           ]);
   
           // Get the currently logged-in admin
           $admin = auth('admin')->user();
   
           // Check if the old password matches the current password
           if (!Hash::check($request->old_password, $admin->password)) {
               return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect.']);
           }
   
           // Update the password
           $admin->password = Hash::make($request->new_password);
           $admin->save();
   
           // Redirect back with a success message
           return redirect()->route('admin.settings.password')->with('success', 'Password updated successfully!');
       }
}
