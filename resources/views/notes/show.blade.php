@extends('layouts.app')

@section('content')
    <h1>{{ $note->title }}</h1>
    <p>{{ $note->body }}</p>
    <p style="color: gray;">カテゴリ: {{ $note->category->name }}</p>
    
    <a href="{{ route('notes.index') }}">一覧に戻る</a>
@endsection
