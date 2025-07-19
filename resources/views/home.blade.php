login success
<form method="POST" action="{{ url('/logout') }}">
    @csrf
    <button type="submit">ログアウト</button>
</form>