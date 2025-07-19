<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
</head>
<body>
    <h1>ユーザー登録</h1>

    <form method="POST" action="{{ url('/register') }}">
        @csrf

        <div>
            <label>名前</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name') <div>{{ $message }}</div> @enderror
        </div>

        <div>
            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email') <div>{{ $message }}</div> @enderror
        </div>

        <div>
            <label>パスワード</label>
            <input type="password" name="password">
            @error('password') <div>{{ $message }}</div> @enderror
        </div>

        <div>
            <label>パスワード（確認）</label>
            <input type="password" name="password_confirmation">
        </div>

        <button type="submit">登録</button>
    </form>
</body>
</html>
