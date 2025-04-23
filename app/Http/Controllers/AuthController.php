<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Admin;

class AuthController extends Controller
{

    public function checkLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
       
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $email = $request->email;

 
            if (strpos($email, '@admin.com') !== false) {
              
                if (Auth::guard('admin')->attempt($credentials)) {
                    return redirect()->intended('admin/dashboard'); 
                } else {
                    return redirect()->back()->withErrors(['email' => 'Invalid Admin credentials.']);
                }
            } else {
                if (Auth::attempt($credentials)) {
                    return redirect()->intended('user/dashboard'); 
                } else {
                    return redirect()->back()->withErrors(['email' => 'Invalid User credentials.']);
                }
            }
        }
    }

   
    public function register()
    {
        return view('auth.register'); 
    }

   
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'id_number' => 'required|string|max:255|unique:users,id_number', 
            'password' => 'required|string|min:8|confirmed', 
        ]);

   
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'id_number' => $validated['id_number'],
            'password' => Hash::make($validated['password']), 
        ]);

   
        Auth::login($user);

        return redirect()->route('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();  
        $request->session()->invalidate();  
        $request->session()->regenerateToken();  

        return redirect('/login'); 
    }
}
