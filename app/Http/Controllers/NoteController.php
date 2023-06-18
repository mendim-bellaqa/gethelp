<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        // Valido dhe ruajë note në bazën e të dhënave
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos');
            $validatedData['photo'] = $photoPath;
        }

        Note::create($validatedData);

        return redirect()->route('notes.index')->with('success', 'Nota është krijuar me sukses.');
    }

    public function index()
    {
        $notes = Note::all();

        return view('notes.index', compact('notes'));
    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);

        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, $id)
    {
        // Valido dhe përditëso note në bazën e të dhënave
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $note = Note::findOrFail($id);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos');
            $validatedData['photo'] = $photoPath;
        }

        $note->update($validatedData);

        return redirect()->route('notes.index')->with('success', 'Artikulli është përditësuar me sukses.');
    }
}
