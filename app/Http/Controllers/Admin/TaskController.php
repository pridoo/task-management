<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        $users = User::all(); 
        return view('admin.tasks.all-tasks', compact('tasks', 'users'));
    }

    public function todo()
    {
        $tasks = Task::where('status', 'To do')->latest()->get();
        $users = User::all();

        return view('admin.tasks.to-do', compact('tasks', 'users'));
    }

    public function inprogress()
    {
        $tasks = Task::where('status', 'In-Progress')->latest()->get();
        $users = User::all();

        return view('admin.tasks.in-progress', compact('tasks', 'users'));
    }

    public function completed()
    {
        $tasks = Task::where('status', 'Completed')->latest()->get();
        $users = User::all();

        return view('admin.tasks.completed', compact('tasks', 'users'));
    }



    public function store(Request $request)
    {
 
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'priority' => 'required|string',
            'status' => 'required|string',
            'assigned_to' => 'required|array',  
            'assigned_to.*' => 'exists:users,id',  
            'attachment' => 'nullable|file',
            'picture' => 'nullable|image',
        ]);
    
        $data = $request->all();
        $data['admin_id'] = auth()->id(); 
    

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }
    
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures');
        }
    
   
        $task = Task::create($data);
  
        $task->users()->attach($request->assigned_to);  
    
       
        return redirect('/admin/tasks/all-tasks')->with('task_created', 'Task created successfully!');
    }

    public function update(Request $request, Task $task)
    {
      
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'priority' => 'required|string',
            'status' => 'required|string',
            'attachment' => 'nullable|file',
            'picture' => 'nullable|image',
            'assigned_to' => 'nullable|array',  
            'assigned_to.*' => 'exists:users,id', 
        ]);
    
     
        $data = $request->all();
    
 
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }
    
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures');
        }
    

        $task->update($data);
    
  
        if ($request->has('assigned_to')) {
          
            $task->users()->sync($request->assigned_to); 
        }

        return redirect()->back()->with('success', 'Task updated successfully!');
    }



    public function destroy(Task $task)
    {
      
        $task->delete();

   
        return redirect()->back()->with('task_deleted', 'Task deleted successfully!');
    }
}
