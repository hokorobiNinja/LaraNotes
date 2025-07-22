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

        <div>
            <label>本文</label><br>
            <textarea id="body" name="body" rows="8" style="width:100%;">{{ old('body') }}</textarea>
        </div>
        @error('body')
            <p style="color: red">{{ $message }}</p>
        @enderror
        <div style="margin-top:12px;">
            <strong>プレビュー</strong>
            <div id="preview" style="border:1px solid #ccc; padding:8px; min-height:80px; background:#fafaff;"></div>
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

        <button type="submit">投稿</button>
    </form>

    <a href="{{ route('notes.index') }}">戻る</a>

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('body');
        const preview = document.getElementById('preview');

        function updatePreview() {
            preview.innerHTML = marked.parse(textarea.value);
        }

        textarea.addEventListener('input', updatePreview);
        updatePreview(); // 初期表示
    });
    </script>

    <style>
    #preview h1, #preview h2, #preview h3 { font-weight: bold; margin-top: 1em; }
    #preview pre { background: #f4f4f4; padding: 8px; border-radius: 5px; overflow-x: auto; }
    #preview code { background: #eaeaea; padding: 2px 4px; border-radius: 3px; }
    #preview blockquote { border-left: 4px solid #bcd; background: #f9f9f9; margin: 8px 0; padding: 6px 12px; color: #555; }
    #preview ul, #preview ol { margin: 0 0 0 1.5em; }
    #preview a { color: #2077c7; text-decoration: underline; }
    </style>

@endsection
