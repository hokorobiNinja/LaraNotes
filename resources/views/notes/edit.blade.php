@extends('layouts.app')

@section('content')
    <h1>ノート編集</h1>

    <form action="{{ route('notes.update', $note) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>タイトル：</label>
            <input type="text" name="title" value="{{ old('title', $note->title) }}">
            @error('title') <p>{{ $message }}</p> @enderror
        </div>

        <div>
            <label>本文：</label>
            <textarea name="body">{{ old('body', $note->body) }}</textarea>
            @error('body') <p>{{ $message }}</p> @enderror
        </div>

        <button type="submit">更新</button>
    </form>

    <p><a href="{{ route('notes.index') }}">← ノート一覧に戻る</a></p>
@endsection