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
        // Eager load tasks along with the associated users
        $tasks = Task::with('users')->latest()->get(); 
        
        // Get all users for the task assignment
        $users = User::all(); 
        
        // Prepare an array for assigned users per task
        $assignedUsers = [];
        foreach ($tasks as $task) {
            $assignedUsers[$task->id] = $task->users->pluck('id')->toArray();  // Get user IDs assigned to each task
        }
    
        // Pass tasks, users, and assigned users to the view
        return view('admin.tasks.all-tasks', compact('tasks', 'users', 'assignedUsers'));
    }
    

    public function todo()
    {
        $tasks = Task::with('users')->where('status', 'To do')->latest()->get();  

        return view('admin.tasks.to-do', compact('tasks'));
    }

    public function inprogress()
    {
        $tasks = Task::with('users')->where('status', 'In-Progress')->latest()->get();
        $users = User::all();

        return view('admin.tasks.in-progress', compact('tasks', 'users'));
    }

    public function completed()
    {
        $tasks = Task::with('users')->where('status', 'Completed')->latest()->get();
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
        // Archive the task by setting the 'archived' field to true
        $task->archived = true;
        $task->save();
    
        // You can optionally count how many tasks have been archived
        $archivedCount = Task::where('archived', true)->count();
    
        // Pass the count to the view if needed, or just use it for logging or alert purposes
        session()->flash('task_archived', 'Task archived successfully! Archived tasks count: ' . $archivedCount);
    
        return redirect()->back();
    }
    public function edit($taskId)
    {
        $task = Task::with('users')->findOrFail($taskId);  // Eager load users
        $users = User::all();  // Fetch all users
        
        return view('admin.tasks.edit', compact('task', 'users'));
    }
    
    
}
