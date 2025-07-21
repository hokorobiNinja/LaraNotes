@extends('layouts.app')

@section('content')
    <h1>プロファイル</h1>

    <p>ユーザー名: {{ $user->name }}</p>
    <p>メールアドレス: {{ $user->email }}</p>
    <p>プロファイル画像</p>
    @if($user->profile_image)
        <img src="{{ asset('storage/' . $user->profile_image) }}"
                alt="プロフィール画像"
                style="width:80px; height:80px; object-fit:cover; border-radius:50%;" />
    @else
        （デフォルトのプロフィール画像の表示）
    @endif

    <a href="{{ route('profile.edit', $user) }}">編集</a>
    <a href="{{ route('notes.index') }}">記事の一覧に戻る</a>
@endsection
