<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PendingUserController extends Controller
{
    // Fetch all users with 'pending' status
    public function showPendingUsers()
    {
        // Fetch all users with 'pending' status
        $pendingUsers = User::where('status', 'pending')->get();

        // Return the view and pass the pending users
        return view('admin.users.pending-users', compact('pendingUsers'));
    }

    // Approve user
// Approve user
    public function approveUser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->status = 'approved';
            $user->save();

            return redirect()->route('admin.pending-users')
                ->with('status', 'approved')
                ->with('userName', $user->name);
        }

        return redirect()->route('admin.pending-users')
            ->with('status', 'error')
            ->with('userName', 'User not found');
    }
    
// Reject user
    public function rejectUser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->status = 'rejected';
            $user->save();

            return redirect()->route('admin.pending-users')
                ->with('status', 'rejected')
                ->with('userName', $user->name);
        }

        return redirect()->route('admin.pending-users')
            ->with('status', 'error')
            ->with('userName', 'User not found');
    }

    public function showApprovedUsers()
    {
        // Fetch all users with 'approved' status
        $approvedUsers = User::where('status', 'approved')->get();
    
        // Return the view and pass the approved users
        return view('admin.users.approved-users', compact('approvedUsers'));
    }
    // Unapprove user
    public function unapproveUser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->status = 'pending';
            $user->save();

            return redirect()->route('admin.approved-users')
                ->with('status', 'unapproved')
                ->with('userName', $user->name);
        }

        return redirect()->route('admin.approved-users')
            ->with('status', 'error')
            ->with('userName', 'User not found');
    }

    public function changePassword(Request $request, $userId)
    {
    
        $user = User::find($userId);
    
    
        if (!$user) {
            return redirect()->route('admin.approved-users')
                ->with('status', 'error')
                ->with('message', 'User not found');
        }
    
    
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|confirmed|min:8',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $user->password = Hash::make($request->new_password);
        $user->save();
    
       
        return back()
            ->with('status', 'success')
            ->with('message', 'Password updated successfully for ' . $user->name . '.');
    }
    
    
    
    
}
