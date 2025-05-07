<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

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

        return view('user.tasks.all-tasks', compact('tasks', 'notifications'));
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

        foreach ($tasks as $task) {
            $task->users = DB::table('users')
                ->join('task_user', 'task_user.user_id', '=', 'users.id')
                ->where('task_user.task_id', $task->id)
                ->select('users.*')
                ->get();
        }

        return view('user.tasks.to-do', compact('tasks', 'notifications'));
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

        foreach ($tasks as $task) {
            $task->users = DB::table('users')
                ->join('task_user', 'task_user.user_id', '=', 'users.id')
                ->where('task_user.task_id', $task->id)
                ->select('users.*')
                ->get();
        }

        return view('user.tasks.in-progress', compact('tasks', 'notifications'));
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

        // Fetch notifications in latest to oldest order
        $notifications = DB::table('notifications')
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->orderByDesc('created_at') // Latest notifications first
            ->get();

        foreach ($tasks as $task) {
            $task->users = DB::table('users')
                ->join('task_user', 'task_user.user_id', '=', 'users.id')
                ->where('task_user.task_id', $task->id)
                ->select('users.*')
                ->get();
        }

        return view('user.tasks.completed', compact('tasks', 'notifications'));
    }

    public function show($id)
    {
        $userId = auth('web')->id();

        $task = DB::table('tasks')
            ->join('task_user', 'tasks.id', '=', 'task_user.task_id')
            ->where('task_user.user_id', $userId)
            ->where('tasks.id', $id)
            ->where('tasks.archived', false)
            ->select('tasks.*')
            ->first();

        abort_if(!$task, 404, 'Task not found or not assigned to you.');

        return view('user.tasks.show', compact('task'));
    }

    public function assignTaskToUser(Request $request, $taskId)
    {
        $userId = $request->input('user_id'); 
    
        // Insert the task-user relationship
        DB::table('task_user')->insert([
            'task_id' => $taskId,
            'user_id' => $userId,
        ]);
    
        // Send notification
        Notification::create([
            'user_id' => $userId,
            'message' => 'A new task has been assigned to you.',
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
}
