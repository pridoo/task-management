<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use App\Models\UserActivity;

class DashboardController extends Controller
{
    public function dynamicTasks()
    {
        $messages = Message::latest()->get();
        $allTasks = Task::all();

        $activities = UserActivity::with('task')->latest()->get(); 

        $completedTasks = Task::where('status', 'completed')->get();
        $inProgressCount = Task::where('status', 'in-progress')->count();
        $toDoCount = Task::where('status', 'to do')->count();
        $totalTasks = $allTasks->count();

        foreach ($allTasks as $task) {
            $status = strtolower(trim($task->status ?? ''));

            // Default display values
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

                if (!empty($task->completed_date) && !empty($task->end_date)) {
                    $completedAt = Carbon::parse($task->completed_date)->startOfMinute();
                    $deadline = Carbon::parse($task->end_date)->startOfMinute();

                    if ($completedAt->gt($deadline)) {
                        $task->status_detail_label = 'Done late';
                        $task->status_text_class = 'text-red-500';
                    } elseif ($completedAt->lt($deadline)) {
                        $task->status_detail_label = 'Done early';
                        $task->status_text_class = 'text-blue-500';
                    } else {
                        $task->status_detail_label = 'Done on time';
                        $task->status_text_class = 'text-green-500';
                    }
                } else {
                    $task->status_detail_label = 'Completed';
                    $task->status_text_class = 'text-green-500';
                }
            }
        }

        return view('admin.dashboard', compact(
            'allTasks',
            'completedTasks',
            'inProgressCount',
            'toDoCount',
            'totalTasks',
            'messages',
            'activities',
        ));
    }
}
