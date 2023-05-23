<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;
class LoginController extends Controller
{
    protected function authenticated(Request $request, $user)
{
    if ($user->isAdmin()) {
        return redirect()->intended('/admin/dashboard');
    }

    return redirect()->intended('/dashboard');
}

}
