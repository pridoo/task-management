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
    

        $admin = Admin::where('id_number', $request->id_number)->first();

        if ($admin) {
    
            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                Log::info("Admin login success");
                return redirect()->intended('admin/dashboard');
            } else {
                Log::error("Admin login failed", ['credentials' => $credentials]);
                return back()->withErrors(['id_number' => 'Invalid Admin credentials.'])->withInput();
            }
        } else {
         
            $user = User::where('id_number', $request->id_number)->first();
            if ($user) {
                Log::info("User found, attempting login...");
                if (Auth::attempt($credentials, $remember)) {
                    Log::info("User login success");
                    return redirect()->intended('user/dashboard');
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
