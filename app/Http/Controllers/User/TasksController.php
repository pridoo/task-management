<?php

namespace App\Http\Controllers\User;

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

        return view('user.tasks.all-tasks', compact('tasks'));
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

        return view('user.tasks.to-do', compact('tasks'));
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

        return view('user.tasks.in-progress', compact('tasks'));
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

        return view('user.tasks.completed', compact('tasks'));
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
}
