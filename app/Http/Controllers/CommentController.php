<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Note $note)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000'
        ]);

        $note->comments()->create([
            'user_id' => auth()->id(),
            'body' => $validated['body'],
        ]);
        
        return back()->with('success', 'コメントを投稿しました');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();
        
        return back()->with('success', 'コメントを削除しました');
    }
}
