<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Category;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Parsedown;

class NoteController extends Controller
{

    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Note::with(['user', 'category'])
            ->withCount('likes')
            ->latest();
        
        if($keyword = $request->input('keyword')) {
            $keywords = preg_split('/[\s　]+/u', $keyword, -1, PREG_SPLIT_NO_EMPTY);

            $query->where(function($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('title', 'like', "%{$word}%")
                    ->orWhere('body', 'like', "%{$word}%");
                }
            });
        }
        
        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }

        $notes = $query->get();
        $categories = Category::all();
        
        return view('notes.index', compact('notes', 'categories'));
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
        $parsedown = new Parsedown();
        $note->body_html = $parsedown->text($note->body);
        
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
