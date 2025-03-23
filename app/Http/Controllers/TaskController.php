<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Display all tasks
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    // Store a new task
    public function store(Request $request)
    {
        // Validate the task input
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        // Create a new task in the database
        Task::create([
            'task' => $request->task,
        ]);

        // Redirect back to the tasks list
        return redirect()->route('tasks.index');
    }

    // Toggle the 'completed' status of a task (mark as done)
    public function update(Task $task)
    {
        // Toggle the 'completed' status of the task
        $task->completed = !$task->completed;
        $task->save();

        // Redirect back to the tasks list
        return redirect()->route('tasks.index');
    }

    // Delete a task
    public function destroy(Task $task)
    {
        // Delete the task from the database
        $task->delete();

        // Redirect back to the tasks list
        return redirect()->route('tasks.index');
    }
}
