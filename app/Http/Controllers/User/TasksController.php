<?php

namespace App\Http\Controllers\User;
use Carbon\Carbon;
use App\Models\UserActivity;
use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use App\Models\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function index()
    {
        $userId = auth('web')->id();

        $tasks = DB::table('tasks')
            ->join('task_user', 'tasks.id', '=', 'task_user.task_id')
            ->where('task_user.user_id', $userId)
            ->where('tasks.archived', false)
            ->select('tasks.*')
            ->orderByDesc('tasks.created_at')
            ->get();

        $notifications = DB::table('notifications')
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->orderByDesc('created_at')
            ->get();

        $activities = UserActivity::where('user_id', $userId)
        ->where('is_read', false)
        ->orderByDesc('created_at')->get();

     
        foreach ($tasks as $task) {
            $existingNotification = DB::table('notifications')
                ->where('user_id', $userId)
                ->where('message', 'A new task has been assigned to you')
                ->where('task_title', $task->title)
                ->first();

            if (!$existingNotification) {
                Notification::create([
                    'user_id' => $userId,
                    'message' => 'A new task has been assigned to you',
                    'task_title' => $task->title,
                ]);
            }
        }

        foreach ($tasks as $task) {
            $task->users = DB::table('users')
                ->join('task_user', 'task_user.user_id', '=', 'users.id')
                ->where('task_user.task_id', $task->id)
                ->select('users.*')
                ->get();
        }

        return view('user.tasks.all-tasks', compact('tasks', 'notifications', 'activities'));
    }

    public function startTask($id)
    {
        $task = Task::findOrFail($id);
    
   
        $nowPH = Carbon::now('Asia/Manila');
        $startPH = Carbon::parse($task->start_date)->timezone('Asia/Manila');
    
        if ($startPH && $nowPH->greaterThanOrEqualTo($startPH)) {
            if ($task->status === 'To do') {
                $task->status = 'In-progress';
                $task->started_date = $nowPH; 
                $task->save();
    
                Notification::create([
                    'user_id' => auth('web')->id(),
                    'message' => 'You have started the task: ' . $task->title,
                    'task_title' => $task->title,
                ]);
    
                UserActivity::create([
                    'user_id' => auth('web')->id(),
                    'activity_type' => 'Started Task',
                    'task_id' => $task->id,
                    'activity_details' => auth('web')->user()->name . " started the task: '{$task->title}'",
                ]);
            }
        } else {
            return redirect()->route('user.tasks.index')->with('error', 'The start date and time has not yet been reached.');
        }
    
        return redirect()->route('user.tasks.index');
    }
    
    public function completeTask($id)
    {
        $task = Task::findOrFail($id);
    
        if ($task->status === 'In-progress') {
            $nowPH = Carbon::now('Asia/Manila');
    
            $task->status = 'Completed';
            $task->completed_date = $nowPH; 
            $task->is_late = $this->isTaskLate($task); 
            $task->save();
    
            Notification::create([
                'user_id' => auth('web')->id(),
                'message' => 'You have completed the task: ' . $task->title,
                'task_title' => $task->title,
            ]);
    
            $userName = auth('web')->user()->name;
            UserActivity::create([
                'user_id' => auth('web')->id(),
                'activity_type' => 'Completed Task',
                'task_id' => $task->id,
                'activity_details' => "{$userName} completed the task: '{$task->title}'",
            ]);
        }
    
        return redirect()->route('user.tasks.index');
    }
    

    private function isTaskLate($task)
    {
        return $task->end_date && now()->greaterThan($task->end_date);
    }

    public function todo()
    {
        $userId = auth('web')->id();

        $tasks = DB::table('tasks')
            ->join('task_user', 'tasks.id', '=', 'task_user.task_id')
            ->where('task_user.user_id', $userId)
            ->where('tasks.status', 'To do')
            ->where('tasks.archived', false)
            ->select('tasks.*')
            ->orderByDesc('tasks.created_at')
            ->get();

        $notifications = DB::table('notifications')
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->orderByDesc('created_at')
            ->get();

        $activities = UserActivity::where('user_id', $userId)
        ->where('is_read', false)
        ->orderByDesc('created_at')->get();

        foreach ($tasks as $task) {
            $task->users = DB::table('users')
                ->join('task_user', 'task_user.user_id', '=', 'users.id')
                ->where('task_user.task_id', $task->id)
                ->select('users.*')
                ->get();
        }

        return view('user.tasks.to-do', compact('tasks', 'notifications', 'activities'));
    }

    public function inprogress()
    {
        $userId = auth('web')->id();

        $tasks = DB::table('tasks')
            ->join('task_user', 'tasks.id', '=', 'task_user.task_id')
            ->where('task_user.user_id', $userId)
            ->where('tasks.status', 'In-Progress')
            ->where('tasks.archived', false)
            ->select('tasks.*')
            ->orderByDesc('tasks.created_at')
            ->get();

        $notifications = DB::table('notifications')
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->orderByDesc('created_at')
            ->get();

        $activities = UserActivity::where('user_id', $userId)
        ->where('is_read', false)
        ->orderByDesc('created_at')->get();

        foreach ($tasks as $task) {
            $task->users = DB::table('users')
                ->join('task_user', 'task_user.user_id', '=', 'users.id')
                ->where('task_user.task_id', $task->id)
                ->select('users.*')
                ->get();
        }

        return view('user.tasks.in-progress', compact('tasks', 'notifications', 'activities'));
    }

    public function completed()
    {
        $userId = auth('web')->id();

        $tasks = DB::table('tasks')
            ->join('task_user', 'tasks.id', '=', 'task_user.task_id')
            ->where('task_user.user_id', $userId)
            ->where('tasks.status', 'Completed')
            ->where('tasks.archived', false)
            ->select('tasks.*')
            ->orderByDesc('tasks.created_at')
            ->get();

        $notifications = DB::table('notifications')
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->orderByDesc('created_at')
            ->get();

        $activities = UserActivity::where('user_id', $userId)
        ->where('is_read', false)
        ->orderByDesc('created_at')->get();

        foreach ($tasks as $task) {
            $task->users = DB::table('users')
                ->join('task_user', 'task_user.user_id', '=', 'users.id')
                ->where('task_user.task_id', $task->id)
                ->select('users.*')
                ->get();
        }

        return view('user.tasks.completed', compact('tasks', 'notifications', 'activities'));
    }

    public function assignTaskToUser(Request $request, $taskId)
    {
        $userId = $request->input('user_id');

        DB::table('task_user')->insert([
            'task_id' => $taskId,
            'user_id' => $userId,
        ]);

        Notification::create([
            'user_id' => $userId,
            'message' => 'A new task has been assigned to you.',
            'task_title' => 'New Task Assigned',
        ]);

        return redirect()->route('tasks.index');
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        $notification->is_read = true;
        $notification->save();

        return redirect()->back();
    }

    public function showForUser($id)
    {
        $userId = auth('web')->id();

        $task = Task::whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })->findOrFail($id);

        $comments = Comment::with('user')->where('task_id', $id)->get();

        return view('user.tasks.tasks-view', compact('task', 'comments'));
    }

    public function storeComments(Request $request, $taskId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $task = Task::findOrFail($taskId);
        $user_id = auth()->guard('admin')->check() ? auth()->guard('admin')->id() : auth()->id();
        $userName = auth()->user()->name;

        $comment = new Comment([
            'task_id' => $task->id,
            'user_id' => $user_id,
            'content' => $request->comment,
        ]);
        $comment->save();

        Notification::create([
            'user_id' => $task->user_id ?? $user_id,
            'message' => 'A new comment has been added to your task: ' . $task->title,
            'task_title' => $task->title,
        ]);

        UserActivity::create([
            'activity_type' => 'Commented on Task',
            'activity_details' => "{$userName} commented on task: '{$task->title}'. Comment: '{$request->comment}'",
            'user_id' => $user_id,
            'task_id' => $task->id,
        ]);

        return redirect()->route('user.tasks.user.tasks.show', $task->id)
                         ->with('success', 'Comment added successfully!');
    }
}
