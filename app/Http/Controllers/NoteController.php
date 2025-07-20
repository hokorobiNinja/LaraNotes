<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        Auth::user()->notes()->create($request->only('title', 'body'));

        return redirect()->route('notes.index')->with('success', 'ノートを投稿しました！');
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

    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403, 'このノートにアクセスする権限がありません');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')->with('success', 'ノートを更新しました');
    }
}
