<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Comment;

class TaskController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $tasks = Task::latest()->get();
        $users = User::all();
        return view('admin.tasks.all-tasks', compact('tasks', 'users'));
=======
        $tasks = Task::with('users')->latest()->get();
        $users = User::all();

        $assignedUsers = [];
        foreach ($tasks as $task) {
            $assignedUsers[$task->id] = $task->users->pluck('id')->toArray();
        }

        $messages = Message::latest()->get();

        return view('admin.tasks.all-tasks', compact('tasks', 'users', 'assignedUsers', 'messages'));
>>>>>>> origin/alfred
    }

    public function todo()
    {
        $tasks = Task::with('users')->where('status', 'To do')->latest()->get();
        $messages = Message::latest()->get();

        return view('admin.tasks.to-do', compact('tasks', 'messages'));
    }

    public function inprogress()
    {
        $tasks = Task::with('users')->where('status', 'In-Progress')->latest()->get();
        $users = User::all();
        $messages = Message::latest()->get();

        return view('admin.tasks.in-progress', compact('tasks', 'users', 'messages'));
    }

    public function completed()
    {
        $tasks = Task::with('users')->where('status', 'Completed')->latest()->get();
        $users = User::all();
        $messages = Message::latest()->get();

        return view('admin.tasks.completed', compact('tasks', 'users', 'messages'));
    }

    public function edit($taskId)
    {
        $task = Task::with('users')->findOrFail($taskId);
        $users = User::all();
        $messages = Message::latest()->get();

        return view('admin.tasks.edit', compact('task', 'users', 'messages'));
    }

    public function store(Request $request)
    {
<<<<<<< HEAD

=======
>>>>>>> origin/alfred
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
<<<<<<< HEAD

=======
>>>>>>> origin/alfred

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures');
        }

<<<<<<< HEAD

        $task = Task::create($data);

        $task->users()->attach($request->assigned_to);


=======
        $task = Task::create($data);
        $task->users()->attach($request->assigned_to);

>>>>>>> origin/alfred
        return redirect('/admin/tasks/all-tasks')->with('task_created', 'Task created successfully!');
    }

    public function update(Request $request, Task $task)
    {
<<<<<<< HEAD

=======
>>>>>>> origin/alfred
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

<<<<<<< HEAD

        $data = $request->all();


=======
        $data = $request->all();

>>>>>>> origin/alfred
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures');
        }
<<<<<<< HEAD


        $task->update($data);


        if ($request->has('assigned_to')) {

=======

        $task->update($data);

        if ($request->has('assigned_to')) {
>>>>>>> origin/alfred
            $task->users()->sync($request->assigned_to);
        }

        return redirect()->back()->with('success', 'Task updated successfully!');
<<<<<<< HEAD

=======
>>>>>>> origin/alfred
    }

    public function destroy(Task $task)
    {
<<<<<<< HEAD
        // Archive the task by setting the 'archived' field to tru
        $task->archived = true;
        $task->save();

        // You can optionally count how many tasks have been archived
        $archivedCount = Task::where('archived', true)->count();

        // Pass the count to the view if needed, or just use it for logging or alert purposes
=======
        $task->archived = true;
        $task->save();

        $archivedCount = Task::where('archived', true)->count();
>>>>>>> origin/alfred
        session()->flash('task_archived', 'Task archived successfully! Archived tasks count: ' . $archivedCount);

        return redirect()->back();
    }

    public function show(Task $task)
    {
      
<<<<<<< HEAD
        return view('admin.tasks.task-view', compact('task'));

    }


=======
        $task->load('comments.user'); 

    
        return view('admin.tasks.task-view', compact('task'));
    }

    public function storeComment(Request $request, $taskId)
    {
        // Validate the comment input
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);
    
        
        $task = Task::findOrFail($taskId);
    
       
        if (auth()->guard('admin')->check()) {
            
            $user_id = auth()->guard('admin')->id();
        } else {
          
            $user_id = auth()->id();
        }
    

        $comment = new Comment([
            'task_id' => $task->id,
            'user_id' => $user_id,  
            'content' => $request->comment,
        ]);
    

        $comment->save();
    

        return redirect()->route('admin.tasks.tasks.show', $task->id)
                         ->with('success', 'Comment added successfully!');
    }
    
    
>>>>>>> origin/alfred
}
