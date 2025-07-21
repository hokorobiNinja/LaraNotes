@extends('layouts.app')

@section('content')
    <h1>ノート作成</h1>

    <form method="POST" action="{{ route('notes.store') }}">
        @csrf

        <label>タイトル</label><br>
        <input type="text" name="title" value="{{ old('title') }}"><br><br>
        @error('title')
            <p style="color: red">{{ $message }}</p>
        @enderror

        <label>本文</label><br>
        <textarea name="body" rows="5">{{ old('body') }}</textarea><br><br>
        @error('body')
            <p style="color: red">{{ $message }}</p>
        @enderror

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

        <button type="submit">投稿</button>
    </form>

    <a href="{{ route('notes.index') }}">戻る</a>
@endsection
