<?php

namespace App\Http\Controllers\Admin;
use App\Models\UserActivity; 
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;

class TrashController extends Controller
{
    
    public function index()
    {
      
        $tasks = Task::where('archived', true)->latest()->paginate(10); 
        $messages = Message::latest()->get(); 

        $activities = UserActivity::with('task')->latest()->get(); 

        return view('admin.trash', compact('tasks', 'messages', 'activities'));
    }

    
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return redirect()->route('admin.trash.index')->with('status', 'Task deleted permanently!');
    }

    public function deleteAll()
    {
       
        Task::where('archived', true)->delete();

        return redirect()->route('admin.trash.index')->with('status', 'All archived tasks have been deleted permanently!');
    }
}
