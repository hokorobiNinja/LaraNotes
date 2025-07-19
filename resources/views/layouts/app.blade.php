<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>LaraNotes</title>
</head>
<body>
    @auth
        <p>ログイン中：{{ Auth::user()->name }} | <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a></p>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth

    @guest
        <p><a href="{{ route('login') }}">ログイン</a> | <a href="{{ route('register') }}">登録</a></p>
    @endguest

    <hr>

    @yield('content')
</body>
</html>
