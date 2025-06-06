<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; 
use App\Models\User;
use App\Models\Admin;

class IdNumberAuthController extends Controller
{
    public function loginWithId(Request $request)
    {
        $request->validate([
            'id_number' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('id_number', 'password');
        $remember = $request->has('remember');
    
        // Checking if the user is an admin
        $admin = Admin::where('id_number', $request->id_number)->first();

        if ($admin) {
            // Admin login
            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                $request->session()->forget('success'); 
                Log::info("Admin login success");
                return redirect()->intended('admin/dashboard')->with('login_success', 'Login Successfully!');
            } else {
                Log::error("Admin login failed", ['credentials' => $credentials]);
                return back()->withErrors(['id_number' => 'Invalid Admin credentials.'])->withInput();
            }
        } else {
            // Checking if the user exists
            $user = User::where('id_number', $request->id_number)->first();
            if ($user) {
                Log::info("User found, attempting login...");
                

                if ($user->status === 'pending') {

                    return back()->withErrors(['id_number' => 'Your account is pending approval. Please wait for approval.'])->withInput();
                }
                
                if (Auth::attempt($credentials, $remember)) {
                    $request->session()->forget('success');
                    Log::info("User login success");
                    return redirect()->intended('user/dashboard')->with('login_success', 'Login Successfully!');
                } else {
                    Log::error("User login failed", ['credentials' => $credentials]);
                    return back()->withErrors(['id_number' => 'Invalid User credentials.'])->withInput();
                }
            } else {
                Log::error("ID Number not found in either Admin or User.");
                return back()->withErrors(['id_number' => 'ID Number not found.'])->withInput();
            }
        }
    }
}
