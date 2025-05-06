<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrashController extends Controller
{
    // Display the list of archived tasks (trash)
    public function index()
    {
        // Retrieve all tasks that are archived (in the trash)
        $tasks = Task::where('archived', true)->latest()->paginate(5);
        return view('admin.trash', compact('tasks'));
    }

    // Permanently delete a task from trash
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        // Permanently delete the task from the database
        $task->delete();

        return redirect()->route('admin.trash.index')->with('status', 'Task deleted permanently!');
    }

    // Delete all tasks in the trash (permanent deletion)
    public function deleteAll()
    {
        // Delete all archived tasks permanently
        Task::where('archived', true)->delete();

        return redirect()->route('admin.trash.index')->with('status', 'All archived tasks have been deleted permanently!');
    }
}
