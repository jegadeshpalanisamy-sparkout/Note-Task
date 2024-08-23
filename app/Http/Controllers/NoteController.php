<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    
    /**
     * Display the form for creating a new note.
     
    * @return \Illuminate\View\View
    */
    public function create()
    {
        return view('add-note'); 
    }

    /**
     * Store a newly created note in the database.
     * @param  \App\Http\Requests\StoreNoteRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreNoteRequest $request)
    {
        $validatedData = $request->validated();

        Note::create([
            'user_id' => Auth::id(),
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Note created successfully!');
    }

     /**
     * Show the form for editing the specified note. 
     * @param  int  $id  The ID of the note to be edited.
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $note = Note::findOrFail($id);
        return view('edit-note', compact('note'));
    }

    /**
     * Update the specified note in the database.
     * @param  \App\Http\Requests\StoreNoteRequest  $request  The request containing validated data.
     * @param  int  $id  The ID of the note to be updated.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreNoteRequest $request, $id)
    {
        $validatedData = $request->validated();
        
        $note = Note::findOrFail($id);
        $note->title = $validatedData['title'];
        $note->content = $validatedData['content'];
        $note->save();

        return redirect()->route('dashboard')->with('success', 'Note updated successfully!');
    }
    
    /**
     * Remove the specified note from the database.
    * @param  int  $id  The ID of the note to be deleted.
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return redirect()->route('dashboard')->with('success', 'Note deleted successfully!');
    }
}
