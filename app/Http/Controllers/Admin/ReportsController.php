<?php

namespace App\Http\Controllers\Admin;
use App\Models\Message;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function showCompletedTasks()
    {
        $completedTasks = Task::where('status', 'completed')->get();
    
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
    
        $messages = Message::latest()->get(); // ✅ Added
    
        return view('admin.reports', compact('completedTasks', 'messages'));
    }
    

    public function exportCSV(Request $request)
    {
        
        $completedTasks = Task::where('status', 'completed')->get();

    
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


            $assignedTo = implode(', ', $task->users->pluck('name')->toArray());

         
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
