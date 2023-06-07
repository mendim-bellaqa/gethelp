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
            } else {
                $tasks = $user->tasks()->orderBy('due_date')->get();
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
        ]);
    
        $user = auth()->user();
    
        if (!$user->isSimpleUser()) {
            $taskData = $request->except('_token');
            $taskData['user_id'] = $user->id;
    
            $task = new Task($taskData);
            $task->save();
    
            return redirect()->route('dashboard')->with('success', 'Detyra u shtua me sukses.');
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
        ]);

        $task->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Detyra u përditësua me sukses.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Detyra u fshi me sukses.');
    }
}
