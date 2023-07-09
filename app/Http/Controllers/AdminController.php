<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->isAdmin()) {
            $users = User::all();
        } else {
            $users = collect(); // Krijimi i një koleksioni të zbrazët për rastin kur përdoruesi nuk është Admin
        }

        if (auth()->check()) {
            $user = auth()->user();
            if ($user->isAdmin()) {
                $tasks = Task::orderBy('due_date')->get();
                $notes = Note::get();
            } else if ($user->isSimpleUser()) {
                $tasks = Task::where('user_id', $user->id)->orderBy('due_date')->get();
                $notes = Note::where('user_id', $user->id)->orderBy('title')->get();
            }
        }
        
        return view('admin.dashboard', compact('users', 'tasks', 'notes'));
    }
}
