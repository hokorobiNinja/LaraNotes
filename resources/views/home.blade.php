@extends('layouts.app')

@section('content')
    <p>ログイン成功</p>
    <a href="{{ route('notes.index') }}">My Notes</a> 
@endsection