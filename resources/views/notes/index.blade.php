@extends('layouts.app')

@section('content')
    <h1>My Notes</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('notes.create') }}">ノートを新規作成</a>

    <ul>
        @forelse($notes as $note)
            <div style="border: 1px solid #ccc; padding: 1rem; margin-bottom: 1rem;">
                <h3>{{ $note->title }}</h3>
                <p style="font-size: 80%">投稿者: {{ $note->user->name }}</p>
                <div>
                    {!! $note->body_html !!}
                </div>
                <p style="color: gray;">カテゴリ: {{ $note->category->name }}</p>
                <p>いいね数: {{ $note->likes_count }}</p>

                <a href="{{ route('notes.edit', $note) }}">編集</a>

                <form action="{{ route('notes.destroy', $note) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            </div>
        @empty
            <li>ノートがありません。</li>
        @endforelse
    </ul>
@endsection
