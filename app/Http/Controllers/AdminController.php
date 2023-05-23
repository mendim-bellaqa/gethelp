<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;
class AdminController extends Controller
{
    public function dashboard()
{
    $users = User::where('role', 0)->get(); // Përdoruesit e thjesht
    return view('admin.dashboard', compact('users'));
}

}
