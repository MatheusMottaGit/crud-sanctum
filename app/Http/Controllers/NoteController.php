<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => "required|string"
        ]);

        $note = Note::create([
            'title' => $validated['title'],
            'description' => $validated['description']
        ]);

        return response()->json($note, '201');
    }

    public function read() {
        $notes = Note::all();

        return response()->json($notes, '200');
    }

    public function update(int $id, Request $request) {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => "required|string"
        ]);

        $note = Note::where('id', $id)->update([
            'title' => $validated['title'],
            'description' => $validated['description']
        ]);

        return response()->json($note, '200');
    }

    public function delete(int $id) {
        Note::where('id', $id)->delete();

        return response()->json('Note deleted.', 200);
    }
}
