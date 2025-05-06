<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;

class TrashController extends Controller
{
    // Display the list of archived tasks (trash)
    public function index()
    {
        // Use pagination instead of get()
        $tasks = Task::where('archived', true)->latest()->paginate(10); 
        $messages = Message::latest()->get(); 

        return view('admin.trash', compact('tasks', 'messages'));
    }

    // Permanently delete a task from trash
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
