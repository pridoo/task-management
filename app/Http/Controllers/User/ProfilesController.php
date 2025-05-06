<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfilesController extends Controller
{
    /**
     * Show the settings index page.
     */
    public function index()
    {
        $user = Auth::user(); 
        return view('user.settings.index', compact('user'));
    }

    /**
     * Show the user profile page.
     */
    public function showProfile()
    {
        $user = Auth::user();
        return view('user.settings.profile', compact('user'));
    }

    /**
     * Update the user profile.
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user(); 
    
       
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'id_number' => 'required|string|max:255',
        ]);
    
     
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }
    

        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_number = $request->id_number;
    
     
        $user->save();
    
        return redirect()->route('user.settings.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Show the change password form.
     */
    public function showPasswordForm()
    {
        return view('user.settings.password');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8',
        ]);
    
        $user = auth()->user();
    

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }
    
   
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        return redirect()->route('user.settings.password')->with('success', 'Password updated successfully!');
    }
    
    
    
    
    
}
