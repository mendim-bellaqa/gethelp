<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->isAdmin()) {
                $tasks = Task::orderBy('due_date')->get();
            } else if ($user->isSimpleUser()) {
                $tasks = Task::where('user_id', $user->id)->orderBy('due_date')->get();
            }

            return view('tasks.index', compact('tasks'));
        }

        return redirect()->route('login');
    }


    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'due_time' => 'required',
        ]);

        $user = auth()->user();

        if ($user->isSimpleUser() || $user->isAdmin()) {
            $taskData = $request->except('_token', 'due_time');
            $taskData['user_id'] = $user->id;
            $taskData['due_date'] = $request->due_date . ' ' . $request->due_time;

            $task = new Task($taskData);
            $task->save();

            return redirect()->route('tasks.index')->with('success', 'Detyra u shtua me sukses.');
        }

        return redirect()->route('login');
    }



    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'due_time' => 'required',
        ]);
    
        $task->fill($request->except('_token', 'due_time'));
    
        $task->due_date = $request->due_date . ' ' . $request->due_time;
        $task->save();
    
        return redirect()->route('tasks.index')->with('success', 'Detyra u përditësua me sukses.');
    }
    

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Detyra u fshi me sukses.');
    }

    public function updateStatus(Request $request, $taskId)
    {
        $task = Task::find($taskId);
    
        $validatedData = $request->validate([
            'newStatus' => 'required|in:completed,in_progress,pending',
        ]);
    
        $newStatus = $validatedData['newStatus'];
    
        $task->status = $newStatus;
        $task->save();
    
        return response()->json(['message' => 'Statusi i detyrës u azhurnua me sukses.']);
        
    }
    
}
