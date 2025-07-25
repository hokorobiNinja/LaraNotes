@extends('layouts.app')

@section('content')
    <h1>ログイン</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>

        <label for="password">パスワード</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">ログイン</button>
    </form>
@endsection