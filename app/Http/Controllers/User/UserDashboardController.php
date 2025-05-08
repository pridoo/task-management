<?php

namespace App\Http\Controllers\User;

use App\Models\Task;
use Carbon\Carbon;
use App\Models\Notification;
use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Fetch tasks assigned to the user
        $assignedTasks = Task::whereHas('users', function($query) use ($user) {
            $query->where('users.id', $user->id); 
        })->where('archived', false)
          ->get();

        // Count tasks based on their status
        $totalTasks = $assignedTasks->count();

        $completedTasksCount = Task::whereHas('users', function($query) use ($user) {
            $query->where('users.id', $user->id);
        })->where('status', 'completed')
          ->where('archived', false)
          ->count();

        $inProgressCount = Task::whereHas('users', function($query) use ($user) {
            $query->where('users.id', $user->id);
        })->where('status', 'in-progress')
          ->where('archived', false)
          ->count();

        $toDoCount = Task::whereHas('users', function($query) use ($user) {
            $query->where('users.id', $user->id);
        })->where('status', 'to do')
          ->where('archived', false)
          ->count();

        // Add status labels to tasks
        foreach ($assignedTasks as $task) {
            $status = strtolower(trim($task->status ?? ''));

            $task->status_label = 'To do';
            $task->status_class = 'bg-red-500';
            $task->status_detail_label = 'To do';
            $task->status_text_class = 'text-red-500';

            if ($status === 'to-do') {
                $task->status_label = 'To do';
                $task->status_class = 'bg-red-500';
                $task->status_detail_label = 'To do';
                $task->status_text_class = 'text-red-500';
            } elseif ($status === 'in-progress') {
                $task->status_label = 'In progress';
                $task->status_class = 'bg-yellow-500';
                $task->status_detail_label = 'In progress';
                $task->status_text_class = 'text-yellow-500';
            } elseif ($status === 'completed') {
                $task->status_label = 'Completed';
                $task->status_class = 'bg-green-500';
                if (!empty($task->start_date) && !empty($task->end_date)) {
                    $completedAt = Carbon::parse($task->start_date)->startOfMinute();
                    $endDate = Carbon::parse($task->end_date)->startOfMinute();

                    if ($completedAt->gt($endDate)) {
                        $task->status_detail_label = 'Done late';
                        $task->status_text_class = 'text-red-500';
                    } elseif ($completedAt->lt($endDate)) {
                        $task->status_detail_label = 'Done early';
                        $task->status_text_class = 'text-blue-500';
                    } else {
                        $task->status_detail_label = 'Done';
                        $task->status_text_class = 'text-green-500';
                    }
                } else {
                    $task->status_detail_label = 'Completed';
                    $task->status_text_class = 'text-green-500';
                }
            }
        }


        $notifications = Notification::where('user_id', $user->id)
            ->where('is_read', false) 
            ->orderByDesc('created_at') 
            ->get();

        return view('user.dashboard', compact(
            'assignedTasks',
            'completedTasksCount',
            'inProgressCount',
            'toDoCount',
            'totalTasks',
            'notifications' 
        ));
    }
}
