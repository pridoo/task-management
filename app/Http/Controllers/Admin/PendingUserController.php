<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PendingUserController extends Controller
{
    // Fetch all users with 'pending' status
    public function showPendingUsers()
    {
        // Fetch all users with 'pending' status
        $pendingUsers = User::where('status', 'pending')->paginate(5);

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
        $approvedUsers = User::where('status', 'approved')->paginate(5);
    
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
    
}
