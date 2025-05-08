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
        $tasks = Task::with('users')->latest()->get();
        $users = User::all();

        $assignedUsers = [];
        foreach ($tasks as $task) {
            $assignedUsers[$task->id] = $task->users->pluck('id')->toArray();
        }

        $messages = Message::latest()->get();

        // Fetching all user activities related to tasks (for Admin)
        $activities = UserActivity::with('task')->latest()->get(); 

        return view('admin.tasks.all-tasks', compact('tasks', 'users', 'assignedUsers', 'messages', 'activities'));
    }

    public function todo()
    {
        $tasks = Task::with('users')->where('status', 'To do')->latest()->get();
        $messages = Message::latest()->get();

        // Fetching all user activities related to tasks (for Admin)
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

        // Logging task creation activity
        UserActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => 'Created Task',
            'task_id' => $task->id,
            'activity_details' => 'Created a new task: ' . $task->title,
        ]);

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

        // Logging task update activity
        UserActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => 'Updated Task',
            'task_id' => $task->id,
            'activity_details' => 'Updated task: ' . $task->title,
        ]);

        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->archived = true;
        $task->save();

        // Logging task archiving activity
        UserActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => 'Archived Task',
            'task_id' => $task->id,
            'activity_details' => 'Archived task: ' . $task->title,
        ]);

        session()->flash('task_archived', 'Task archived successfully!');
        return redirect()->back();
    }

    public function storeComment(Request $request, $taskId)
    {
        // Validate the comment input
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $task = Task::findOrFail($taskId);

        // Log the user who is commenting
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
    
        // Redirect to the related task based on the activity's task ID
        return redirect()->route('admin.tasks.user.tasks.show', $activity->task_id);
    }
}
