<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;

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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'due_time' => 'required',
            'status' => 'required|in:Kryer,Proces,Refuzuar',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $dueDateTime = $request->input('due_date') . ' ' . $request->input('due_time');

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => $dueDateTime,
            'status' => $request->input('status'),
        ]);

        return response()->json([
            'redirect' => route('tasks.index'),
            'message' => 'Task updated successfully!',
        ]);
    }
    

    


    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Detyra u fshi me sukses.');
    }

    
    
}
