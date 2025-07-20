<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Category;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NoteController extends Controller
{

    use AuthorizesRequests;

    public function index()
    {
        $notes = Note::with(['user', 'category'])->latest()->get();
        
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('notes.create', compact('categories'));
    }

    public function store(NoteRequest $request)
    {
        Note::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('notes.index')->with('success', 'ノートを作成しました');
    }

    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        $note->delete();

        return redirect()->route('notes.index')->with('success', 'ノートを削除しました。');
    }

    public function edit(Note $note)
    {
        $this->authorize('update', $note);

        $categories = Category::all();

        return view('notes.edit', ['note' => $note, 'categories' => $categories]);
    }

    public function update(NoteRequest $request, Note $note)
    {
        $this->authorize('update', $note);

        $note->update($request->only('title', 'body', 'category_id'));

        return redirect()->route('notes.index')->with('success', 'ノートを更新しました');
    }
}
