<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();

            if ($user->isAdmin()) {
                $notes = Note::get();
            } else if ($user->isSimpleUser()) {
                $notes = Note::where('user_id', $user->id)->orderBy('title')->get();
            }

            return view('notes.index', compact('notes'));
        }

        return redirect()->route('login');
    }

    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('user_id'); // Ndrysho emrin e kolonës në 'user_id'
            $table->timestamps();

            // Shto lidhjen e jashtme (foreign key) me tabelën 'users'
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        // Valido formën e hyrjes
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'nullable',
        ]);

        // Krijo një instance të re të modelit Note
        $note = new Note();
        $note->title = $request->title;
        $note->description = $request->description;
        $note->photo = $request->photo;

        // Ruaj rreshtin në bazën e të dhënave
        $note->save();

        // Kthehu në faqen e notes
        return redirect()->route('notes.index');
    }


    public function edit(Note $Note)
    {
        return view('notes.edit', compact('Note'));
    }

    public function update(Request $request, Note $Note)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $Note->save();
    
        return redirect()->route('notes.index')->with('success', 'Detyra u përditësua me sukses.');
    }
    

    public function destroy(Note $Note)
    {
        $Note->delete();

        return redirect()->route('notes.index')->with('success', 'Detyra u fshi me sukses.');
    }

    public function updateStatus(Request $request, $NoteId)
    {
        $Note = Note::find($NoteId);
    
        $validatedData = $request->validate([
            'newStatus' => 'required|in:completed,in_progress,pending',
        ]);
    
        $newStatus = $validatedData['newStatus'];
    
        $Note->status = $newStatus;
        $Note->save();
    
        return response()->json(['message' => 'Statusi i detyrës u azhurnua me sukses.']);
        
    }
    
}
