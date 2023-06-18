<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\EditProfileController;

class EditProfileController extends Controller
{
    public function edit()
    {
        // Merr përdoruesin aktual
        $user = auth()->user();

        return view('editprofile', compact('user'));
    }

    public function update(Request $request)
    {
        // Valido dhe azhuro të dhenat e derguara nga forma
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // Shtoni validimet shtesë sipas nevojës tuaj
        ]);

        // Merr përdoruesin aktual
        $user = auth()->user();

        // Azhuro informacionet e profilit
        $user->name = $request->name;
        $user->email = $request->email;
        // Azhuro fushat e tjera sipas nevojës tuaj

        $user->save();

        return redirect('/')->with('success', 'Profili është azhuruar me sukses.');
    }
}
