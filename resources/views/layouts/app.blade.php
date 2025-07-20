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

    @if (session('success'))
    <div style="color: green">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
        <div style="color: red">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</body>
</html>
