<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\User;
use App\Models\Message;
use App\Models\Comment;
use App\Models\UserActivity; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

<<<<<<< HEAD
        return view('admin.tasks.all-tasks', compact('tasks', 'users', 'assignedUsers', 'messages'));
>>>>>>> origin/alfred
=======
        // Fetching all user activities related to tasks (for Admin)
        $activities = UserActivity::with('task')->latest()->get(); 

        return view('admin.tasks.all-tasks', compact('tasks', 'users', 'assignedUsers', 'messages', 'activities'));
>>>>>>> origin/alfred
    }

    public function todo()
    {
        $tasks = Task::with('users')->where('status', 'To do')->latest()->get();
        $messages = Message::latest()->get();

        $activities = UserActivity::latest()->get();

        return view('admin.tasks.to-do', compact('tasks', 'messages', 'activities'));
    }

    public function inprogress()
    {
        $tasks = Task::with('users')->where('status', 'In-Progress')->latest()->get();
        $users = User::all();
        $messages = Message::latest()->get();

        // Fetching all user activities related to tasks (for Admin)
        $activities = UserActivity::latest()->get();

        return view('admin.tasks.in-progress', compact('tasks', 'users', 'messages', 'activities'));
    }

    public function completed()
    {
        $tasks = Task::with('users')->where('status', 'Completed')->latest()->get();
        $users = User::all();
        $messages = Message::latest()->get();

        // Fetching all user activities related to tasks (for Admin)
        $activities = UserActivity::latest()->get();

        return view('admin.tasks.completed', compact('tasks', 'users', 'messages', 'activities'));
    }

    public function show(Task $task)
    {
        $task->load('comments.user');

        // Fetching all user activities related to tasks (for Admin)
        $activities = UserActivity::latest()->get();

        return view('admin.tasks.task-view', compact('task', 'activities'));
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

<<<<<<< HEAD
>>>>>>> origin/alfred
=======
        // Logging task creation activity
        UserActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => 'Created Task',
            'task_id' => $task->id,
            'activity_details' => 'Created a new task: ' . $task->title,
        ]);

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

        // Logging task update activity
        UserActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => 'Updated Task',
            'task_id' => $task->id,
            'activity_details' => 'Updated task: ' . $task->title,
        ]);

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

<<<<<<< HEAD
        $archivedCount = Task::where('archived', true)->count();
>>>>>>> origin/alfred
        session()->flash('task_archived', 'Task archived successfully! Archived tasks count: ' . $archivedCount);
=======
        // Logging task archiving activity
        UserActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => 'Archived Task',
            'task_id' => $task->id,
            'activity_details' => 'Archived task: ' . $task->title,
        ]);
>>>>>>> origin/alfred

        session()->flash('task_archived', 'Task archived successfully!');
        return redirect()->back();
    }

<<<<<<< HEAD
    public function show(Task $task)
    {
      
<<<<<<< HEAD
        return view('admin.tasks.task-view', compact('task'));

    }


=======
        $task->load('comments.user'); 

    
        return view('admin.tasks.task-view', compact('task'));
    }

=======
>>>>>>> origin/alfred
    public function storeComment(Request $request, $taskId)
    {
        // Validate the comment input
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $task = Task::findOrFail($taskId);

        
        $user_id = auth()->guard('admin')->check() ? auth()->guard('admin')->id() : auth()->id();

        $comment = new Comment([
            'task_id' => $task->id,
            'user_id' => $user_id,
            'content' => $request->comment,
        ]);

        $comment->save();

        // Logging comment creation activity
        UserActivity::create([
            'user_id' => $user_id,
            'activity_type' => 'Commented on Task',
            'task_id' => $task->id,
            'activity_details' => 'Commented on task: ' . $task->title . '. Comment: ' . $request->comment,
        ]);

        return redirect()->route('admin.tasks.user.tasks.show', $task->id)
                         ->with('success', 'Comment added successfully!');
    }

    public function markActivityAsRead($id)
    {
        // Find the activity and mark it as read
        $activity = UserActivity::find($id);
        if ($activity) {
            $activity->is_read = true;  // Set the is_read flag to true
            $activity->save();  // Save the changes
        }
    
<<<<<<< HEAD
    
>>>>>>> origin/alfred
=======
        // Redirect to the related task based on the activity's task ID
        return redirect()->route('admin.tasks.user.tasks.show', $activity->task_id);
    }
>>>>>>> origin/alfred
}
