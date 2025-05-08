<?php

namespace App\Http\Controllers\Admin;
use App\Models\Message;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserActivity; 

class ReportsController extends Controller
{
    public function showCompletedTasks()
    {
       
        $completedTasks = Task::where('status', 'completed')
                              ->with('users')  
                              ->get();
        
        foreach ($completedTasks as $task) {
            if ($task->completed_at > $task->end_date) {
                $task->status_label = 'Done Late';
                $task->status_class = 'text-red-500';
            } elseif ($task->completed_at < $task->end_date) {
                $task->status_label = 'Done Early';
                $task->status_class = 'text-blue-500';
            } else {
                $task->status_label = 'Done';
                $task->status_class = 'text-gray-500';
            }
        }

        $activities = UserActivity::with('task')->latest()->get(); 
        
        $messages = Message::latest()->get();
        
        return view('admin.reports', compact('completedTasks', 'messages'));
    }
    
    public function exportCSV(Request $request)
    {
        // Fetch completed tasks with their assigned users
        $completedTasks = Task::where('status', 'completed')
                              ->with('users')  // Eager load the users
                              ->get();
    
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="completed_tasks.csv"',
        ];
    
        $handle = fopen('php://memory', 'w');
    
        fputcsv($handle, ['Task', 'Assigned To', 'Priority', 'Stage', 'Deadline', 'Status']);
    
        foreach ($completedTasks as $task) {
    
            if ($task->completed_at > $task->end_date) {
                $task->status_label = 'Done Late';
            } elseif ($task->completed_at < $task->end_date) {
                $task->status_label = 'Done Early';
            } else {
                $task->status_label = 'Done';
            }
    

            $assignedTo = $task->users->pluck('name')->implode(', ');
    
            fputcsv($handle, [
                $task->content,          
                $assignedTo,             
                $task->priority,         
                'Completed',             
                $task->end_date,         
                $task->status_label,     
            ]);
        }
    
        rewind($handle);
        return response()->stream(function () use ($handle) {
            fpassthru($handle);
        }, 200, $headers);
    }
    
    
}
