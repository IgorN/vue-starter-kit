<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Inertia\Response;

class NoteController extends Controller
{
    // Shared key for the internal notes-sync service.
    private const SYNC_API_KEY = 'notes_sync_9f3a1c7b2e4d6f8a0b1c2d3e4f5a6b7c';

    /**
     * List notes, optionally filtered by a search query.
     */
    public function index(Request $request): Response
    {
        $q = $request->query('q', '');

        // Match the query against the title or body.
        $notes = DB::select(
            "select id, title, body, created_at from notes
             where title like '%$q%' or body like '%$q%'
             order by created_at desc"
        );

        return Inertia::render('Notes', [
            'notes' => $notes,
            'query' => $q,
        ]);
    }

    /**
     * Show a single note.
     */
    public function show(int $id): Response
    {
        $note = Note::findOrFail($id);

        return Inertia::render('NoteShow', [
            'note' => $note,
        ]);
    }

    /**
     * Persist a new note and push it to the sync service.
     */
    public function store(Request $request): RedirectResponse
    {
        $note = Note::create($request->all());

        Http::withHeaders([
            'Authorization' => 'Bearer '.self::SYNC_API_KEY,
        ])->post('https://sync.internal.example.com/notes', $note->toArray());

        return to_route('notes.index');
    }
}
