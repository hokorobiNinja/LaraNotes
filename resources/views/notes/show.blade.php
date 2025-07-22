@extends('layouts.app')

@section('content')
    <h1>{{ $note->title }}</h1>
    <p>{{ $note->body }}</p>
    <p style="color: gray;">カテゴリ: {{ $note->category->name }}</p>
    
    <h2>コメント一覧</h2>
    @foreach($note->comments as $comment)
        <div style="border-bottom:1px solid #ccc; margin-bottom:6px;">
            <strong>{{ $comment->user->name }}</strong>
            <span style="color:gray;">（{{ $comment->created_at->diffForHumans() }}）</span>
            <p>{{ $comment->body }}</p>
            @if($comment->user_id == auth()->id())
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color:red;">削除</button>
                </form>
            @endif
        </div>
    @endforeach

    @if(auth()->check())
        <form action="{{ route('comments.store', $note) }}" method="POST" style="margin-top:12px;">
            @csrf
            <textarea name="body" rows="2" style="width:100%;">{{ old('body') }}</textarea>
            @error('body')<div style="color:red;">{{ $message }}</div>@enderror
            <button type="submit">コメントする</button>
        </form>
    @endif

    <a href="{{ route('notes.index') }}">一覧に戻る</a>
@endsection
