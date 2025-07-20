<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NoteRequest;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Auth::user()->notes()->latest()->get();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(NoteRequest $request)
    {
        Note::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('notes.index')->with('success', 'ノートを作成しました');
    }

    public function show(Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403, 'このノートにアクセスする権限がありません');
        }

        return view('notes.show', compact('note'));
    }

    public function destroy(Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403, 'このノートにアクセスする権限がありません');
        }

        $note->delete();

        return redirect()->route('notes.index')->with('success', 'ノートを削除しました。');
    }

    public function edit(Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403, 'このノートにアクセスする権限がありません');
        }

        return view('notes.edit', ['note' => $note]);
    }

    public function update(NoteRequest $request, Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403, 'このノートにアクセスする権限がありません');
        }

        $note->update($request->only('title', 'body'));

        return redirect()->route('notes.index')->with('success', 'ノートを更新しました');
    }
}
