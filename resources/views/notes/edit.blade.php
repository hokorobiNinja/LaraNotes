@extends('layouts.app')

@section('content')
    <h1>ノート編集</h1>

    <form action="{{ route('notes.update', $note) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>タイトル：</label>
            <input type="text" name="title" value="{{ old('title', $note->title) }}">
            @error('title')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>本文：</label>
            <textarea name="body">{{ old('body', $note->body) }}</textarea>
            @error('body')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <select name="category_id" style="margin-bottom:8px">
        <option value="">-- カテゴリを選択 --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $note->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p style="color: red">{{ $message }}</p>
        @enderror

        <button type="submit">更新</button>
    </form>

    <p><a href="{{ route('notes.index') }}">← ノート一覧に戻る</a></p>
@endsection