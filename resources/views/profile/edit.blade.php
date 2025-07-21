@extends('layouts.app')

@section('content')
    <h1>プロファイル編集</h1>

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="max-width:400px;">
    @csrf

    <div style="margin-bottom:10px;">
        <label>名前：</label><br>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" style="width:100%;">
        @error('name')<div style="color:red;">{{ $message }}</div>@enderror
    </div>

    <div style="margin-bottom:10px;">
        <label>メールアドレス：</label><br>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" style="width:100%;">
        @error('email')<div style="color:red;">{{ $message }}</div>@enderror
    </div>

    <div style="margin-bottom:10px;">
        <label>プロフィール画像：</label><br>
        @if($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像" style="width:80px; height:80px; object-fit:cover; border-radius:50%;">
        @endif
        <input type="file" name="profile_image" accept="image/*">
        @error('profile_image')<div style="color:red;">{{ $message }}</div>@enderror
    </div>

    <button type="submit" style="padding:8px 20px;">更新</button>
    <a href="{{ route('profile.show') }}">戻る</a>
</form>
@endsection
