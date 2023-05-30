<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;
class RegisterController extends Controller
{
    protected function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => 0, // Përdorues i thjesht
    ]);

    // Shto detyrat për përdoruesin e ri nëse ka të dhëna të dhëna për detyrat në $data
    if (isset($data['tasks'])) {
        foreach ($data['tasks'] as $taskData) {
            $user->tasks()->create($taskData);
        }
    }

    return $user;
}

    
}
