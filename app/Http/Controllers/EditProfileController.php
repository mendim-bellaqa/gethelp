<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class EditProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('editprofile', compact('user'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            // Validimet për fushat e tjera të profilit
            'role' => 'required|in:0,1',
        ]);
        
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->description = $request->input('description');
        $user->role = $validatedData['role'];
        $user->save();

        return redirect()->route('home')->with('success', 'Profili u përditësua me sukses.');
    }
}
