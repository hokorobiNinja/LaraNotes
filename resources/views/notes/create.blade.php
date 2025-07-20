@extends('layouts.app')

@section('content')
    <h1>ノート作成</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('notes.store') }}">
        @csrf
        <label>タイトル</label><br>
        <input type="text" name="title" value="{{ old('title') }}"><br><br>

        <label>本文</label><br>
        <textarea name="body" rows="5">{{ old('body') }}</textarea><br><br>

        <button type="submit">投稿</button>
    </form>

    <a href="{{ route('notes.index') }}">戻る</a>
@endsection
