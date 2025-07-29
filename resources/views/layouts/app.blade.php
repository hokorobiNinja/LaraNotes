<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>LaraNotes</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute left-1/2 transform -translate-x-1/2">
                    <a href="{{ route('notes.index') }}" class="text-2xl font-bold text-gray-900 text-theme-green-dark">LaraNotes</a>
                </div>

                <div class="flex items-center space-x-4 ml-auto">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600">ログイン</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-indigo-600 px-4 py-2 rounded-md hover:bg-indigo-700">新規登録</a>
                    @endguest

                    @auth                        
                        <div class="relative" id="user-menu-container">
                            <button type="button" class="flex items-center text-sm px-2 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <img class="h-9 w-9 rounded-full object-cover" src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="User avatar">
                                <span class="hidden md:block ml-2 text-gray-700 font-medium">{{ Str::limit(Auth::user()->name, 15, '...') }}</span>
                                <svg class="hidden md:block ml-1 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="user-menu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">プロフィール</a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="menuitem" tabindex="-1">ログアウト</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>

                        <a href="{{ route('notes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md text-sm shadow-sm transition-colors duration-200">
                            新規記事作成
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const userMenuButton = document.getElementById('user-menu-button');
                const userMenu = document.getElementById('user-menu');
                const userMenuContainer = document.getElementById('user-menu-container');

                if (userMenuButton && userMenu && userMenuContainer) {
                    userMenuButton.addEventListener('click', (event) => {
                        event.stopPropagation();
                        userMenu.classList.toggle('hidden');
                    });

                    document.addEventListener('click', (event) => {
                        if (!userMenuContainer.contains(event.target) && !userMenu.classList.contains('hidden')) {
                            userMenu.classList.add('hidden');
                        }
                    });
                }
            });
        </script>
    </header>

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
    @livewireScripts
</body>
</html>
