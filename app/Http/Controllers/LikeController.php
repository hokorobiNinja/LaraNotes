<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Note;

class LikeController extends Controller
{
    public function store(Note $note)
    {
        $user = auth()->user();

        if ($note->likes()->where('user_id', $user->id)->doesntExist()) {
            $note->likes()->create(['user_id' => $user->id]);
        }

        return back();
    }

    public function destroy(Note $note)
    {
        $user = auth()->user();
        $note->likes()->where('user_id', $user->id)->delete();
        return back();
    }
}
